<?php

class Idea_stepsController extends AuthorizedController {

	/**
	 * Idea_step Repository
	 *
	 * @var Idea_step
	 */
	protected $idea_step;


	public function __construct(Idea_step $idea_step)
	{
        parent::__construct();

        $this->idea_step = $idea_step;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $idea_steps = $this->idea_step->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('idea_steps.index', compact('idea_steps'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('idea_steps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Idea_step::$rules);

		if ($validation->passes())
		{
			$this->idea_step->create($input);

			return Redirect::route('idea_steps');
		}

		return Redirect::route('create/idea_step')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{

		$idea_step = $this->idea_step->find($id);

		if (is_null($idea_step))
		{
			return Redirect::route('idea_steps');
		}

		return View::make('idea_steps.edit', compact('idea_step'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($id)
	{

		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Idea_step::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$idea_step = $this->idea_step->find($id);

        if ($idea_step->update($input)) {
            // Redirect to the idea_steps page
            return Redirect::to("ideas/{$idea_step->idea_id}/show")->with('success', Lang::get('idea_steps/message.update.success'));
        }

        // Redirect to the idea_steps management page
        return Redirect::to("ideas/{$idea_step->idea_id}/show")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_steps';
        $confirm_route = $error = null;
        // Check if the idea_steps exists
        if (is_null($idea_step = $this->idea_step->find($id))) {

            $error = Lang::get('idea_steps/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_step', array('id'=>$idea_step->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{

        $this->idea_step->find($id)->delete();
        // Redirect to the idea_steps management page
        return Redirect::route('idea_steps')->with('success', Lang::get('idea_steps/message.success.delete'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function setOpen($id)
    {
        DB::beginTransaction();
        $rules = array(
            'due_date'   => 'date',
        );
        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $idea_step = $this->idea_step->find($id);
        $idea_step = $idea_step->load('idea');
        $due_date = Input::get('due_date')==""?'0000-00-00 00:00:00':Input::get('due_date');
        $idea_step->due_date             = e($due_date);
        $idea_step->initiate_date        = date("Y-m-d H:i:s");
        $idea_step->is_opened            = true;

        $idea_step->idea->current_step_id = $idea_step->id;

        // Was the blog tweet updated?
        if ($idea_step->save()) {
            if($idea_step->idea->save()){
                //open the first activity
                DB::commit();
                return Redirect::to("idea_steps/$id/show")->with('success', Lang::get('ideas/message.update.success'));
            }
        }
        DB::rollback();
        // Redirect to the ideas management page
        return Redirect::to("idea_steps/$id/show")->with('error', Lang::get('tweets/message.update.error'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function setClose($id)
    {
        DB::beginTransaction();
        try{

            // if next_activity is null than do not populate next step
            $next_step = e(Input::get('next_step'));

            $idea_step = $this->idea_step->find($id);
            $idea_step = $idea_step->load('idea');

            $idea_step->is_closed             = true;

            if($next_step){
                $idea_step->next_step         = $next_step==""?-1:$next_step;
            }

            // Was the blog tweet updated?
            if ($idea_step->save()) {

                if($next_step){
                    if(!$this->populate_step($next_step,$idea_step,$idea_step->idea->workflow_category_id)){
                        // Redirect to the ideas management page
                        DB::rollback();
                        return Redirect::to("ideas/{$$idea_step->idea_id}/show")->with('error', Lang::get('idea_steps/message.update.error'));
                    }
                }
                DB::commit();
                // Redirect to the ideas page
                return Redirect::to("ideas/{$idea_step->idea_id}/show")->with('success', Lang::get('idea_steps/message.update.success'));
            }
        } catch(\Exception $e)
        {

        }
        DB::rollback();
        // Redirect to the ideas management page
        return Redirect::to("idea_steps/$id/show")->with('error', Lang::get('idea_steps/message.update.error'));

    }
    private function populate_step($next_step,$current_step,$workflow_id){
        try {
            // get the first step
            $step = DB::table('workflow_steps')
                ->where('id', $next_step)
                ->first();
            if(!empty($step)){
                // populate Step data
                $idea_step_id = DB::table('idea_steps')->insertGetId(
                    array(
                        'idea_id' => $current_step->idea_id,
                        'workflow_step_id' => $next_step,
                        'prev_step' => $current_step->idea_id,
                        'next_step' => -1,
                        'status' => false,
                        'is_opened' => false,
                        'is_closed' => false,
                        'due_date' => null,
                        'initiate_date' => null
                    )
                );
                if($idea_step_id>0){
                    return $this->populate_first_activity($current_step->idea_id, $workflow_id, $next_step, $idea_step_id);
                }
                return true;
            }
            return false;
        } catch(\Exception $e)
        {
            return false;
        }
    }
    private function populate_first_activity($idea_id, $workflow_id, $step_id, $idea_step_id){
        // populate first activity
        $activity = DB::table('workflow_step_activities')
            ->where('workflow_id', $workflow_id)
            ->where('workflow_step_id', $step_id)
            ->where('activity_no', 1)
            ->get();
        if(!empty($activity[0])){
            return $this->populate_activity($idea_id, $idea_step_id, $activity[0]->id);
        }
        return false;
    }
    private function populate_activity($idea_id, $step_id, $activity_id){
        try {
            // get the first activity
            $activity = DB::table('workflow_step_activities')
                ->where('id', $activity_id)
                ->get();
            if(!empty($activity[0])){
                // populate Step data
                $idea_step_activity = new Idea_step_activity;

                $idea_step_activity->idea_id = $idea_id;
                $idea_step_activity->idea_step_id = $step_id;
                $idea_step_activity->workflow_activity_id = $activity_id;
                $idea_step_activity->activity_form_ids = $activity[0]->forms;
                $idea_step_activity->prev_activity = -1;
                $idea_step_activity->next_activity = -1;
                $idea_step_activity->status = false;
                $idea_step_activity->is_opened = false;
                $idea_step_activity->is_closed = false;
                $idea_step_activity->due_date = null;
                $idea_step_activity->initiate_date = null;

                $idea_step_activity->save();

                return true;
            }
            return false;
        } catch(\Exception $e)
        {
            return false;
        }
    }
    public function getView($id){

        $idea_step = $this->idea_step->find($id);
        $idea_step = $idea_step->load('workflow_step');//,'activities','activities.workflow_step_activity');

        $activities = Idea_step_activity::where('idea_step_id','=',$id)->get();
        $activities = $activities->load('workflow_step_activity');

        $next_steps = DB::table('workflow_steps')
            ->whereIn('id', explode(',',$idea_step->workflow_step->next_step))
            ->lists( 'name','id');
//        var_dump($next_steps);
//        return;
        if (is_null($idea_step))
        {
            return Redirect::route('idea_steps');
        }

        return View::make('idea_steps.show', compact('idea_step','next_steps','activities'));
    }
}

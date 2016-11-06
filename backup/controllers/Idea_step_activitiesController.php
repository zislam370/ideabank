<?php

class Idea_step_activitiesController extends AuthorizedController {

	/**
	 * Idea_step_activity Repository
	 *
	 * @var Idea_step_activity
	 */
	protected $idea_step_activity;

	public function __construct(Idea_step_activity $idea_step_activity)
	{
        parent::__construct();

        $this->idea_step_activity = $idea_step_activity;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $idea_step_activities = $this->idea_step_activity->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('idea_step_activities.index', compact('idea_step_activities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('idea_step_activities.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Idea_step_activity::$rules);

		if ($validation->passes())
		{
			$this->idea_step_activity->create($input);

			return Redirect::route('idea_step_activities');
		}

		return Redirect::route('create/idea_step_activity')
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

		$idea_step_activity = $this->idea_step_activity->find($id);

		if (is_null($idea_step_activity))
		{
			return Redirect::route('idea_step_activities');
		}

		return View::make('idea_step_activities.edit', compact('idea_step_activity'));
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
		$validation = Validator::make($input, Idea_step_activity::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$idea_step_activity = $this->idea_step_activity->find($id);

        if ($idea_step_activity->update($input)) {
            // Redirect to the idea_step_activities page
            return Redirect::route('idea_step_activities');
        }

        // Redirect to the idea_step_activities management page
        return Redirect::to("idea_step_activities/$id/edit")->with('error', Lang::get('ideas/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_step_activities';
        $confirm_route = $error = null;
        // Check if the idea_step_activities exists
        if (is_null($idea_step_activity = $this->idea_step_activity->find($id))) {

            $error = Lang::get('idea_step_activities/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_step_activity', array('id'=>$idea_step_activity->id));
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

        $this->idea_step_activity->find($id)->delete();
        // Redirect to the idea_step_activities management page
        return Redirect::route('idea_step_activities')->with('success', Lang::get('idea_step_activities/message.success.delete'));
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
//            'due_date'   => 'date',
        );
        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $idea_step_activity = $this->idea_step_activity->find($id);

        $due_date = Input::get('due_date')==""?'0000-00-00 00:00:00':Input::get('due_date');
        $idea_step_activity->due_date             = e($due_date);

        $idea_step_activity->title             = e(Input::get('title'));
        $idea_step_activity->description             = e(Input::get('description'));
        $idea_step_activity->targeted             = e(Input::get('targeted'));

        $idea_step_activity->initiate_date        = date("Y-m-d H:i:s");
        $idea_step_activity->is_opened            = true;

        $idea_step_activity->idea->current_step_id = $idea_step_activity->id;

        if ($idea_step_activity->save()) {
            DB::commit();
            return Redirect::to("idea_step_activities/$id/show")->with('success', Lang::get('idea_step_activities/message.update.success'));
        }

        DB::rollback();
        return Redirect::to("idea_step_activities/$id/show")->with('error', Lang::get('idea_step_activities/message.update.error'));
    }

    public function setAchieve($id){

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
            $next_activity = e(Input::get('next_activity'));

            $idea_step_activity = $this->idea_step_activity->find($id);

            $idea_step_activity->is_closed             = true;
//            $idea_step_activity->user_id               = true;
            $idea_step_activity->next_activity         = $next_activity==""?-1:$next_activity;

            $flg = false;

            // Was the blog tweet updated?
            if ($idea_step_activity->save()) {
                $flg = $this->update_idea($idea_step_activity->idea_id);
//                echo $flg; return;
                if($flg && $next_activity){
                    $flg = $this->populate_activity($next_activity,$idea_step_activity);
                }
                if($flg){
                    DB::commit();
                    // Redirect to the ideas page
                    return Redirect::to("ideas/$idea_step_activity->idea_id/show")->with('success', Lang::get('ideas/message.update.success'));
                }else{
                    // Redirect to the ideas management page
                    DB::rollback();
                    return Redirect::to("idea_step_activities/$id/show")->with('error', Lang::get('ideas/message.update.error'));
                }
            }
        } catch(\Exception $e)
        {

        }
        DB::rollback();
        // Redirect to the ideas management page
        return Redirect::to("idea_step_activities/$id/show")->with('error', Lang::get('ideas/message.update.error'));

    }
    private function update_idea($idea_id){
        try{
            DB::table('ideas')
                ->where('id', $idea_id)
                ->increment('activities_done');
            return true;
        }catch(\Exception $e){

        }

//        $idea = Idea::where('id','=',$idea_id)->first();
//        $idea->activities_done = ($idea->activities_done==null?0:$idea->activities_done+1);
//        if ($idea->save()) {
//            return true;
//        }
        return false;
    }

    private function populate_activity($next_activity,$current_activity){
        try {
            // get the first activity
            $activity = DB::table('workflow_step_activities')
                ->where('id', $next_activity)
                ->first();
            if(!empty($activity)){
                // populate Step data
                $idea_step_activity = new Idea_step_activity;

                $idea_step_activity->idea_id = $current_activity->idea_id;
                $idea_step_activity->idea_step_id = $current_activity->idea_step_id;
                $idea_step_activity->workflow_activity_id = $next_activity;
                $idea_step_activity->activity_form_ids = $activity->forms;
                $idea_step_activity->prev_activity = $current_activity->idea_id;
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

    public function getView($id)
    {

        $idea_step_activity = $this->idea_step_activity->find($id);
        if (is_null($idea_step_activity))
        {
            return Redirect::route('idea_step_activities');
        }

        $idea_step_activity = $idea_step_activity->load('workflow_step_activity');

//        var_dump($idea_step_activity->workflow_step_activity->next_activity);
//        return;

        $next_activities = DB::table('workflow_step_activities')
            ->whereIn('id', explode(',',$idea_step_activity->workflow_step_activity->next_activity))
            ->lists( 'name','id');

//        $ids = explode(',',$idea_step_activity->activity_form_ids);
//        echo ($idea_step_activity->workflow_activity_id);
//        return;
//        $ids = $this->getForms($idea_step_activity->workflow_activity_id);
//        $ids = explode(',',$ids);
//        echo $ids;
//        return;

        $activity_forms = $this->getForms($idea_step_activity->workflow_activity_id);
        $heads = Form_lookup_datum::where('form_lookup_id','=',8)->lists('name','id');

//        var_dump($activity_forms);return;

        $activity_attachments = Idea_step_activity_attachment::where('idea_step_activity_id', $id)->get();
        $activity_attachments = $activity_attachments->load('head');

//        var_dump($activity_attachments[0]->head); return;
        $view = View::make('idea_step_activities.show', compact('idea_step_activity','next_activities','activity_forms','activity_attachments','heads'));
//        $activity = $idea_step_activity;
//        $heads = Form_lookup_datum::where('form_lookup_id','=',3)->get();
//        $view = $view->nest('test_form_funds','test_form_funds.create',compact('activity','heads'));
        return $view;
    }

    private function getForms($workflow_activity_id){

        $form_ids = DB::table('workflow_step_activities')
            ->select('forms')
            ->where('id', $workflow_activity_id)
            ->first();
        $tmp = json_decode($form_ids->forms);

        $tmp2 = array();
        foreach($tmp as $t){
            $tmp2[$t->id] = $t->title;
        }

        $ids = array();
        foreach($tmp as $t){
            $ids[] = $t->id;
        }

        $forms = array();
        $activity_forms = DB::table('activity_forms')
            ->select('action_uri', 'id')
            ->whereIn('id', $ids)
            ->get();

        $i = 0;
        foreach($activity_forms as $form){
            $tp['action_uri'] = $form->action_uri;
            $tp['name'] = $tmp2[$form->id];
            $forms[$i] = (object) $tp;
            $i++;
        }

        return $forms;

    }

}

AdminController<?php

class Workflow_stepsController extends AdminController {

	/**
	 * Workflow_step Repository
	 *
	 * @var Workflow_step
	 */
	protected $workflow_step;

	public function __construct(Workflow_step $workflow_step)
	{
        parent::__construct();

        $this->workflow_step = $workflow_step;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

	    $workflow_steps = $this->workflow_step->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('workflow_steps.index', compact('workflow_steps'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList($workflowId)
	{
        $workflow_steps = DB::select(
                        DB::raw("
                            SELECT a.*, GROUP_CONCAT(b.name SEPARATOR '/') 'next_steps'
                                FROM `eservice_idabank2`.`workflow_steps` a
                                LEFT JOIN `eservice_idabank2`.`workflow_steps` b ON FIND_IN_SET(b.id, a.`next_step`) > 0
                                WHERE a.workflow_id = $workflowId
                                GROUP BY a.`id`
                                ORDER BY step_no ASC
                            ")
                    );
//        var_dump($workflow_steps);
//        return;
//	    $workflow_steps = $this->workflow_step->where('workflow_id', $workflowId)->orderBy('step_no', 'ASC')->paginate(10);
        return View::make('workflow_steps.list', compact('workflow_steps','workflowId'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($workflowId)
	{
        $steps = $this->workflow_step->where('workflow_id',$workflowId)->lists('name', 'id');
        $groups = Group::lists('name', 'id');
		return View::make('workflow_steps.create', compact('workflowId','steps','groups'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate($workflowId)
	{
        // get the  data
        $new = Input::all();

		$validation = Validator::make($new, Workflow_step::$rules);
        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }

        $workflow_step = new Workflow_step;

        $workflow_step->workflow_id  = Input::get('workflow_id');
        $workflow_step->step_no  = Input::get('step_no');
        $workflow_step->name  = Input::get('name');
        $workflow_step->description  = Input::get('description');
        $workflow_step->num_of_activities  = 0;

        $next_steps = Input::get('next_step');
        if($next_steps!=null){
            $workflow_step->next_step  = implode(',',Input::get('next_step'));
        }
        $groups = Input::get('groups');
        if($groups!=null){
            $workflow_step->groups  = implode(',',Input::get('groups'));
        }

        // Was the blog tweet updated?
        if ($workflow_step->save()) {

            $workflow = Workflow_category::find($workflowId);
            $workflow->num_of_steps = $workflow->num_of_steps + 1;
            $workflow->save();

            // Redirect to the ideas page
            return Redirect::to("workflow_steps/$workflowId/list")->with('success', Lang::get('workflow_steps/message.update.success'));
        }
        return Redirect::to("workflow_steps/$workflowId/list")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $workflow_step = $this->workflow_step->find($id);
        $steps = $this->workflow_step
                        ->where('workflow_id',$workflow_step->workflow_id)
                        ->where('id','<>',$id)
                        ->lists('name', 'id');

		if (is_null($workflow_step))
		{
			return Redirect::route('workflow_steps');
		}
        $groups = Group::lists('name', 'id');

		return View::make('workflow_steps.edit', compact('workflow_step','steps','groups'));
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
        $validation = Validator::make($input, Workflow_step::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }

        $workflow_step = $this->workflow_step->find($id);

        $workflow_step->name  = Input::get('name');
        $workflow_step->description  = Input::get('description');
        $workflow_step->step_no  = Input::get('step_no');

        $next_steps = Input::get('next_step');
        if($next_steps!=null){
            $next_steps = implode(',',Input::get('next_step'));
        }
        $workflow_step->next_step  = $next_steps;

        $groups = Input::get('groups');
        if($groups!=null){
            $groups  = implode(',',Input::get('groups'));
        }
        $workflow_step->groups  = $groups;

        if ($workflow_step->save()) {
            // Redirect to the workflow_steps page
            return Redirect::to("workflow_steps/{$workflow_step->workflow_id}/list")->with('success', Lang::get('workflow_steps/message.update.success'));
        }

        return Redirect::to("workflow_steps/{$workflow_step->workflow_id}/list")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'workflow_steps';
        $confirm_route = $error = null;
        // Check if the workflow_steps exists
        if (is_null($workflow_step = $this->workflow_step->find($id))) {

            $error = Lang::get('workflow_steps/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/workflow_step', array('id'=>$workflow_step->id));
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

        $this->workflow_step->find($id)->delete();
        // Redirect to the workflow_steps management page
        return Redirect::route('workflow_steps')->with('success', Lang::get('workflow_steps/message.success.delete'));
	}

}

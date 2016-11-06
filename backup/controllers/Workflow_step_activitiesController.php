<?php

class Workflow_step_activitiesController extends AuthorizedController {

	/**
	 * Workflow_step_activity Repository
	 *
	 * @var Workflow_step_activity
	 */
	protected $workflow_step_activity;

	public function __construct(Workflow_step_activity $workflow_step_activity)
	{
        parent::__construct();

        $this->workflow_step_activity = $workflow_step_activity;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $workflow_step_activities = $this->workflow_step_activity->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('workflow_step_activities.index', compact('workflow_step_activities'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList($workflowId, $stepId)
	{

	    $workflow_step_activities = $this->workflow_step_activity->where('workflow_step_id', $stepId)->orderBy('activity_no', 'ASC')->paginate(10);
        $workflow_step_activities = DB::select(
            DB::raw("
                    SELECT a.*, GROUP_CONCAT(b.name SEPARATOR '/') 'next_activities'
                    FROM `eservice_idabank2`.`workflow_step_activities` a
                    LEFT JOIN `eservice_idabank2`.`workflow_step_activities` b ON FIND_IN_SET(b.id, a.`next_activity`) > 0
                    WHERE a.`workflow_step_id` = $stepId
                    GROUP BY a.`id`
                    ORDER BY `activity_no` ASC
                            ")
        );

        return View::make('workflow_step_activities.list', compact('workflow_step_activities','workflowId','stepId'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($workflowId, $stepId)
	{
        $activities = $this->workflow_step_activity
                           ->where('workflow_id',$workflowId)
                           ->where('workflow_step_id',$stepId)
                           ->lists('name', 'id');
        $forms = Activity_form::lists('name', 'id');
		return View::make('workflow_step_activities.create', compact('workflowId','stepId','activities','forms'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate($workflowId, $stepId)
	{

        // get the  data
        $new = Input::all();


        $validation = Validator::make($new, Workflow_step_activity::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $workflow_step_activity = new Workflow_step_activity;


        $workflow_step_activity->workflow_id  = Input::get('workflow_id');
        $workflow_step_activity->workflow_step_id  = Input::get('workflow_step_id');
        $workflow_step_activity->activity_no  = Input::get('activity_no');
        $workflow_step_activity->name  = Input::get('name');
        $workflow_step_activity->description  = Input::get('description');

        $next_activities = Input::get('next_activity');
        if($next_activities!=null){
            $workflow_step_activity->next_activity  = implode(',',Input::get('next_activity'));
        }

        $forms = Input::get('forms');
        if($forms!=null){
            $workflow_step_activity->forms  = json_encode(Input::get('forms'));
        }else{
            $workflow_step_activity->forms  = "[]";
        }

        // Was the blog tweet updated?
        if ($workflow_step_activity->save()) {

            $workflow_step = Workflow_step::find($stepId);
            $workflow_step->num_of_activities = $workflow_step->num_of_activities + 1;
            $workflow_step->save();

            // Redirect to the ideas page
            return Redirect::to("workflow_step_activities/$workflowId/$stepId/list")->with('success', Lang::get('workflow_step_activities/message.update.success'));
        }
        return Redirect::to("workflow_step_activities/$workflowId/$stepId/list")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{

		$workflow_step_activity = $this->workflow_step_activity->find($id);
        $activities = $this->workflow_step_activity
            ->where('workflow_id',$workflow_step_activity->workflow_id)
            ->where('workflow_step_id',$workflow_step_activity->workflow_step_id)
            ->lists('name', 'id');
        $forms = Activity_form::lists('name', 'id');
        $selected_forms = json_decode($workflow_step_activity->forms);
//        var_dump($selected_forms); return;
		if (is_null($workflow_step_activity))
		{
			return Redirect::route('workflow_step_activities');
		}

		return View::make('workflow_step_activities.edit', compact('workflow_step_activity','activities','forms','selected_forms'));
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
		$validation = Validator::make($input, Workflow_step_activity::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$workflow_step_activity = $this->workflow_step_activity->find($id);

        $workflow_step_activity->workflow_id  = Input::get('workflow_id');
        $workflow_step_activity->workflow_step_id  = Input::get('workflow_step_id');
        $workflow_step_activity->activity_no  = Input::get('activity_no');
        $workflow_step_activity->name  = Input::get('name');
        $workflow_step_activity->description  = Input::get('description');

        $next_activities = Input::get('next_activity');
        if($next_activities!=null){
            $tmp = implode(',',Input::get('next_activity'));
            $workflow_step_activity->next_activity  = $tmp;
        }else{
            $workflow_step_activity->next_activity  = "";
        }

        $forms = Input::get('forms');
//        var_dump($forms); return;
        if($forms!=null){
//            $tmp = implode(',',Input::get('forms'));
            $tmp = json_encode(Input::get('forms'));
            $workflow_step_activity->forms  = $tmp;
        }else{
            $workflow_step_activity->forms  = "[]";
        }

        if ($workflow_step_activity->save()) {
            // Redirect to the workflow_step_activities page
            return Redirect::to("workflow_step_activities/$id/edit")->with('success', Lang::get('workflow_step_activities/message.update.success'));
        }

        // Redirect to the workflow_step_activities management page
        return Redirect::to("workflow_step_activities/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'workflow_step_activities';
        $confirm_route = $error = null;
        // Check if the workflow_step_activities exists
        if (is_null($workflow_step_activity = $this->workflow_step_activity->find($id))) {

            $error = Lang::get('workflow_step_activities/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/workflow_step_activity', array('id'=>$workflow_step_activity->id));
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

        $this->workflow_step_activity->find($id)->delete();
        // Redirect to the workflow_step_activities management page
        return Redirect::route('workflow_step_activities')->with('success', Lang::get('workflow_step_activities/message.success.delete'));
	}

}

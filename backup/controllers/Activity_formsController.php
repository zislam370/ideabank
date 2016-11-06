<?php

class Activity_formsController extends AuthorizedController {

	/**
	 * Activity_form Repository
	 *
	 * @var Activity_form
	 */
	protected $activity_form;

	public function __construct(Activity_form $activity_form)
	{
        parent::__construct();

        $this->activity_form = $activity_form;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $activity_forms = $this->activity_form->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('activity_forms.index', compact('activity_forms'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('activity_forms.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Activity_form::$rules);

		if ($validation->passes())
		{
			$this->activity_form->create($input);

			return Redirect::route('activity_forms');
		}

		return Redirect::route('create/activity_form')
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

		$activity_form = $this->activity_form->find($id);

		if (is_null($activity_form))
		{
			return Redirect::route('activity_forms');
		}

		return View::make('activity_forms.edit', compact('activity_form'));
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
		$validation = Validator::make($input, Activity_form::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$activity_form = $this->activity_form->find($id);

        if ($activity_form->update($input)) {
            // Redirect to the activity_forms page
            return Redirect::to("activity_forms/$id/edit")->with('success', Lang::get('activity_forms/message.update.success'));
        }

        // Redirect to the activity_forms management page
        return Redirect::to("activity_forms/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'activity_forms';
        $confirm_route = $error = null;
        // Check if the activity_forms exists
        if (is_null($activity_form = $this->activity_form->find($id))) {

            $error = Lang::get('activity_forms/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/activity_form', array('id'=>$activity_form->id));
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

        $this->activity_form->find($id)->delete();
        // Redirect to the activity_forms management page
        return Redirect::route('activity_forms')->with('success', Lang::get('activity_forms/message.success.delete'));
	}

    public function getView($id,$activity_id){
        $activity_form = DB::table('activity_forms')
            ->select('action_uri','multiple')
            ->where('id', $id)
            ->first();
//        return Redirect::route('view/'.$activity_form->action_uri,$activity_id);

        $form_data = array();
        if($activity_form->multiple){
            $form_data = $this->get_form_data_by_name($activity_form->action_uri,$activity_id);
        }else{
            $form_data = DB::table($activity_form->action_uri)
                            ->where('activity_id',$activity_id)
                            ->first();
        }
        return View::make($activity_form->action_uri.'.ajax.show', compact('form_data'));


//        return View::make('form_budgets.ajax.edit', compact('form_budget','heads'));
    }

    private function get_form_data_by_name($name,$activity_id){
        switch($name){
            case 'form_concept_papers': return Form_concept_paper::where('activity_id',$activity_id)->with('items')->first();
            case 'form_budgets': return Form_budget::where('activity_id',$activity_id)->with('items')->first();
            case 'form_funds': return Form_fund::where('activity_id',$activity_id)->with('items')->first();
            case 'form_scores': return Form_score::where('activity_id',$activity_id)->with('items')->first();
            case 'form_times': return Form_time::where('activity_id',$activity_id)->with('items')->first();
            case 'form_visits': return Form_visit::where('activity_id',$activity_id)->with('items')->first();
            case 'form_stack_holders': return Form_stack_holder::where('activity_id',$activity_id)->with('items')->first();
            case 'form_sp_panels': return Form_sp_panel::where('activity_id',$activity_id)->with('items')->first();
            case 'form_payment_schedules': return Form_payment_schedule::where('activity_id',$activity_id)->with('items')->first();
            case 'form_payment_disbursments': return Form_payment_disbursment::where('activity_id',$activity_id)->with('items')->first();
            case 'form_evaluations': return Form_evaluation::where('activity_id',$activity_id)->with('items')->first();
            case 'form_deliverables': return Form_deliverable::where('activity_id',$activity_id)->with('items')->first();
            case 'form_inventories': return Form_inventory::where('activity_id',$activity_id)->with('items')->first();
            case 'form_tcvs': return Form_tcv::where('activity_id',$activity_id)->with('items')->first();
            case 'form_activities': return Form_activity::where('activity_id',$activity_id)->with('items')->first();
            case 'form_manpowers': return Form_manpower::where('activity_id',$activity_id)->with('items')->first();
            case 'form_materials': return Form_material::where('activity_id',$activity_id)->with('items')->first();
        }
    }

}

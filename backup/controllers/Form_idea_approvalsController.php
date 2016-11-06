<?php

class Form_idea_approvalsController extends AuthorizedController {

	/**
	 * Form_idea_approval Repository
	 *
	 * @var Form_idea_approval
	 */
	protected $form_idea_approval;

	public function __construct(Form_idea_approval $form_idea_approval)
	{
        parent::__construct();

        $this->form_idea_approval = $form_idea_approval;
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex($activity_id)
    {
        $form_idea_approval = $this->form_idea_approval
            ->where('activity_id', $activity_id)
            ->first();
//        var_dump($form_idea_approval);
//        return;
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',7)->get();
        if (sizeof($form_idea_approval)<=0)
        {
            return View::make('form_idea_approvals.ajax.create', compact('activity','heads'));
        }

        return View::make('form_idea_approvals.ajax.edit', compact('activity','form_idea_approval','heads'));
    }

    public function postIndex($activity_id){
        DB::beginTransaction();

//        $input = array_except(Input::all(), '_method');

        $affectedRows = Form_idea_approval::where('activity_id', '=', $activity_id)->delete();

        $form_idea_approval = new Form_idea_approval;

        $form_idea_approval->idea_id = Input::get('idea_id');
        $form_idea_approval->step_id = Input::get('step_id');
        $form_idea_approval->activity_id = Input::get('activity_id');

        $form_idea_approval->approval_id = Input::get('approval_id');
        $form_idea_approval->comment = Input::get('comment');

        if($form_idea_approval->save()){
            DB::commit();
            // Redirect to the form_concept_papers page
            return Redirect::to("idea_step_activities/$activity_id/show")->with('success', Lang::get('form_idea_approvals/message.update.success'));
        }
        DB::rollback();

        // Redirect to the form_concept_papers management page
        return Redirect::to("idea_step_activities/$activity_id")->with('error', Lang::get('form_idea_approvals/message.update.error'));
    }

}

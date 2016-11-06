<?php

class Form_richtextsController extends AuthorizedController {

	/**
	 * Form_richtext Repository
	 *
	 * @var Form_richtext
	 */
	protected $form_richtext;

	public function __construct(Form_richtext $form_richtext)
	{
        parent::__construct();

        $this->form_richtext = $form_richtext;
	}


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex($activity_id)
    {
        $form_richtext = $this->form_richtext
            ->where('activity_id', $activity_id)
            ->first();
//        var_dump($form_idea_approval);
//        return;
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
//        $heads = Form_lookup_datum::where('form_lookup_id','=',7)->get();
        if (sizeof($form_richtext)<=0)
        {
            return View::make('form_richtexts.ajax.create', compact('activity'));
        }

        return View::make('form_richtexts.ajax.edit', compact('activity','form_richtext'));
    }

    public function postIndex($activity_id){
        DB::beginTransaction();

        $affectedRows = Form_richtext::where('activity_id', '=', $activity_id)->delete();

        $form_richtext = new Form_richtext;

        $form_richtext->idea_id = Input::get('idea_id');
        $form_richtext->step_id = Input::get('step_id');
        $form_richtext->activity_id = Input::get('activity_id');

        $form_richtext->body = Input::get('body');

        if($form_richtext->save()){
            DB::commit();
            // Redirect to the form_concept_papers page
            return Redirect::to("idea_step_activities/$activity_id/show")->with('success', Lang::get('form_richtexts/message.update.success'));
        }
        DB::rollback();

        // Redirect to the form_concept_papers management page
        return Redirect::to("idea_step_activities/$activity_id/show")->with('error', Lang::get('form_richtexts/message.update.error'));
    }

}

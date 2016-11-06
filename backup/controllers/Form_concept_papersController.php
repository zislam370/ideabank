<?php

class Form_concept_papersController extends AuthorizedController {

	/**
	 * Form_concept_paper Repository
	 *
	 * @var Form_concept_paper
	 */
	protected $form_concept_paper;

	public function __construct(Form_concept_paper $form_concept_paper)
	{
        parent::__construct();

        $this->form_concept_paper = $form_concept_paper;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex($activity_id)
	{
        $form_concept_paper = $this->form_concept_paper
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_concept_paper->is_draft) && !$form_concept_paper->is_draft){
            $form_concept_paper = $form_concept_paper->load('items');
            return View::make('form_concept_papers.ajax.show', compact('form_concept_paper'));
        }
        if (empty($form_concept_paper))
        {
            $activity = DB::table('idea_step_activities')
                ->where('id', $activity_id)
                ->first();
            return View::make('form_concept_papers.ajax.create', compact('activity'));
        }
        $form_concept_paper = $form_concept_paper->load('items');

        return View::make('form_concept_papers.ajax.edit', compact('form_concept_paper'));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postIndex($activity_id)
	{
//        var_dump(Input::all());
//        return;
        DB::beginTransaction();
        $input = array_except(Input::all(), '_method');
        unset($input['items']);
//        unset($input['submit']);
        $validation = Validator::make($input, Form_concept_paper::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }

        $form_concept_paper = $this->form_concept_paper->where('activity_id', '=', $activity_id)->first();
        $flg = false;
        if (empty($form_concept_paper))
        {

            $new_feature = $this->form_concept_paper->create($input);
            $items = Input::get('items');
            $flg = true;
            foreach($items as $feature){
                $form_feature = new Form_concept_paper_item;
                $form_feature->form_concept_paper_id = $new_feature->id;
                $form_feature->feature = $feature;
                if(!$form_feature->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_concept_paper->update($input)) {
                $flg = true;
                $items = Input::get('items');
                $affectedRows = Form_concept_paper_item::where('form_concept_paper_id', '=', $form_concept_paper->id)->delete();
                foreach($items as $feature){
                    $form_feature = new Form_concept_paper_item;
                    $form_feature->form_concept_paper_id = $form_concept_paper->id;
                    $form_feature->feature = $feature;
                    if(!$form_feature->save()){
                        $flg = false;
//                        break;
                    }
                }
            }
        }
        if($flg){
            DB::commit();
            // Redirect to the form_concept_papers page
            return Redirect::to("idea_step_activities/$activity_id/show")->with('success', Lang::get('form_concept_papers/message.update.success'));
        }
        DB::rollback();

        // Redirect to the form_concept_papers management page
        return Redirect::to("idea_step_activities/$activity_id/show")->with('error', Lang::get('form_concept_papers/message.update.error'));

    }

    public function getView($activity_id){

        $form_concept_paper = $this->form_concept_paper
            ->where('activity_id', $activity_id)
            ->first();
        var_dump($form_concept_paper); return;
        return View::make('form_concept_papers.ajax.show', compact('form_concept_paper'));
    }
}

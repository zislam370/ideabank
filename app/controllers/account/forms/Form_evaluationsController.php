<?php

class Form_evaluationsController extends AuthorizedController {

	/**
	 * Form_evaluation Repository
	 *
	 * @var Form_evaluation
	 */
	protected $form_evaluation;

	public function __construct(Form_evaluation $form_evaluation)
	{
        parent::__construct();

        $this->form_evaluation = $form_evaluation;
	}
    public function getIndex($activity_id)
    {
        $form_evaluation = $this->form_evaluation
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_evaluation->is_draft) && !$form_evaluation->is_draft){
            $form_evaluation = $form_evaluation->load('items');
            return View::make('form_evaluations.ajax.show', compact('form_evaluation'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',14)->lists('name', 'name');
        if (sizeof($form_evaluation)<=0)
        {
            return View::make('form_evaluations.ajax.create', compact('activity','heads'));
        }
        $form_evaluation = $form_evaluation->load('items');

        return View::make('form_evaluations.ajax.edit', compact('form_evaluation','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_evaluation::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_evaluation = $this->form_evaluation->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_evaluation))
        {
            $new_item = $this->form_evaluation->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_evaluation_item;
                $form_item->form_evaluation_id = $new_item->id;
                $form_item->task = $item['task'];
                $form_item->due_date = $item['due_date'];
                $form_item->target = $item['target'];
                $form_item->achieved = $item['achieved'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_evaluation->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_evaluation_item::where('form_evaluation_id', '=', $form_evaluation->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_evaluation_item;
                    $form_item->form_evaluation_id = $form_evaluation->id;
                    $form_item->task = $item['task'];
                    $form_item->due_date = $item['due_date'];
                    $form_item->target = $item['target'];
                    $form_item->achieved = $item['achieved'];
                    $form_item->comment = $item['comment'];
                    if(!$form_item->save()){
                        $flg = false;
                    }
                }
            }
        }

        if($flg){
            DB::commit();
            return Redirect::to("idea_step_activities/$activity_id/show")->with('success', Lang::get('form_concept_papers/message.update.success'));
        }
        DB::rollback();
        return Redirect::to("idea_step_activities/$activity_id/show")->with('error', Lang::get('form_concept_papers/message.update.error'));
    }

}

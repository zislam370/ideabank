<?php

class Form_scoresController extends AuthorizedController {

	/**
	 * Form_score Repository
	 *
	 * @var Form_score
	 */
	protected $form_score;

	public function __construct(Form_score $form_score)
	{
        parent::__construct();

        $this->form_score = $form_score;
	}

    public function getIndex($activity_id)
    {
        $form_score = $this->form_score
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_score->is_draft) && !$form_score->is_draft){
            $form_score = $form_score->load('items');
            return View::make('form_scores.ajax.show', compact('form_score'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_score)<=0)
        {
            return View::make('form_scores.ajax.create', compact('activity','heads'));
        }
        $form_score = $form_score->load('items');

        return View::make('form_scores.ajax.edit', compact('form_score','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_score::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_score = $this->form_score->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_score))
        {
            $new_item = $this->form_score->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_score_item;
                $form_item->form_score_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->score = ($item['score']?$item['score']:0);
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_score->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_score_item::where('form_score_id', '=', $form_score->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_score_item;
                    $form_item->form_score_id = $form_score->id;
                    $form_item->head = $item['head'];
                    $form_item->score = ($item['score']?$item['score']:0);
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

<?php

class Form_budgetsController extends AuthorizedController {

	protected $form_budget;

	public function __construct(Form_budget $form_budget)
	{
        parent::__construct();

        $this->form_budget = $form_budget;
	}

	public function getIndex($activity_id)
	{
        $form_budget = $this->form_budget
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_budget->is_draft) && !$form_budget->is_draft){
            $form_budget = $form_budget->load('items');
            return View::make('form_budgets.ajax.show', compact('form_budget'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_budget)<=0)
        {
            return View::make('form_budgets.ajax.create', compact('activity','heads'));
        }
        $form_budget = $form_budget->load('items');

        return View::make('form_budgets.ajax.edit', compact('form_budget','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_budget::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_budget = $this->form_budget->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_budget))
        {
            $new_item = $this->form_budget->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_budget_item;
                $form_item->form_budget_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->amount = ($item['amount']?$item['amount']:0);
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_budget->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_budget_item::where('form_budget_id', '=', $form_budget->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_budget_item;
                    $form_item->form_budget_id = $form_budget->id;
                    $form_item->head = $item['head'];
                    $form_item->amount = ($item['amount']?$item['amount']:0);
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


    public function getView($activity_id){

        $form_budget = $this->form_budget
            ->where('activity_id', $activity_id)
            ->first();
//        var_dump($form_budget); return;
        return View::make('form_budgets.ajax.show', compact('form_budget'));
    }
}

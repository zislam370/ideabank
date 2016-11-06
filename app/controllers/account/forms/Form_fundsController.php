<?php

class Form_fundsController extends AuthorizedController {

	/**
	 * Form_fund Repository
	 *
	 * @var Form_fund
	 */
	protected $form_fund;

	public function __construct(Form_fund $form_fund)
	{
        parent::__construct();

        $this->form_fund = $form_fund;
	}

    public function getIndex($activity_id)
    {
        $form_fund = $this->form_fund
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_fund->is_draft) && !$form_fund->is_draft){
            $form_fund = $form_fund->load('items');
            return View::make('form_funds.ajax.show', compact('form_fund'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_fund)<=0)
        {
            return View::make('form_funds.ajax.create', compact('activity','heads'));
        }
        $form_fund = $form_fund->load('items');

        return View::make('form_funds.ajax.edit', compact('form_fund','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_fund::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_fund = $this->form_fund->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_fund))
        {
            $new_item = $this->form_fund->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_fund_item;
                $form_item->form_fund_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->amount = ($item['amount']?$item['amount']:0);
                $form_item->source = $item['source'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_fund->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_fund_item::where('form_fund_id', '=', $form_fund->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_fund_item;
                    $form_item->form_fund_id = $form_fund->id;
                    $form_item->head = $item['head'];
                    $form_item->amount = ($item['amount']?$item['amount']:0);
                    $form_item->source = $item['source'];
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

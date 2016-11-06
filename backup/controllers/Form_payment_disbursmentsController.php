<?php


class Form_payment_disbursmentsController extends AuthorizedController {

	/**
	 * Form_payment_disbursment Repository
	 *
	 * @var Form_payment_disbursment
	 */
	protected $form_payment_disbursment;

	public function __construct(Form_payment_disbursment $form_payment_disbursment)
	{
        parent::__construct();

        $this->form_payment_disbursment = $form_payment_disbursment;
	}

    public function getIndex($activity_id)
    {
        $form_payment_disbursment = $this->form_payment_disbursment
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_payment_disbursment->is_draft) && !$form_payment_disbursment->is_draft){
            $form_payment_disbursment = $form_payment_disbursment->load('items');
            return View::make('form_payment_disbursments.ajax.show', compact('form_payment_disbursment'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',13)->lists('name', 'name');
        if (sizeof($form_payment_disbursment)<=0)
        {
            return View::make('form_payment_disbursments.ajax.create', compact('activity','heads'));
        }
        $form_payment_disbursment = $form_payment_disbursment->load('items');

        return View::make('form_payment_disbursments.ajax.edit', compact('form_payment_disbursment','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_payment_disbursment::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_payment_disbursment = $this->form_payment_disbursment->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_payment_disbursment))
        {
            $new_item = $this->form_payment_disbursment->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_payment_disbursment_item;
                $form_item->form_payment_disbursment_id = $new_item->id;
                $form_item->installment = $item['installment'];
                $form_item->disburse_date = $item['disburse_date'];
                $form_item->amount = $item['amount'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_payment_disbursment->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_payment_disbursment_item::where('form_payment_disbursment_id', '=', $form_payment_disbursment->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_payment_disbursment_item;
                    $form_item->form_payment_disbursment_id = $form_payment_disbursment->id;
                    $form_item->installment = $item['installment'];
                    $form_item->disburse_date = $item['disburse_date'];
                    $form_item->amount = $item['amount'];
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

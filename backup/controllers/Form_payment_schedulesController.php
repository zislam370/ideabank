<?php

class Form_payment_schedulesController extends AuthorizedController {

	/**
	 * Form_payment_schedule Repository
	 *
	 * @var Form_payment_schedule
	 */
	protected $form_payment_schedule;

	public function __construct(Form_payment_schedule $form_payment_schedule)
	{
        parent::__construct();

        $this->form_payment_schedule = $form_payment_schedule;
	}

    public function getIndex($activity_id)
    {
        $form_payment_schedule = $this->form_payment_schedule
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_payment_schedule->is_draft) && !$form_payment_schedule->is_draft){
            $form_payment_schedule = $form_payment_schedule->load('items');
            return View::make('form_payment_schedules.ajax.show', compact('form_payment_schedule'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',12)->lists('name', 'name');
        if (sizeof($form_payment_schedule)<=0)
        {
            return View::make('form_payment_schedules.ajax.create', compact('activity','heads'));
        }
        $form_payment_schedule = $form_payment_schedule->load('items');

        return View::make('form_payment_schedules.ajax.edit', compact('form_payment_schedule','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_payment_schedule::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_payment_schedule = $this->form_payment_schedule->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_payment_schedule))
        {
            $new_item = $this->form_payment_schedule->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_payment_schedule_item;
                $form_item->form_payment_schedule_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->due_date = $item['due_date'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_payment_schedule->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_payment_schedule_item::where('form_payment_schedule_id', '=', $form_payment_schedule->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_payment_schedule_item;
                    $form_item->form_payment_schedule_id = $form_payment_schedule->id;
                    $form_item->head = $item['head'];
                    $form_item->due_date = $item['due_date'];
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

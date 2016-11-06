<?php

class Form_stack_holdersController extends AuthorizedController {

	/**
	 * Form_stack_holder Repository
	 *
	 * @var Form_stack_holder
	 */
	protected $form_stack_holder;

	public function __construct(Form_stack_holder $form_stack_holder)
	{
        parent::__construct();

        $this->form_stack_holder = $form_stack_holder;
	}

    public function getIndex($activity_id)
    {
        $form_stack_holder = $this->form_stack_holder
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_stack_holder->is_draft) && !$form_stack_holder->is_draft){
            $form_stack_holder = $form_stack_holder->load('items');
            return View::make('form_stack_holders.ajax.show', compact('form_stack_holder'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',10)->lists('name', 'name');
        if (sizeof($form_stack_holder)<=0)
        {
            return View::make('form_stack_holders.ajax.create', compact('activity','heads'));
        }
        $form_stack_holder = $form_stack_holder->load('items');

        return View::make('form_stack_holders.ajax.edit', compact('form_stack_holder','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_stack_holder::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_stack_holder = $this->form_stack_holder->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_stack_holder))
        {
            $new_item = $this->form_stack_holder->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_stack_holder_item;
                $form_item->form_stack_holder_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->role = $item['role'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_stack_holder->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_stack_holder_item::where('form_stack_holder_id', '=', $form_stack_holder->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_stack_holder_item;
                    $form_item->form_stack_holder_id = $form_stack_holder->id;
                    $form_item->head = $item['head'];
                    $form_item->role = $item['role'];
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

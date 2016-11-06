<?php

class Form_deliverablesController extends AuthorizedController {

	/**
	 * Form_deliverable Repository
	 *
	 * @var Form_deliverable
	 */
	protected $form_deliverable;

	public function __construct(Form_deliverable $form_deliverable)
	{
        parent::__construct();

        $this->form_deliverable = $form_deliverable;
	}
    public function getIndex($activity_id)
    {
        $form_deliverable = $this->form_deliverable
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_deliverable->is_draft) && !$form_deliverable->is_draft){
            $form_deliverable = $form_deliverable->load('items');
            return View::make('form_deliverables.ajax.show', compact('form_deliverable'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',15)->lists('name', 'name');
        if (sizeof($form_deliverable)<=0)
        {
            return View::make('form_deliverables.ajax.create', compact('activity','heads'));
        }
        $form_deliverable = $form_deliverable->load('items');

        return View::make('form_deliverables.ajax.edit', compact('form_deliverable','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_deliverable::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_deliverable = $this->form_deliverable->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_deliverable))
        {
            $new_item = $this->form_deliverable->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_deliverable_item;
                $form_item->form_deliverable_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->due_date = $item['due_date'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_deliverable->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_deliverable_item::where('form_deliverable_id', '=', $form_deliverable->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_deliverable_item;
                    $form_item->form_deliverable_id = $form_deliverable->id;
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

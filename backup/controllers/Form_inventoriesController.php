<?php

class Form_inventoriesController extends AuthorizedController {

	protected $form_inventory;

	public function __construct(Form_inventory $form_inventory)
	{
        parent::__construct();

        $this->form_inventory = $form_inventory;
	}

	public function getIndex($activity_id)
	{
        $form_inventory = $this->form_inventory
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_inventory->is_draft) && !$form_inventory->is_draft){
            $form_inventory = $form_inventory->load('items');
            return View::make('form_inventories.ajax.show', compact('form_inventory'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();

        if (sizeof($form_inventory)<=0)
        {
            return View::make('form_inventories.ajax.create', compact('activity','heads'));
        }
        $form_inventory = $form_inventory->load('items');

        return View::make('form_inventories.ajax.edit', compact('form_inventory','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_inventory::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_inventory = $this->form_inventory->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_inventory))
        {
            $new_item = $this->form_inventory->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_inventory_item;
                $form_item->form_inventory_id = $new_item->id;
                $form_item->name = $item['name'];
                $form_item->quantity = ($item['quantity']?$item['quantity']:0);
                $form_item->description = $item['description'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_inventory->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_inventory_item::where('form_inventory_id', '=', $form_inventory->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_inventory_item;
                    $form_item->form_inventory_id = $form_inventory->id;
                    $form_item->name = $item['name'];
                    $form_item->quantity = ($item['quantity']?$item['quantity']:0);
                    $form_item->description = $item['description'];
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

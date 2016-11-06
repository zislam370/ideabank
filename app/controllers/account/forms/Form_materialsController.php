<?php

class Form_materialsController extends AuthorizedController {

	/**
	 * Form_material Repository
	 *
	 * @var Form_material
	 */
	protected $form_material;

	public function __construct(Form_material $form_material)
	{
        parent::__construct();

        $this->form_material = $form_material;
	}

    public function getIndex($activity_id)
    {
        $form_material = $this->form_material
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_material->is_draft) && !$form_material->is_draft){
            $form_material = $form_material->load('items');
            return View::make('form_materials.ajax.show', compact('form_material'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
//        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_material)<=0)
        {
//            return View::make('form_materials.ajax.create', compact('activity','heads'));
            return View::make('form_materials.ajax.create', compact('activity'));
        }
        $form_material = $form_material->load('items');

//        return View::make('form_materials.ajax.edit', compact('form_material','heads'));
        return View::make('form_materials.ajax.edit', compact('form_material'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_material::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_material = $this->form_material->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_material))
        {
            $new_item = $this->form_material->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_material_item;
                $form_item->form_material_id = $new_item->id;
                $form_item->description = ($item['description']?$item['description']:0);
                $form_item->unit = $item['unit'];
                $form_item->price = $item['price'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_material->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_material_item::where('form_material_id', '=', $form_material->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_material_item;
                    $form_item->form_material_id = $form_material->id;
                    $form_item->description = ($item['description']?$item['description']:0);
                    $form_item->unit = $item['unit'];
                    $form_item->price = $item['price'];
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

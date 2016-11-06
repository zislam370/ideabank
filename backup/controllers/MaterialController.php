<?php

class MaterialController extends AuthorizedController {

    /**
     * Material Repository
     *
     * @var Material
     */
    protected $material;

    public function __construct(Material $material)
    {
        parent::__construct();

        $this->material = $material;
    }

    public function getIndex($activity_id)
    {
        $material = $this->material
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($material->is_draft) && !$material->is_draft){
            $material = $material->load('items');
            return View::make('materials.ajax.show', compact('material'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($material)<=0)
        {
            return View::make('materials.ajax.create', compact('activity','heads'));
        }
        $material = $material->load('items');

        return View::make('materials.ajax.edit', compact('material','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Material::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $material = $this->material->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($material))
        {
            $new_item = $this->material->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Material_item;
                $form_item->material_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->amount = ($item['amount']?$item['amount']:0);
                $form_item->comment = $item['comment'];
                $form_item->source = $item['source'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($material->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Material_item::where('material_id', '=', $material->id)->delete();
                foreach($items as $item){
                    $form_item = new Material_item;
                    $form_item->material_id = $material->id;
                    $form_item->head = $item['head'];
                    $form_item->amount = ($item['amount']?$item['amount']:0);
                    $form_item->comment = $item['comment'];
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

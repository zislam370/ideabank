<?php

class Form_manpowersController extends AuthorizedController {

    /**
     * Form_manpower Repository
     *
     * @var Form_manpower
     */
    protected $form_manpower;

    public function __construct(Form_manpower $form_manpower)
    {
        parent::__construct();

        $this->form_manpower = $form_manpower;
    }

    public function getIndex($activity_id)
    {
        $form_manpower = $this->form_manpower
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_manpower->is_draft) && !$form_manpower->is_draft){
            $form_manpower = $form_manpower->load('items');
            return View::make('form_manpowers.ajax.show', compact('form_manpower'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
//        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_manpower)<=0)
        {
//            return View::make('form_manpowers.ajax.create', compact('activity','heads'));
            return View::make('form_manpowers.ajax.create', compact('activity'));
        }
        $form_manpower = $form_manpower->load('items');

//        return View::make('form_manpowers.ajax.edit', compact('form_manpower','heads'));
        return View::make('form_manpowers.ajax.edit', compact('form_manpower'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_manpower::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_manpower = $this->form_manpower->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_manpower))
        {
            $new_item = $this->form_manpower->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_manpower_item;
                $form_item->form_manpower_id = $new_item->id;
                $form_item->name = ($item['name']?$item['name']:0);
                $form_item->designation = $item['designation'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_manpower->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_manpower_item::where('form_manpower_id', '=', $form_manpower->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_manpower_item;
                    $form_item->form_manpower_id = $form_manpower->id;
                    $form_item->name = ($item['name']?$item['name']:0);
                    $form_item->designation = $item['designation'];
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

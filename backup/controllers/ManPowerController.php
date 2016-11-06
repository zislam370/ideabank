<?php

class ManPowerController extends AuthorizedController {

    /**
     * Manpower Repository
     *
     * @var Manpower
     */
    protected $manpower;

    public function __construct(Manpower $manpower)
    {
        parent::__construct();

        $this->manpower = $manpower;
    }

    public function getIndex($activity_id)
    {
        $manpower = $this->manpower
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($manpower->is_draft) && !$manpower->is_draft){
            $manpower = $manpower->load('items');
            return View::make('manpowers.ajax.show', compact('manpower'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($manpower)<=0)
        {
            return View::make('manpowers.ajax.create', compact('activity','heads'));
        }
        $manpower = $manpower->load('items');

        return View::make('manpowers.ajax.edit', compact('manpower','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Manpower::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $manpower = $this->manpower->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($manpower))
        {
            $new_item = $this->manpower->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Manpower_item;
                $form_item->manpower_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->amount = ($item['amount']?$item['amount']:0);
                $form_item->comment = $item['comment'];
                $form_item->source = $item['source'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($manpower->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Manpower_item::where('manpower_id', '=', $manpower->id)->delete();
                foreach($items as $item){
                    $form_item = new Manpower_item;
                    $form_item->manpower_id = $manpower->id;
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

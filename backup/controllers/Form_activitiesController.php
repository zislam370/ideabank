<?php


class Form_activitiesController extends AuthorizedController {

    protected $form_activity;

    public function __construct(Form_activity $form_activity)
    {
        parent::__construct();

        $this->form_activity = $form_activity;
    }

    public function getIndex($activity_id)
    {
        $form_activity = $this->form_activity
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_activity->is_draft) && !$form_activity->is_draft){
            $form_activity = $form_activity->load('items');
            return View::make('form_activities.ajax.show', compact('form_activity'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_activity)<=0)
        {
            return View::make('form_activities.ajax.create', compact('activity','heads'));
        }
        $form_activity = $form_activity->load('items');

        return View::make('form_activities.ajax.edit', compact('form_activity','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_activity::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_activity = $this->form_activity->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_activity))
        {
            $new_item = $this->form_activity->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_activity_item;
                $form_item->form_activity_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->plan_start = $item['plan_start'];
                $form_item->plan_end = $item['plan_end'];
                $form_item->responsible_person = $item['responsible_person'];
                $form_item->target_date = $item['target_date'];
                $form_item->achieved_date = $item['achieved_date'];
                $form_item->target = $item['target'];
                $form_item->achieved = $item['achieved'];
                $form_item->comments = $item['comments'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_activity->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_activity_item::where('form_activity_id', '=', $form_activity->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_activity_item;
                    $form_item->form_activity_id = $form_activity->id;
                    $form_item->head = $item['head'];
                    $form_item->plan_start = $item['plan_start'];
                    $form_item->plan_end = $item['plan_end'];
                    $form_item->responsible_person = $item['responsible_person'];
                    $form_item->target_date = $item['target_date'];
                    $form_item->achieved_date = $item['achieved_date'];
                    $form_item->target = $item['target'];
                    $form_item->achieved = $item['achieved'];
                    $form_item->comments = $item['comments'];
                    if(!$form_item->save()){
                        $flg = false;
                    }
                }
            }
        }

        if($flg){
            DB::commit();
            return Redirect::to("idea_step_activities/$activity_id/show")->with('success', Lang::get('form_activities/message.update.success'));
        }
        DB::rollback();
        return Redirect::to("idea_step_activities/$activity_id/show")->with('error', Lang::get('form_activities/message.update.error'));
    }



}

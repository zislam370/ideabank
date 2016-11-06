<?php

class Form_timesController extends AuthorizedController {

	/**
	 * Form_time Repository
	 *
	 * @var Form_time
	 */
	protected $form_time;

	public function __construct(Form_time $form_time)
	{
        parent::__construct();

        $this->form_time = $form_time;
	}

    public function getIndex($activity_id)
    {
        $form_time = $this->form_time
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_time->is_draft) && !$form_time->is_draft){
            $form_time = $form_time->load('items');
            return View::make('form_times.ajax.show', compact('form_time'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_time)<=0)
        {
            return View::make('form_times.ajax.create', compact('activity','heads'));
        }
        $form_time = $form_time->load('items');

        return View::make('form_times.ajax.edit', compact('form_time','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_time::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_time = $this->form_time->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_time))
        {
            $new_item = $this->form_time->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_time_item;
                $form_item->form_time_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->duration = $item['duration'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_time->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_time_item::where('form_time_id', '=', $form_time->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_time_item;
                    $form_item->form_time_id = $form_time->id;
                    $form_item->head = $item['head'];
                    $form_item->duration = $item['duration'];
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

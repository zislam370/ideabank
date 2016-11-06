<?php

class Form_tcvsController extends AuthorizedController {

	/**
	 * Form_tcv Repository
	 *
	 * @var Form_tcv
	 */
	protected $form_tcv;

	public function __construct(Form_tcv $form_tcv)
	{
        parent::__construct();

        $this->form_tcv = $form_tcv;
	}

    public function getIndex($activity_id)
    {
        $form_tcv = $this->form_tcv
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_tcv->is_draft) && !$form_tcv->is_draft){
            $form_tcv = $form_tcv->load('items');
            return View::make('form_tcvs.ajax.show', compact('form_tcv'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
//        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($form_tcv)<=0)
        {
//            return View::make('form_tcvs.ajax.create', compact('activity','heads'));
            return View::make('form_tcvs.ajax.create', compact('activity'));
        }
        $form_tcv = $form_tcv->load('items');

//        return View::make('form_tcvs.ajax.edit', compact('form_tcv','heads'));
        return View::make('form_tcvs.ajax.edit', compact('form_tcv'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_tcv::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_tcv = $this->form_tcv->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_tcv))
        {
            $new_item = $this->form_tcv->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_tcv_item;
                $form_item->form_tcv_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->time_type = $item['time_type'];
                $form_item->timeafter = $item['timeafter']?$item['timeafter']:0;
                $form_item->timebefore = $item['timebefore']?$item['timebefore']:0;
                $form_item->timebenefit = $item['timebenefit']?$item['timebenefit']:0;
                $form_item->visitafter = $item['visitafter']?$item['visitafter']:0;
                $form_item->visitbefore = $item['visitbefore']?$item['visitbefore']:0;
                $form_item->visitbenefit = $item['visitbenefit']?$item['visitbenefit']:0;
                $form_item->costafter = ($item['costafter']?$item['costafter']:0);
                $form_item->costbefore = ($item['costbefore']?$item['costbefore']:0);
                $form_item->costbenefit = ($item['costbenefit']?$item['costbenefit']:0);
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_tcv->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_tcv_item::where('form_tcv_id', '=', $form_tcv->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_tcv_item;
                    $form_item->form_tcv_id = $form_tcv->id;
                    $form_item->head = $item['head'];
                    $form_item->time_type = $item['time_type'];
                    $form_item->timeafter = $item['timeafter']?$item['timeafter']:0;
                    $form_item->timebefore = $item['timebefore']?$item['timebefore']:0;
                    $form_item->timebenefit = $item['timebenefit']?$item['timebenefit']:0;
                    $form_item->visitafter = $item['visitafter']?$item['visitafter']:0;
                    $form_item->visitbefore = $item['visitbefore']?$item['visitbefore']:0;
                    $form_item->visitbenefit = $item['visitbenefit']?$item['visitbenefit']:0;
                    $form_item->costafter = ($item['costafter']?$item['costafter']:0);
                    $form_item->costbefore = ($item['costbefore']?$item['costbefore']:0);
                    $form_item->costbenefit = ($item['costbenefit']?$item['costbenefit']:0);
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

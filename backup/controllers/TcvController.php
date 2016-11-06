<?php

class TcvController extends AuthorizedController {

	/**
	 * Tcv Repository
	 *
	 * @var Tcv
	 */
	protected $tcv;

	public function __construct(Tcv $tcv)
	{
        parent::__construct();

        $this->tcv = $tcv;
	}

    public function getIndex($activity_id)
    {
        $tcv = $this->tcv
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($tcv->is_draft) && !$tcv->is_draft){
            $tcv = $tcv->load('items');
            return View::make('tcvs.ajax.show', compact('tcv'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',2)->lists('name', 'name');
        if (sizeof($tcv)<=0)
        {
            return View::make('tcvs.ajax.create', compact('activity','heads'));
        }
        $tcv = $tcv->load('items');

        return View::make('tcvs.ajax.edit', compact('tcv','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Tcv::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $tcv = $this->tcv->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($tcv))
        {
            $new_item = $this->tcv->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Tcv_item;
                $form_item->tcv_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->amount = ($item['amount']?$item['amount']:0);
                $form_item->comment = $item['comment'];
                $form_item->source = $item['source'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($tcv->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Tcv_item::where('tcv_id', '=', $tcv->id)->delete();
                foreach($items as $item){
                    $form_item = new Tcv_item;
                    $form_item->tcv_id = $tcv->id;
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

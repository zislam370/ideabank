<?php

class Form_sp_panelsController extends AuthorizedController {

	/**
	 * Form_sp_panel Repository
	 *
	 * @var Form_sp_panel
	 */
	protected $form_sp_panel;

	public function __construct(Form_sp_panel $form_sp_panel)
	{
        parent::__construct();

        $this->form_sp_panel = $form_sp_panel;
	}

    public function getIndex($activity_id)
    {
        $form_sp_panel = $this->form_sp_panel
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_sp_panel->is_draft) && !$form_sp_panel->is_draft){
            $form_sp_panel = $form_sp_panel->load('items');
            return View::make('form_sp_panels.ajax.show', compact('form_sp_panel'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',11)->lists('name', 'name');
        if (sizeof($form_sp_panel)<=0)
        {
            return View::make('form_sp_panels.ajax.create', compact('activity','heads'));
        }
        $form_sp_panel = $form_sp_panel->load('items');

        return View::make('form_sp_panels.ajax.edit', compact('form_sp_panel','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_sp_panel::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_sp_panel = $this->form_sp_panel->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_sp_panel))
        {
            $new_item = $this->form_sp_panel->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_sp_panel_item;
                $form_item->form_sp_panel_id = $new_item->id;
                $form_item->head = $item['head'];
                $form_item->designation = $item['designation'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_sp_panel->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_sp_panel_item::where('form_sp_panel_id', '=', $form_sp_panel->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_sp_panel_item;
                    $form_item->form_sp_panel_id = $form_sp_panel->id;
                    $form_item->head = $item['head'];
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

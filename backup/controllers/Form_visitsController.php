<?php


class Form_visitsController extends AuthorizedController {

	/**
	 * Form_visit Repository
	 *
	 * @var Form_visit
	 */
	protected $form_visit;

	public function __construct(Form_visit $form_visit)
	{
        parent::__construct();

        $this->form_visit = $form_visit;
	}

    public function getIndex($activity_id)
    {
        $form_visit = $this->form_visit
            ->where('activity_id', $activity_id)
            ->first();
        if(isset($form_visit->is_draft) && !$form_visit->is_draft){
            $form_visit = $form_visit->load('items');
            return View::make('form_visits.ajax.show', compact('form_visit'));
        }
        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',9)->lists('name', 'name');
        if (sizeof($form_visit)<=0)
        {
            return View::make('form_visits.ajax.create', compact('activity','heads'));
        }
        $form_visit = $form_visit->load('items');

        return View::make('form_visits.ajax.edit', compact('form_visit','heads'));
    }

    public function postIndex($activity_id){

        DB::beginTransaction();

        $input = array_except(Input::all(), '_method');
        unset($input['item']);

        $validation = Validator::make($input, Form_visit::$rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $form_visit = $this->form_visit->where('activity_id', '=', $activity_id)->first();
        $flg = false;

        if (empty($form_visit))
        {
            $new_item = $this->form_visit->create($input);
            $items = Input::get('item');
            $flg = true;
            foreach($items as $item){
                $form_item = new Form_visit_item;
                $form_item->form_visit_id = $new_item->id;
                $form_item->location = $item['location'];
                $form_item->purpose = $item['purpose'];
                $form_item->start = $item['start'];
                $form_item->end = $item['end'];
                $form_item->outcome = $item['outcome'];
                $form_item->comment = $item['comment'];
                if(!$form_item->save()){
                    $flg = false;
                }
            }
        }else{
            if ($form_visit->update($input)) {
                $flg = true;
                $items = Input::get('item');
                $affectedRows = Form_visit_item::where('form_visit_id', '=', $form_visit->id)->delete();
                foreach($items as $item){
                    $form_item = new Form_visit_item;
                    $form_item->form_visit_id = $form_visit->id;
                    $form_item->location = $item['location'];
                    $form_item->purpose = $item['purpose'];
                    $form_item->start = $item['start'];
                    $form_item->end = $item['end'];
                    $form_item->outcome = $item['outcome'];
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

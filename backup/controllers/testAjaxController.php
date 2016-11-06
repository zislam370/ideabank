<?php

class testAjax extends BaseController {

    /**
     * Form_fund Repository
     *
     * @var Form_fund
     */
    protected $form_fund;

    public function __construct(Form_fund $form_fund)
    {
        $this->form_fund = $form_fund;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex($activity_id)
    {
        $form_fund = $this->form_fund
            ->where('activity_id', $activity_id)
            ->get();

        $activity = DB::table('idea_step_activities')
            ->where('id', $activity_id)
            ->first();
        $heads = Form_lookup_datum::where('form_lookup_id','=',3)->get();
        if (sizeof($form_fund)<=0)
        {
            return View::make('test_form_funds.create', compact('activity','heads'));
        }

        return View::make('form_funds.edit', compact('activity','form_fund','heads'));
    }

    public function postIndex($activity_id){
        DB::beginTransaction();
        $flg = true;

        $input = array_except(Input::all(), '_method');

        $affectedRows = Form_fund::where('activity_id', '=', $activity_id)->delete();

        foreach($input['fund'] as $fund){

            $form_fund = new Form_fund;

            $form_fund->idea_id = Input::get('idea_id');
            $form_fund->step_id = Input::get('step_id');
            $form_fund->activity_id = Input::get('activity_id');

            $form_fund->head_id = $fund['head_id'];
            $form_fund->amount = $fund['amount'];
            $form_fund->comment = $fund['comment'];
            if(!$form_fund->save()){

                $flg = false;
            }
        }


        if($flg){
//            var_dump($fund);
            DB::commit();
            // Redirect to the form_concept_papers page
            return Redirect::to("idea_step_activities/$activity_id/show")->with('success', Lang::get('form_funds/message.update.success'));
        }
        return;
        DB::rollback();

        // Redirect to the form_concept_papers management page
        return Redirect::to("form_funds/$activity_id")->with('error', Lang::get('form_funds/message.update.error'));
    }

}

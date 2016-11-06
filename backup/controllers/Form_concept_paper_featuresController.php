<?php

class Form_concept_paper_featuresController extends AuthorizedController {

	/**
	 * Form_concept_paper_feature Repository
	 *
	 * @var Form_concept_paper_feature
	 */
	protected $form_concept_paper_feature;

	public function __construct(Form_concept_paper_feature $form_concept_paper_feature)
	{
        parent::__construct();

        $this->form_concept_paper_feature = $form_concept_paper_feature;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $form_concept_paper_features = $this->form_concept_paper_feature->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('form_concept_paper_features.index', compact('form_concept_paper_features'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('form_concept_paper_features.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Form_concept_paper_feature::$rules);

		if ($validation->passes())
		{
			$this->form_concept_paper_feature->create($input);

			return Redirect::route('form_concept_paper_features');
		}

		return Redirect::route('create/form_concept_paper_feature')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{

		$form_concept_paper_feature = $this->form_concept_paper_feature->find($id);

		if (is_null($form_concept_paper_feature))
		{
			return Redirect::route('form_concept_paper_features');
		}

		return View::make('form_concept_paper_features.edit', compact('form_concept_paper_feature'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($id)
	{

		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Form_concept_paper_feature::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$form_concept_paper_feature = $this->form_concept_paper_feature->find($id);

        if ($form_concept_paper_feature->update($input)) {
            // Redirect to the form_concept_paper_features page
            return Redirect::to("form_concept_paper_features/$id/edit")->with('success', Lang::get('form_concept_paper_features/message.update.success'));
        }

        // Redirect to the form_concept_paper_features management page
        return Redirect::to("form_concept_paper_features/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'form_concept_paper_features';
        $confirm_route = $error = null;
        // Check if the form_concept_paper_features exists
        if (is_null($form_concept_paper_feature = $this->form_concept_paper_feature->find($id))) {

            $error = Lang::get('form_concept_paper_features/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/form_concept_paper_feature', array('id'=>$form_concept_paper_feature->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{

        $this->form_concept_paper_feature->find($id)->delete();
        // Redirect to the form_concept_paper_features management page
        return Redirect::route('form_concept_paper_features')->with('success', Lang::get('form_concept_paper_features/message.success.delete'));
	}

}

<?php

class Form_lookup_dataController extends AuthorizedController {

	/**
	 * Form_lookup_datum Repository
	 *
	 * @var Form_lookup_datum
	 */
	protected $form_lookup_datum;

	public function __construct(Form_lookup_datum $form_lookup_datum)
	{
        parent::__construct();

        $this->form_lookup_datum = $form_lookup_datum;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $form_lookup_data = $this->form_lookup_datum->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('form_lookup_data.index', compact('form_lookup_data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        $form_lookups = Form_lookup::lists('name', 'id');

		return View::make('form_lookup_data.create', compact('form_lookups'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Form_lookup_datum::$rules);

		if ($validation->passes())
		{
			$this->form_lookup_datum->create($input);

			return Redirect::route('form_lookup_data');
		}

		return Redirect::route('create/form_lookup_data')
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
        $form_lookups = Form_lookup::lists('name', 'id');


		$form_lookup_datum = $this->form_lookup_datum->find($id);

		if (is_null($form_lookup_datum))
		{
			return Redirect::route('form_lookup_data');
		}

		return View::make('form_lookup_data.edit', compact('form_lookup_datum','form_lookups'));
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
		$validation = Validator::make($input, Form_lookup_datum::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$form_lookup_datum = $this->form_lookup_datum->find($id);

        if ($form_lookup_datum->update($input)) {
            // Redirect to the form_lookup_data page
            return Redirect::to("form_lookup_data/$id/edit")->with('success', Lang::get('form_lookup_data/message.update.success'));
        }

        // Redirect to the form_lookup_data management page
        return Redirect::to("form_lookup_data/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'form_lookup_data';
        $confirm_route = $error = null;
        // Check if the form_lookup_data exists
        if (is_null($form_lookup_datum = $this->form_lookup_datum->find($id))) {

            $error = Lang::get('form_lookup_data/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/form_lookup_datum', array('id'=>$form_lookup_datum->id));
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

        $this->form_lookup_datum->find($id)->delete();
        // Redirect to the form_lookup_data management page
        return Redirect::route('form_lookup_data')->with('success', Lang::get('form_lookup_data/message.success.delete'));
	}

}

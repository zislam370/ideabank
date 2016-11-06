<?php

class Form_lookupsController extends AdminController {

	/**
	 * Form_lookup Repository
	 *
	 * @var Form_lookup
	 */
	protected $form_lookup;

	public function __construct(Form_lookup $form_lookup)
	{
        parent::__construct();

        $this->form_lookup = $form_lookup;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $form_lookups = $this->form_lookup->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('form_lookups.index', compact('form_lookups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('form_lookups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Form_lookup::$rules);

		if ($validation->passes())
		{
			$this->form_lookup->create($input);

			return Redirect::route('form_lookups');
		}

		return Redirect::route('create/form_lookup')
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

		$form_lookup = $this->form_lookup->find($id);

		if (is_null($form_lookup))
		{
			return Redirect::route('form_lookups');
		}

		return View::make('form_lookups.edit', compact('form_lookup'));
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
		$validation = Validator::make($input, Form_lookup::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$form_lookup = $this->form_lookup->find($id);

        if ($form_lookup->update($input)) {
            // Redirect to the form_lookups page
            return Redirect::to("form_lookups/$id/edit")->with('success', Lang::get('form_lookups/message.update.success'));
        }

        // Redirect to the form_lookups management page
        return Redirect::to("form_lookups/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'form_lookups';
        $confirm_route = $error = null;
        // Check if the form_lookups exists
        if (is_null($form_lookup = $this->form_lookup->find($id))) {

            $error = Lang::get('form_lookups/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/form_lookup', array('id'=>$form_lookup->id));
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

        $this->form_lookup->find($id)->delete();
        // Redirect to the form_lookups management page
        return Redirect::route('form_lookups')->with('success', Lang::get('form_lookups/message.success.delete'));
	}

}

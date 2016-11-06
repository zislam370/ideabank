<?php

class NewsmediasController extends AuthorizedController {

	/**
	 * Newsmedia Repository
	 *
	 * @var Newsmedia
	 */
	protected $newsmedia;

	public function __construct(Newsmedia $newsmedia)
	{
        parent::__construct();

        $this->newsmedia = $newsmedia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $newsmedias = $this->newsmedia->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('newsmedias.index', compact('newsmedias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('newsmedias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Newsmedia::$rules);

		if ($validation->passes())
		{
			$this->newsmedia->create($input);

			return Redirect::route('newsmedias');
		}

		return Redirect::route('create/newsmedia')
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

		$newsmedia = $this->newsmedia->find($id);

		if (is_null($newsmedia))
		{
			return Redirect::route('newsmedias');
		}

		return View::make('newsmedias.edit', compact('newsmedia'));
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
		$validation = Validator::make($input, Newsmedia::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$newsmedia = $this->newsmedia->find($id);

        if ($newsmedia->update($input)) {
            // Redirect to the newsmedias page
            return Redirect::to("newsmedias/$id/edit")->with('success', Lang::get('newsmedias/message.update.success'));
        }

        // Redirect to the newsmedias management page
        return Redirect::to("newsmedias/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'newsmedias';
        $confirm_route = $error = null;
        // Check if the newsmedias exists
        if (is_null($newsmedia = $this->newsmedia->find($id))) {

            $error = Lang::get('newsmedias/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/newsmedia', array('id'=>$newsmedia->id));
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

        $this->newsmedia->find($id)->delete();
        // Redirect to the newsmedias management page
        return Redirect::route('newsmedias')->with('success', Lang::get('newsmedias/message.success.delete'));
	}

}

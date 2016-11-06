<?php

class PagesController extends AdminController {

	/**
	 * Page Repository
	 *
	 * @var Page
	 */
	protected $page;

	public function __construct(Page $page)
	{
        parent::__construct();

        $this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $pages = $this->page->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('pages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Page::$rules);

		if ($validation->passes())
		{
			$this->page->create($input);

			return Redirect::route('pages');
		}

		return Redirect::route('create/page')
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

		$page = $this->page->find($id);

		if (is_null($page))
		{
			return Redirect::route('pages');
		}

		return View::make('pages.edit', compact('page'));
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
		$validation = Validator::make($input, Page::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$page = $this->page->find($id);
		$page->update($input);


		// Was the blog tweet updated?
        if ($page->update($input)) {
            // Redirect to the pages page
            return Redirect::to("pages/$id/edit")->with('success', Lang::get('pages/message.update.success'));
        }

        // Redirect to the pages management page
        return Redirect::to("pages/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'pages';
        $confirm_route = $error = null;
        // Check if the pages exists
        if (is_null($page = $this->page->find($id))) {

            $error = Lang::get('pages/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/page', array('id'=>$page->id));
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

        $this->page->find($id)->delete();
        // Redirect to the pages management page
        return Redirect::route('pages')->with('success', Lang::get('pages/message.success.delete'));
	}

}

<?php

class Quick_linksController extends AuthorizedController {

	/**
	 * Quick_link Repository
	 *
	 * @var Quick_link
	 */
	protected $quick_link;

	public function __construct(Quick_link $quick_link)
	{
        parent::__construct();

        $this->quick_link = $quick_link;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $quick_links = $this->quick_link->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('quick_links.index', compact('quick_links'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('quick_links.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Quick_link::$rules);

		if ($validation->passes())
		{
			$this->quick_link->create($input);

			return Redirect::route('quick_links');
		}

		return Redirect::route('create/quick_link')
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

		$quick_link = $this->quick_link->find($id);

		if (is_null($quick_link))
		{
			return Redirect::route('quick_links');
		}

		return View::make('quick_links.edit', compact('quick_link'));
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
		$validation = Validator::make($input, Quick_link::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$quick_link = $this->quick_link->find($id);

        if ($quick_link->update($input)) {
            // Redirect to the quick_links page
            return Redirect::to("quick_links/$id/edit")->with('success', Lang::get('quick_links/message.update.success'));
        }

        // Redirect to the quick_links management page
        return Redirect::to("quick_links/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'quick_links';
        $confirm_route = $error = null;
        // Check if the quick_links exists
        if (is_null($quick_link = $this->quick_link->find($id))) {

            $error = Lang::get('quick_links/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/quick_link', array('id'=>$quick_link->id));
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

        $this->quick_link->find($id)->delete();
        // Redirect to the quick_links management page
        return Redirect::route('quick_links')->with('success', Lang::get('quick_links/message.success.delete'));
	}

}

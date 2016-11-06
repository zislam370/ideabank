<?php

class SectorsController extends AuthorizedController {

	/**
	 * Sector Repository
	 *
	 * @var Sector
	 */
	protected $sector;

	public function __construct(Sector $sector)
	{
        parent::__construct();

        $this->sector = $sector;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $sectors = $this->sector->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('sectors.index', compact('sectors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('sectors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Sector::$rules);

		if ($validation->passes())
		{
			$this->sector->create($input);

			return Redirect::route('sectors');
		}

		return Redirect::route('create/sector')
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

		$sector = $this->sector->find($id);

		if (is_null($sector))
		{
			return Redirect::route('sectors');
		}

		return View::make('sectors.edit', compact('sector'));
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
		$validation = Validator::make($input, Sector::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$sector = $this->sector->find($id);
		$sector->update($input);


		// Was the blog tweet updated?
        if ($sector->update($input)) {
            // Redirect to the sectors page
            return Redirect::to("sectors/$id/edit")->with('success', Lang::get('sectors/message.update.success'));
        }

        // Redirect to the sectors management page
        return Redirect::to("sectors/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'sectors';
        $confirm_route = $error = null;
        // Check if the sectors exists
        if (is_null($sector = $this->sector->find($id))) {

            $error = Lang::get('sectors/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/sector', array('id'=>$sector->id));
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

        $this->sector->find($id)->delete();
        // Redirect to the sectors management page
        return Redirect::route('sectors')->with('success', Lang::get('sectors/message.success.delete'));
	}

}

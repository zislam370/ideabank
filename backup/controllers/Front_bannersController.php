<?php

class Front_bannersController extends AuthorizedController {

	/**
	 * Front_banner Repository
	 *
	 * @var Front_banner
	 */
	protected $front_banner;

	public function __construct(Front_banner $front_banner)
	{
        parent::__construct();

        $this->front_banner = $front_banner;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $front_banners = $this->front_banner->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('front_banners.index', compact('front_banners'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('front_banners.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Front_banner::$rules);

		if ($validation->passes())
		{
			$this->front_banner->create($input);

			return Redirect::route('front_banners');
		}

		return Redirect::route('create/front_banner')
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

		$front_banner = $this->front_banner->find($id);

		if (is_null($front_banner))
		{
			return Redirect::route('front_banners');
		}

		return View::make('front_banners.edit', compact('front_banner'));
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
		$validation = Validator::make($input, Front_banner::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$front_banner = $this->front_banner->find($id);

        if ($front_banner->update($input)) {
            // Redirect to the front_banners page
            return Redirect::to("front_banners/$id/edit")->with('success', Lang::get('front_banners/message.update.success'));
        }

        // Redirect to the front_banners management page
        return Redirect::to("front_banners/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'front_banners';
        $confirm_route = $error = null;
        // Check if the front_banners exists
        if (is_null($front_banner = $this->front_banner->find($id))) {

            $error = Lang::get('front_banners/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/front_banner', array('id'=>$front_banner->id));
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

        $this->front_banner->find($id)->delete();
        // Redirect to the front_banners management page
        return Redirect::route('front_banners')->with('success', Lang::get('front_banners/message.success.delete'));
	}

}

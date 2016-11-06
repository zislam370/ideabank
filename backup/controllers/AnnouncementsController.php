<?php

class AnnouncementsController extends AuthorizedController {

	/**
	 * Announcement Repository
	 *
	 * @var Announcement
	 */
	protected $announcement;

	public function __construct(Announcement $announcement)
	{
        parent::__construct();

        $this->announcement = $announcement;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $announcements = $this->announcement->with('user')->orderBy('created_at', 'DESC')->paginate(10);
//        $announcements = $announcements->load('user');
        return View::make('announcements.index', compact('announcements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('announcements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Announcement::$rules);

        $input['user_id']  = Sentry::getUser()->id;
        $input['publish'] = isset($input['publish'])?$input['publish']:'0';
		if ($validation->passes())
		{

			$this->announcement->create($input);

			return Redirect::route('announcements');
		}

		return Redirect::route('create/announcement')
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

		$announcement = $this->announcement->find($id);

		if (is_null($announcement))
		{
			return Redirect::route('announcements');
		}

		return View::make('announcements.edit', compact('announcement'));
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
		$validation = Validator::make($input, Announcement::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$announcement = $this->announcement->find($id);
//        var_dump($input);return;
        $input['publish'] = isset($input['publish'])?$input['publish']:'0';
        if ($announcement->update($input)) {
            // Redirect to the announcements page
            return Redirect::to("announcements/$id/edit")->with('success', Lang::get('announcements/message.update.success'));
        }

        // Redirect to the announcements management page
        return Redirect::to("announcements/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'announcements';
        $confirm_route = $error = null;
        // Check if the announcements exists
        if (is_null($announcement = $this->announcement->find($id))) {

            $error = Lang::get('announcements/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/announcement', array('id'=>$announcement->id));
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

        $this->announcement->find($id)->delete();
        // Redirect to the announcements management page
        return Redirect::route('announcements')->with('success', Lang::get('announcements/message.success.delete'));
	}

}

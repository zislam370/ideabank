<?php

class Idea_step_activity_attachmentsController extends AuthorizedController {

	/**
	 * Idea_step_activity_attachment Repository
	 *
	 * @var Idea_step_activity_attachment
	 */
	protected $idea_step_activity_attachment;

	public function __construct(Idea_step_activity_attachment $idea_step_activity_attachment)
	{
        parent::__construct();

        $this->idea_step_activity_attachment = $idea_step_activity_attachment;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $idea_step_activity_attachments = $this->idea_step_activity_attachment->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('idea_step_activity_attachments.index', compact('idea_step_activity_attachments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($activity_id)
	{
		return View::make('idea_step_activity_attachments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate($activity_id)
	{
		$input = Input::all();
		$validation = Validator::make($input, Idea_step_activity_attachment::$rules);

		if ($validation->passes())
		{
			$this->idea_step_activity_attachment->create($input);

			return Redirect::route('show/idea_step_activity',$activity_id);
		}

		return Redirect::route('show/idea_step_activity',$activity_id)
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

		$idea_step_activity_attachment = $this->idea_step_activity_attachment->find($id);

		if (is_null($idea_step_activity_attachment))
		{
			return Redirect::route('idea_step_activity_attachments');
		}

		return View::make('idea_step_activity_attachments.edit', compact('idea_step_activity_attachment'));
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
		$validation = Validator::make($input, Idea_step_activity_attachment::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$idea_step_activity_attachment = $this->idea_step_activity_attachment->find($id);

        if ($idea_step_activity_attachment->update($input)) {
            // Redirect to the idea_step_activity_attachments page
            return Redirect::to("idea_step_activity_attachments/$id/edit")->with('success', Lang::get('idea_step_activity_attachments/message.update.success'));
        }

        // Redirect to the idea_step_activity_attachments management page
        return Redirect::to("idea_step_activity_attachments/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_step_activity_attachments';
        $confirm_route = $error = null;
        // Check if the idea_step_activity_attachments exists
        if (is_null($idea_step_activity_attachment = $this->idea_step_activity_attachment->find($id))) {

            $error = Lang::get('idea_step_activity_attachments/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_step_activity_attachment', array('id'=>$idea_step_activity_attachment->id));
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

        $this->idea_step_activity_attachment->find($id)->delete();
        // Redirect to the idea_step_activity_attachments management page
        return Redirect::back()->with('success', Lang::get('idea_step_activity_attachments/message.success.delete'));
	}

}

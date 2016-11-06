<?php

class Idea_step_activity_historiesController extends AuthorizedController {

	/**
	 * Idea_step_activity_history Repository
	 *
	 * @var Idea_step_activity_history
	 */
	protected $idea_step_activity_history;

	public function __construct(Idea_step_activity_history $idea_step_activity_history)
	{
        parent::__construct();

        $this->idea_step_activity_history = $idea_step_activity_history;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $idea_step_activity_histories = $this->idea_step_activity_history->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('idea_step_activity_histories.index', compact('idea_step_activity_histories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('idea_step_activity_histories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Idea_step_activity_history::$rules);

		if ($validation->passes())
		{
			$this->idea_step_activity_history->create($input);

			return Redirect::route('idea_step_activity_histories');
		}

		return Redirect::route('create/idea_step_activity_history')
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

		$idea_step_activity_history = $this->idea_step_activity_history->find($id);

		if (is_null($idea_step_activity_history))
		{
			return Redirect::route('idea_step_activity_histories');
		}

		return View::make('idea_step_activity_histories.edit', compact('idea_step_activity_history'));
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
		$validation = Validator::make($input, Idea_step_activity_history::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$idea_step_activity_history = $this->idea_step_activity_history->find($id);

        if ($idea_step_activity_history->update($input)) {
            // Redirect to the idea_step_activity_histories page
            return Redirect::to("idea_step_activity_histories/$id/edit")->with('success', Lang::get('idea_step_activity_histories/message.update.success'));
        }

        // Redirect to the idea_step_activity_histories management page
        return Redirect::to("idea_step_activity_histories/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_step_activity_histories';
        $confirm_route = $error = null;
        // Check if the idea_step_activity_histories exists
        if (is_null($idea_step_activity_history = $this->idea_step_activity_history->find($id))) {

            $error = Lang::get('idea_step_activity_histories/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_step_activity_history', array('id'=>$idea_step_activity_history->id));
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

        $this->idea_step_activity_history->find($id)->delete();
        // Redirect to the idea_step_activity_histories management page
        return Redirect::route('idea_step_activity_histories')->with('success', Lang::get('idea_step_activity_histories/message.success.delete'));
	}

}

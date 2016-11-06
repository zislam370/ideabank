<?php

class Idea_capitalizationsController extends BaseController {

	/**
	 * Idea_capitalization Repository
	 *
	 * @var Idea_capitalization
	 */
	protected $idea_capitalization;

	public function __construct(Idea_capitalization $idea_capitalization)
	{
		$this->idea_capitalization = $idea_capitalization;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $idea_capitalizations = $this->idea_capitalization->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('idea_capitalizations.index', compact('idea_capitalizations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('idea_capitalizations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Idea_capitalization::$rules);

		if ($validation->passes())
		{
			$this->idea_capitalization->create($input);

			return Redirect::route('idea_capitalizations');
		}

		return Redirect::route('create/idea_capitalization')
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

		$idea_capitalization = $this->idea_capitalization->find($id);

		if (is_null($idea_capitalization))
		{
			return Redirect::route('idea_capitalizations');
		}

		return View::make('idea_capitalizations.edit', compact('idea_capitalization'));
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
		$validation = Validator::make($input, Idea_capitalization::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$idea_capitalization = $this->idea_capitalization->find($id);

        if ($idea_capitalization->update($input)) {
            // Redirect to the idea_capitalizations page
            return Redirect::to("idea_capitalizations/$id/edit")->with('success', Lang::get('idea_capitalizations/message.update.success'));
        }

        // Redirect to the idea_capitalizations management page
        return Redirect::to("idea_capitalizations/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_capitalizations';
        $confirm_route = $error = null;
        // Check if the idea_capitalizations exists
        if (is_null($idea_capitalization = $this->idea_capitalization->find($id))) {

            $error = Lang::get('idea_capitalizations/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_capitalization', array('id'=>$idea_capitalization->id));
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

        $this->idea_capitalization->find($id)->delete();
        // Redirect to the idea_capitalizations management page
        return Redirect::route('idea_capitalizations')->with('success', Lang::get('idea_capitalizations/message.success.delete'));
	}

}

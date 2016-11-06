<?php

class EventsController extends AuthorizedController {

	/**
	 * event Repository
	 *
	 * @var event
	 */

	protected $event;

	public function __construct(event $event)
	{
		$this->event = $event;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $events = $this->event
            ->with('workflow_category')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return View::make('events.index', compact('events'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
    {
        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');
        return View::make('events.create', compact('workflow_categories','priority'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, event::$rules);
		if ($validation->passes())
		{
			$this->event->create($input);

            $priority = Event::firstOrNew(array('priority' => Input::get('priority')));
            $priority->priority = Input::get('priority');
            $priority->save();

            //var_dump($input); return;
			return Redirect::route('events');
		}
		return Redirect::route('create/event')
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

		$event = $this->event->find($id);

		if (is_null($event))
		{
			return Redirect::route('events');
		}

        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');

		return View::make('events.edit', compact('event','workflow_categories'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getView($id)
	{

		$event = $this->event->with('workflow_category')->find($id);

		if (is_null($event))
		{
			return Redirect::route('events');
		}

        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');

		return View::make('events.show', compact('event','workflow_categories'));
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
		$validation = Validator::make($input, event::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$event = $this->event->find($id);

        if ($event->update($input)) {
            // Redirect to the events page
            return Redirect::to("events/$id/edit")->with('success', Lang::get('events/message.update.success'));
        }

        // Redirect to the events management page
        return Redirect::to("events/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'events';
        $confirm_route = $error = null;
        // Check if the events exists
        if (is_null($event = $this->event->find($id))) {

            $error = Lang::get('events/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/event', array('id'=>$event->id));
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

        $this->event->find($id)->delete();
        // Redirect to the events management page
        return Redirect::route('events')->with('success', Lang::get('events/message.success.delete'));
	}

}

<?php

class AdvertisementsController extends AuthorizedController {

	/**
	 * Advertisement Repository
	 *
	 * @var Advertisement
	 */

	protected $advertisement;

	public function __construct(Advertisement $advertisement)
	{
		$this->advertisement = $advertisement;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $advertisements = $this->advertisement
            ->with('workflow_category')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return View::make('advertisements.index', compact('advertisements'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getPriorityList()
	{
	    $advertisements = $this->advertisement
            ->with('workflow_category')
            ->orderBy('priority', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return View::make('advertisements.priority_list', compact('advertisements'));
	}
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function setPriority($id,$priority)
    {
        DB::beginTransaction();
        // set all others priority to 0
        $this->advertisement->where('priority',$priority)->update(array('priority'=>0));
        $advertisement = $this->advertisement->find($id);
        $input['priority'] = $priority;
        if ($advertisement->update($input)) {
            // Redirect to the advertisements page
            DB::commit();
            return Redirect::back()->with('success', Lang::get('advertisements/message.update.success'));
        }
        DB::rollback();
        return Redirect::back()->with('error', Lang::get('tweets/message.update.error'));
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');


        return View::make('advertisements.create', compact('workflow_categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Advertisement::$rules);

		if ($validation->passes())
		{

            $input['start'] = date('Y-m-d',strtotime(e(Input::get('start'))));
            $input['end'] = date('Y-m-d',strtotime(e(Input::get('end'))));

			$this->advertisement->create($input);

			return Redirect::route('advertisements');
		}

		return Redirect::route('create/advertisement')
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

		$advertisement = $this->advertisement->find($id);

		if (is_null($advertisement))
		{
			return Redirect::route('advertisements');
		}

        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');

		return View::make('advertisements.edit', compact('advertisement','workflow_categories'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getView($id)
	{

		$advertisement = $this->advertisement->with('workflow_category')->find($id);

		if (is_null($advertisement))
		{
			return Redirect::route('advertisements');
		}

        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');

		return View::make('advertisements.show', compact('advertisement','workflow_categories'));
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
		$validation = Validator::make($input, Advertisement::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$advertisement = $this->advertisement->find($id);

        $input['start'] = date('Y-m-d',strtotime(e(Input::get('start'))));
        $input['end'] = date('Y-m-d',strtotime(e(Input::get('end'))));

        if ($advertisement->update($input)) {
            // Redirect to the advertisements page
            return Redirect::to("advertisements/$id/edit")->with('success', Lang::get('advertisements/message.update.success'));
        }

        // Redirect to the advertisements management page
        return Redirect::to("advertisements/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'advertisements';
        $confirm_route = $error = null;
        // Check if the advertisements exists
        if (is_null($advertisement = $this->advertisement->find($id))) {

            $error = Lang::get('advertisements/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/advertisement', array('id'=>$advertisement->id));
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

        $this->advertisement->find($id)->delete();
        // Redirect to the advertisements management page
        return Redirect::route('advertisements')->with('success', Lang::get('advertisements/message.delete.success'));
	}

}

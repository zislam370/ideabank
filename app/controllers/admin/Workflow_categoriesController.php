<?php

class Workflow_categoriesController extends AdminController {

	/**
	 * Workflow_category Repository
	 *
	 * @var Workflow_category
	 */
	protected $workflow_category;

	public function __construct(Workflow_category $workflow_category)
	{
        parent::__construct();

        $this->workflow_category = $workflow_category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $workflow_categories = $this->workflow_category->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('workflow_categories.index', compact('workflow_categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        $groups = Group::lists('name', 'id');
		return View::make('workflow_categories.create',compact('groups'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Workflow_category::$rules);
        $groups = Input::get('groups');
        if($groups!=null){
            $input['groups']  = implode(',',Input::get('groups'));
        }
		if ($validation->passes())
		{
			$this->workflow_category->create($input);

			return Redirect::route('workflow_categories');
		}

		return Redirect::route('create/workflow_category')
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

		$workflow_category = $this->workflow_category->find($id);

		if (is_null($workflow_category))
		{
			return Redirect::route('workflow_categories');
		}
        $groups = Group::lists('name', 'id');
		return View::make('workflow_categories.edit', compact('workflow_category','groups'));
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
		$validation = Validator::make($input, Workflow_category::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$workflow_category = $this->workflow_category->find($id);

        $groups = Input::get('groups');
        if($groups!=null){
            $groups  = implode(',',Input::get('groups'));
        }
        $input['groups']  = $groups;

        if ($workflow_category->update($input)) {
            // Redirect to the workflow_categories page
            return Redirect::to("workflow_categories/$id/edit")->with('success', Lang::get('workflow_categories/message.update.success'));
        }

        // Redirect to the workflow_categories management page
        return Redirect::to("workflow_categories/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'workflow_categories';
        $confirm_route = $error = null;
        // Check if the workflow_categories exists
        if (is_null($workflow_category = $this->workflow_category->find($id))) {

            $error = Lang::get('workflow_categories/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/workflow_category', array('id'=>$workflow_category->id));
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

        $this->workflow_category->find($id)->delete();
        // Redirect to the workflow_categories management page
        return Redirect::route('workflow_categories')->with('success', Lang::get('workflow_categories/message.success.delete'));
	}

}

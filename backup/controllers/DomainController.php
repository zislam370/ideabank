<?php

class DomainController extends AuthorizedController {

    /**
     * Domain Repository
     *
     * @var Domain
     */
    protected $domain;

    public function __construct(Domain $domain)
    {
        parent::__construct();

        $this->domain = $domain;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $domains = $this->domain->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('domains.index', compact('domains'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getDomainsByType($typeid)
    {
        $domains = $this->domain->select('id','name')->where('type_id', $typeid)->get();

        return $domains;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getDomainsById($id)
    {
        $domains = $this->domain->select('id','name')->where('parent_id', $id)->get();

        return $domains;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $input = Input::all();
        $validation = Validator::make($input, Domain::$rules);

        if ($validation->passes())
        {
            $this->domain->create($input);

            return Redirect::route('domains');
        }

        return Redirect::route('create/domain')
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

        $domain = $this->domain->find($id);

        if (is_null($domain))
        {
            return Redirect::route('domains');
        }

        return View::make('domains.edit', compact('domain'));
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
        $validation = Validator::make($input, Domain::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $domain = $this->domain->find($id);

        if ($domain->update($input)) {
            // Redirect to the domains page
            return Redirect::to("domains/$id/edit")->with('success', Lang::get('domains/message.update.success'));
        }

        // Redirect to the domains management page
        return Redirect::to("domains/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'domains';
        $confirm_route = $error = null;
        // Check if the domains exists
        if (is_null($domain = $this->domain->find($id))) {

            $error = Lang::get('domains/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/domain', array('id'=>$domain->id));
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

        $this->domain->find($id)->delete();
        // Redirect to the domains management page
        return Redirect::route('domains')->with('success', Lang::get('domains/message.success.delete'));
    }

}

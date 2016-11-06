<?php

class Idea_ownerController extends AuthorizedController {

    /**
     * Idea_owner Repository
     *
     * @var Idea_owner
     */
    protected $idea_owner;

    public function __construct(Idea_owner $idea_owner)
    {
        parent::__construct();

        $this->idea_owner = $idea_owner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getOwners($ideaid)
    {
        //check for if idea exist

        $idea_owners = $this->idea_owner->where('idea_id',$ideaid)->get();
//        foreach($idea_owners as $owner)
//            var_dump($owner);
//        return;
        return View::make('idea_owners.index', compact('idea_owners','ideaid'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getActivate($id)
    {
        $this->idea_owner->where('id',$id)->update(array('active'=>1));

        return Redirect::back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getDeactivate($id)
    {
        $this->idea_owner->where('id',$id)->update(array('active'=>0));

        return Redirect::back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate($ideaid)
    {
//        $input = Input::all();
        try{


            $owner_mobile = e(Input::get('owner_mobile'));
            $user = User::select('id')->where('mobile',$owner_mobile)->first();
            if($user){
                $input['user_id'] = $user->id;
                $input['idea_id'] = $ideaid;
                $input['active'] = 1;
                $this->idea_owner->create($input);

                return Redirect::back();
            }

        }catch(\Exception $e){
        }

        return Redirect::back()
            ->with('error', 'User Not found.');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('idea_owners.create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {

        $idea_owner = $this->idea_owner->find($id);

        if (is_null($idea_owner))
        {
            return Redirect::route('idea_owners');
        }

        return View::make('idea_owners.edit', compact('idea_owner'));
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
        $validation = Validator::make($input, Idea_owner::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $idea_owner = $this->idea_owner->find($id);

        if ($idea_owner->update($input)) {
            // Redirect to the idea_owners page
            return Redirect::to("idea_owners/$id/edit")->with('success', Lang::get('idea_owners/message.update.success'));
        }

        // Redirect to the idea_owners management page
        return Redirect::to("idea_owners/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_owners';
        $confirm_route = $error = null;
        // Check if the idea_owners exists
        if (is_null($idea_owner = $this->idea_owner->find($id))) {

            $error = Lang::get('idea_owners/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_owner', array('id'=>$idea_owner->id));
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

        $this->idea_owner->find($id)->delete();
        // Redirect to the idea_owners management page
        return Redirect::route('idea_owners')->with('success', Lang::get('idea_owners/message.success.delete'));
    }

}

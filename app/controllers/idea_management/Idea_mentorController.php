<?php

class Idea_mentorController extends AuthorizedController {

    /**
     * Idea_mentor Repository
     *
     * @var Idea_mentor
     */
    protected $idea_mentor;

    public function __construct(Idea_mentor $idea_mentor)
    {
        parent::__construct();

        $this->idea_mentor = $idea_mentor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getMentors($ideaid)
    {
        //check for if idea exist

        $idea_mentors = $this->idea_mentor->where('idea_id',$ideaid)->get();
//        foreach($idea_mentors as $mentor)
//            var_dump($mentor);
//        return;
        return View::make('idea_mentors.index', compact('idea_mentors','ideaid'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getActivate($id)
    {
        $this->idea_mentor->where('id',$id)->update(array('active'=>1));

        return Redirect::back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getDeactivate($id)
    {
        $this->idea_mentor->where('id',$id)->update(array('active'=>0));

        return Redirect::back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate($ideaid)
    {

        try{

            $mentor_mobile = e(Input::get('mentor_mobile'));
            $user = User::select('id')->where('mobile',$mentor_mobile)->first();
            if($user){
                $input['user_id'] = $user->id;
                $input['idea_id'] = $ideaid;
                $input['active'] = 1;
                $this->idea_mentor->create($input);

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
        return View::make('idea_mentors.create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {

        $idea_mentor = $this->idea_mentor->find($id);

        if (is_null($idea_mentor))
        {
            return Redirect::route('idea_mentors');
        }

        return View::make('idea_mentors.edit', compact('idea_mentor'));
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
        $validation = Validator::make($input, Idea_mentor::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $idea_mentor = $this->idea_mentor->find($id);

        if ($idea_mentor->update($input)) {
            // Redirect to the idea_mentors page
            return Redirect::to("idea_mentors/$id/edit")->with('success', Lang::get('idea_mentors/message.update.success'));
        }

        // Redirect to the idea_mentors management page
        return Redirect::to("idea_mentors/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_mentors';
        $confirm_route = $error = null;
        // Check if the idea_mentors exists
        if (is_null($idea_mentor = $this->idea_mentor->find($id))) {

            $error = Lang::get('idea_mentors/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_mentor', array('id'=>$idea_mentor->id));
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

        $this->idea_mentor->find($id)->delete();
        // Redirect to the idea_mentors management page
        return Redirect::route('idea_mentors')->with('success', Lang::get('idea_mentors/message.success.delete'));
    }

}

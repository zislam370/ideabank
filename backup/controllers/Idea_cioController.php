<?php

class Idea_cioController extends AuthorizedController {

    /**
     * Idea_cio Repository
     *
     * @var Idea_cio
     */
    protected $idea_cio;

    public function __construct(Idea_cio $idea_cio)
    {
        parent::__construct();

        $this->idea_cio = $idea_cio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getCios($ideaid)
    {
        //check for if idea exist

        $idea_cios = $this->idea_cio->where('idea_id',$ideaid)->get();
//        foreach($idea_cios as $cio)
//            var_dump($cio);
//        return;
        return View::make('idea_cios.index', compact('idea_cios','ideaid'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getActivate($id)
    {
        $this->idea_cio->where('id',$id)->update(array('active'=>1));

        return Redirect::back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getDeactivate($id)
    {
        $this->idea_cio->where('id',$id)->update(array('active'=>0));

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

            $cio_mobile = e(Input::get('cio_mobile'));
            $user = User::select('id')->where('mobile',$cio_mobile)->first();
            if($user){
                $input['user_id'] = $user->id;
                $input['idea_id'] = $ideaid;
                $input['active'] = 1;
                $this->idea_cio->create($input);

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
        return View::make('idea_cios.create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {

        $idea_cio = $this->idea_cio->find($id);

        if (is_null($idea_cio))
        {
            return Redirect::route('idea_cios');
        }

        return View::make('idea_cios.edit', compact('idea_cio'));
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
        $validation = Validator::make($input, Idea_cio::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $idea_cio = $this->idea_cio->find($id);

        if ($idea_cio->update($input)) {
            // Redirect to the idea_cios page
            return Redirect::to("idea_cios/$id/edit")->with('success', Lang::get('idea_cios/message.update.success'));
        }

        // Redirect to the idea_cios management page
        return Redirect::to("idea_cios/$id/edit")->with('error', Lang::get('idea_cios/message.update.error'));
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'idea_cios';
        $confirm_route = $error = null;
        // Check if the idea_cios exists
        if (is_null($idea_cio = $this->idea_cio->find($id))) {

            $error = Lang::get('idea_cios/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea_cio', array('id'=>$idea_cio->id));
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

        $this->idea_cio->find($id)->delete();
        // Redirect to the idea_cios management page
        return Redirect::route('idea_cios')->with('success', Lang::get('idea_cios/message.success.delete'));
    }

}

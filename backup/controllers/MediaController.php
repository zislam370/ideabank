<?php

class MediaController extends AuthorizedController {

    /**
     * Media Repository
     *
     * @var Media
     */
    protected $media;

    public function __construct(Media $media)
    {
        parent::__construct();

        $this->media = $media;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $medias = $this->media->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('medias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $input = Input::all();
        $validation = Validator::make($input, Media::$rules);

        if ($validation->passes())
        {
            $this->media->create($input);

            return Redirect::route('medias');
        }

        return Redirect::route('create/media')
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

        $media = $this->media->find($id);

        if (is_null($media))
        {
            return Redirect::route('medias');
        }

        return View::make('medias.edit', compact('media'));
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
        $validation = Validator::make($input, Media::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
        $media = $this->media->find($id);

        if ($media->update($input)) {
            // Redirect to the medias page
            return Redirect::to("medias/$id/edit")->with('success', Lang::get('medias/message.update.success'));
        }

        // Redirect to the medias management page
        return Redirect::to("medias/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'medias';
        $confirm_route = $error = null;
        // Check if the medias exists
        if (is_null($media = $this->media->find($id))) {

            $error = Lang::get('medias/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/media', array('id'=>$media->id));
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

        $this->media->find($id)->delete();
        // Redirect to the medias management page
        return Redirect::route('medias')->with('success', Lang::get('medias/message.success.delete'));
    }

}

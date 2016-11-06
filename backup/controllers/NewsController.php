<?php

class NewsController extends BaseController {

	/**
	 * News Repository
	 *
	 * @var News
	 */
	protected $news;

	public function __construct(News $news)
	{
		$this->news = $news;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $news = $this->news->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('news.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, News::$rules);

		if ($validation->passes())
		{
			$this->news->create($input);

			return Redirect::route('news');
		}

		return Redirect::route('create/news')
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

		$news = $this->news->find($id);

		if (is_null($news))
		{
			return Redirect::route('news');
		}

		return View::make('news.edit', compact('news'));
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
		$validation = Validator::make($input, News::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$news = $this->news->find($id);

        if ($news->update($input)) {
            // Redirect to the news page
            return Redirect::to("news/$id/edit")->with('success', Lang::get('news/message.update.success'));
        }

        // Redirect to the news management page
        return Redirect::to("news/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'news';
        $confirm_route = $error = null;
        // Check if the news exists
        if (is_null($news = $this->news->find($id))) {

            $error = Lang::get('news/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/news', array('id'=>$news->id));
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

        $this->news->find($id)->delete();
        // Redirect to the news management page
        return Redirect::route('news')->with('success', Lang::get('news/message.success.delete'));
	}

}

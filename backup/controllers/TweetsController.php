<?php


class TweetsController extends BaseController {

	/**
	 * Tweet Repository
	 *
	 * @var Tweet
	 */
	protected $tweet;

	public function __construct(Tweet $tweet)
	{
		$this->tweet = $tweet;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return View
	 */
	public function getIndex()
	{
        $tweets = $this->tweet->orderBy('created_at', 'DESC')->paginate(10);
		return View::make('tweets.index', compact('tweets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('tweets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tweet::$rules);

		if ($validation->passes())
		{
			$this->tweet->create($input);

			return Redirect::route('tweets');
		}
		return Redirect::route('create/tweet')
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
	public function getEdit($tweetId = null)
	{
		$tweet = $this->tweet->find($tweetId);

		if (is_null($tweet))
		{
			return Redirect::route('tweets');
		}

		return View::make('tweets.edit', compact('tweet'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($tweetId = null)
	{
        // Check if the blog tweet exists
        if (is_null($tweet = $this->tweet->find($tweetId))) {
            // Redirect to the blogs management page
            return Redirect::to('tweets')->with('error', Lang::get('tweets/message.does_not_exist'));
        }

        // Declare the rules for the form validation
        $rules = array(
            'author' => 'required',
            'body' => 'required'
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Update the blog tweet data
        $tweet->author            = e(Input::get('author'));
        $tweet->body             = e(Input::get('body'));

        // Was the blog tweet updated?
        if ($tweet->save()) {
            // Redirect to the new blog tweet page
            return Redirect::to("tweets/$tweetId/edit")->with('success', Lang::get('tweets/message.update.success'));
        }

        // Redirect to the blogs tweet management page
        return Redirect::to("tweets/$tweetId/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

    /**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'tweets';
        $confirm_route = $error = null;
        // Check if the blog tweet exists
        if (is_null($tweet = $this->tweet->find($id))) {

            $error = Lang::get('tweets/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/tweet', array('id'=>$tweet->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id = null)
	{
        $this->tweet->find($id)->delete();
        // Redirect to the tweet management page
        return Redirect::route('tweets')->with('success', Lang::get('tweets/message.success.delete'));
	}

}

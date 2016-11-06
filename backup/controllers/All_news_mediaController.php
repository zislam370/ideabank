<?php
class All_news_mediaController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */
    public function showHome()
    {
        // Get the user information
        $user = Sentry::getUser();
//      var_dump($user); return;
        $applicant = Sentry::findGroupByName('Applicant');
        //var_dump($applicant); return;
        $today = date("Y-m-d");
        $front_banners = Front_banner::get();
        $idea = Idea::get();
//      $page = $this->page->orderBy('created_at', 'DESC')->paginate(10);
        $newsmedias = DB::select( DB::raw("SELECT * FROM (
SELECT priority, created_at, title, slide_title, img_file_name FROM `newsmedias`
) AS tt
ORDER BY priority, created_at ASC"));
            return View::make('frontend/all_news_media',compact('newsmedias'));
    }
}
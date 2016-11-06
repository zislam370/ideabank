<?php
class Running_projectController extends BaseController
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
        $ideas = DB::select( DB::raw("SELECT * FROM (
SELECT priority, created_at,`name`, workflow_category_id FROM ideas
) AS tt
ORDER BY priority, created_at,`name`, workflow_category_id  ASC
;"));
        $workflow_categories = DB::select( DB::raw("SELECT ideas.name, workflow_categories.name AS workflow_name, ideas.`priority`
FROM ideas
INNER JOIN workflow_categories ON ideas.workflow_category_id = workflow_categories.id
ORDER BY priority DESC
"));
            return View::make('frontend/running_projects',compact('ideas','workflow_categories'));
    }
}
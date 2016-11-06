<?php
class HomeController extends BaseController
{

    public function getIdeaList(){

        $ideas = Idea::with('author')
                ->orderBy('priority', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate();
        if (is_null($ideas))
        {
            return Redirect::route('home');
        }

        return View::make('ideas.public_list', compact('ideas'));
    }

    public function getIdeaView($ideaId){

        $idea = Idea::with('author')->find($ideaId);

        return View::make('ideas.public_view', compact('idea'));
    }

    /**
     * Show Event View for public view
     *
     * @param  int  $id
     * @return Response
     */
    public function getEventList()
    {

        $events = Advertisement::with('workflow_category')
            ->orderBy('priority', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate();

        if (is_null($events))
        {
            return Redirect::route('home');
        }

//        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');

        return View::make('advertisements.public_list', compact('events'));
    }
    /**
     * Show Event View for public view
     *
     * @param  int  $id
     * @return Response
     */
    public function getEventView($id)
    {

        $advertisement = Advertisement::with('workflow_category')->find($id);

        if (is_null($advertisement))
        {
            return Redirect::route('advertisements');
        }

        $workflow_categories = Workflow_category::where('is_periodical','=','1')->lists('name', 'id');

        return View::make('advertisements.public_show', compact('advertisement','workflow_categories'));
    }

    public function showHome()
    {
        // Get the user information
        $user = Sentry::getUser();
//      var_dump($user); return;
        $applicant = Sentry::findGroupByName('Applicant');
        //var_dump($applicant); return;
        $today = date("Y-m-d");


        $front_banners = Front_banner::get();

        $newsmedias = Post::orderBy('priority', 'DESC')
                            ->orderBy('priority', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->take(6)->skip(0)->get();
        $posts = $newsmedias;
        $completed_ideas = Idea::where('ideas.is_opened','1')
                        ->where('ideas.is_closed','1')
                        ->orderBy('priority', 'DESC')
                        ->orderBy('ideas.created_at', 'DESC')
                        ->take(3)->skip(0)->get();
        $running_ideas = Idea::where('ideas.is_opened','1')
                        ->where('ideas.is_closed','0')
                        ->orderBy('priority', 'DESC')
                        ->orderBy('ideas.created_at', 'DESC')
                        ->take(3)->skip(0)->get();

        $today = date("Y-m-d");
        $events = Advertisement::where('end', '>', $today)
            ->where('start', '<', $today)
            ->get();
        $adverts = $events;
        $upcoming_events = Advertisement::where('start', '>', $today)->get();

        $totalideas = DB::select( DB::raw("SELECT COUNT(id) AS total_idea FROM ideas"));
        $totalamounts = DB::select( DB::raw("SELECT SUM(amount) AS total_amount FROM form_budget_items"));
        $runnings = DB::select( DB::raw("SELECT COUNT(is_opened) AS running FROM ideas WHERE is_opened IS NOT NULL"));
        $completes = DB::select( DB::raw("SELECT COUNT(is_closed) AS complete FROM ideas WHERE is_closed IS NOT NULL"));
        $sifs = DB::select( DB::raw("SELECT COUNT(workflow_category_id) AS sif FROM ideas WHERE workflow_category_id = 1"));
        $idea_stat = $this->get_idea_stats();
      // var_dump($colpmetes); return;
            return View::make('frontend/home',compact('idea_stat','posts', 'adverts', 'completed_ideas','running_ideas', 'sifs','completes','runnings','totalamounts','totalideas','user','adverts','front_banners','newsmedias','events','upcoming_events','total'));
    }

    public function url()
    {
        return URL::route('view-post', $this->slug);
    }
    private function get_idea_stats(){
        $idea_stat = DB::select( DB::raw("
                        SELECT
                        COUNT(CASE WHEN is_sorted = 1
                        THEN id
                        END) AS 'application' ,

                        COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                        THEN id
                        END) AS 'running' ,

                        COUNT(CASE WHEN is_closed = 1 AND (is_exited IS NULL OR is_exited = 0)
                        THEN id
                        END) AS 'completed'

                        FROM ideas
                    "));
        return $idea_stat[0];
    }
}
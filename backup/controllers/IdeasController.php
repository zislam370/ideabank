<?php

//use AuthorizedController;

class IdeasController extends AuthorizedController {

	/**
	 * Idea Repository
	 *
	 * @var Idea
	 */
	protected $idea;

	public function __construct(Idea $idea)
	{
        parent::__construct();
		$this->idea = $idea;
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getCompletedList()
    {
        $ideas = Idea::with('category','advertisement');

        if (Input::get('name')) {
            $ideas = $ideas->where('ideas.name','LIKE', '%'.e(Input::get('name')).'%');
        }
        if (Input::get('first_name')) {
            $ideas = $ideas
                ->join('users', 'users.id', '=', 'ideas.user_id')
                ->where('users.first_name','LIKE', '%'.e(Input::get('first_name')).'%');
        }
        if (Input::get('advertisement_id')) {
            $ad_id = explode("-",e(Input::get('advertisement_id')));
            if(sizeof($ad_id)>1){
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0])
                    ->where('ideas.advertisement_id','=',$ad_id[1]);
            }else{
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0]);
            }
        }

        if (Input::get('sub_from')) {
            $ideas = $ideas->where('ideas.created_at', '<=', date('Y-m-d',strtotime(e(Input::get('sub_from')))));
        }
        if (Input::get('sub_to')) {
            $ideas = $ideas->where('ideas.created_at', '>=', date('Y-m-d',strtotime(e(Input::get('sub_to')))));
        }

        $ideas = $ideas
            ->where('ideas.is_opened','1')
            ->where('ideas.is_closed','1')
            ->where('ideas.is_exited','0')
            ->orderBy('priority', 'DESC')
            ->orderBy('ideas.created_at', 'DESC')
            ->paginate(10);

        $workflow_categories = DB::select( DB::raw("SELECT id, w.`name`  FROM `workflow_categories` AS w WHERE w.`is_periodical` = 0
                                                UNION
                                                SELECT CONCAT(a.`workflow_category_id`,'-',a.id) as 'id', CONCAT(w.`name`,' (', a.name,')') FROM `workflow_categories` AS w
                                                INNER JOIN `advertisements` AS a ON a.`workflow_category_id` = w.`id`
                                                WHERE w.`is_periodical` = 1"
        ));
        $wfs = array();
        foreach($workflow_categories as  $wc){
            $wfs[$wc->id] = $wc->name;
        }
        $workflow_categories = $wfs;//Workflow_category::lists('name', 'id');

        return View::make('ideas.completedideas', compact('ideas','workflow_categories'))->with('input', Input::all());

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPriorityCompletedList()
    {
        $ideas = Idea::with('category','advertisement');

        if (Input::get('name')) {
            $ideas = $ideas->where('ideas.name','LIKE', '%'.e(Input::get('name')).'%');
        }
        if (Input::get('first_name')) {
            $ideas = $ideas
                ->join('users', 'users.id', '=', 'ideas.user_id')
                ->where('users.first_name','LIKE', '%'.e(Input::get('first_name')).'%');
        }
        if (Input::get('advertisement_id')) {
            $ad_id = explode("-",e(Input::get('advertisement_id')));
            if(sizeof($ad_id)>1){
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0])
                    ->where('ideas.advertisement_id','=',$ad_id[1]);
            }else{
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0]);
            }
        }

        if (Input::get('sub_from')) {
            $ideas = $ideas->where('ideas.created_at', '<=', date('Y-m-d',strtotime(e(Input::get('sub_from')))));
        }
        if (Input::get('sub_to')) {
            $ideas = $ideas->where('ideas.created_at', '>=', date('Y-m-d',strtotime(e(Input::get('sub_to')))));
        }

        $ideas = $ideas
            ->where('ideas.is_opened','1')
            ->where('ideas.is_closed','1')
            ->where('ideas.is_exited','0')
            ->orderBy('priority', 'DESC')
            ->orderBy('ideas.created_at', 'DESC')
            ->paginate(10);

        $workflow_categories = DB::select( DB::raw("SELECT id, w.`name`  FROM `workflow_categories` AS w WHERE w.`is_periodical` = 0
                                                UNION
                                                SELECT CONCAT(a.`workflow_category_id`,'-',a.id) as 'id', CONCAT(w.`name`,' (', a.name,')') FROM `workflow_categories` AS w
                                                INNER JOIN `advertisements` AS a ON a.`workflow_category_id` = w.`id`
                                                WHERE w.`is_periodical` = 1"
        ));
        $wfs = array();
        foreach($workflow_categories as  $wc){
            $wfs[$wc->id] = $wc->name;
        }
        $workflow_categories = $wfs;//Workflow_category::lists('name', 'id');

        return View::make('ideas.completed_list', compact('ideas','workflow_categories'))->with('input', Input::all());

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPriorityUpcomingList()
    {
        $ideas = Idea::with('category','advertisement');

        if (Input::get('name')) {
            $ideas = $ideas->where('ideas.name','LIKE', '%'.e(Input::get('name')).'%');
        }
        if (Input::get('first_name')) {
            $ideas = $ideas
                ->join('users', 'users.id', '=', 'ideas.user_id')
                ->where('users.first_name','LIKE', '%'.e(Input::get('first_name')).'%');
        }
        if (Input::get('advertisement_id')) {
            $ad_id = explode("-",e(Input::get('advertisement_id')));
            if(sizeof($ad_id)>1){
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0])
                    ->where('ideas.advertisement_id','=',$ad_id[1]);
            }else{
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0]);
            }
        }

        if (Input::get('sub_from')) {
            $ideas = $ideas->where('ideas.created_at', '<=', date('Y-m-d',strtotime(e(Input::get('sub_from')))));
        }
        if (Input::get('sub_to')) {
            $ideas = $ideas->where('ideas.created_at', '>=', date('Y-m-d',e(Input::get('sub_to'))));
        }

        $ideas = $ideas
            ->where('ideas.is_opened','1')
            ->where('ideas.is_exited','0')
            ->whereNull('ideas.is_closed')
            ->orderBy('priority', 'DESC')
            ->orderBy('ideas.created_at', 'DESC')
            ->paginate(10);

        $workflow_categories = DB::select( DB::raw("SELECT id, w.`name`  FROM `workflow_categories` AS w WHERE w.`is_periodical` = 0
                                                UNION
                                                SELECT CONCAT(a.`workflow_category_id`,'-',a.id) as 'id', CONCAT(w.`name`,' (', a.name,')') FROM `workflow_categories` AS w
                                                INNER JOIN `advertisements` AS a ON a.`workflow_category_id` = w.`id`
                                                WHERE w.`is_periodical` = 1"
        ));
        $wfs = array();
        foreach($workflow_categories as  $wc){
            $wfs[$wc->id] = $wc->name;
        }
        $workflow_categories = $wfs;//Workflow_category::lists('name', 'id');

        return View::make('ideas.upcoming_list', compact('ideas','workflow_categories'))->with('input', Input::all());

    }
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     * @return Response
     */
    public function setPriority($id,$priority)
    {
        DB::beginTransaction();
        // set all others priority to 0
        $this->idea->where('priority',$priority)->update(array('priority'=>0));
        $idea = $this->idea->find($id);
        $input['priority'] = $priority;
        if ($idea->update($input)) {
            // Redirect to the advertisements page
            DB::commit();
            return Redirect::back()->with('success', Lang::get('ideas/message.update.success'));
        }
        DB::rollback();
        return Redirect::back()->with('error', Lang::get('ideas/message.update.error'));
    }


    public function getDetailView($id){
        // get idea

        // get idea's steps

        // get idea's steps activities

        // get idea's activities forms


    }

    public function getMyMessages(){
        $user = Sentry::getUser();

        return View::make('frontend/account/mymessages', compact('user'));
    }

    public function getMyIdeas(){

        // check whether the user have any submitted ideas
        $user = Sentry::getUser();

        // get the idea list
        $total_ideas = Idea::where('user_id','=',$user->id)->count();
/*       var_dump($total_ideas);return;*/

        // if sif application is on live
        $today = date("Y-m-d");
        $adverts = Advertisement::where('end', '>', $today)
            ->where('start', '<', $today)
            ->get();

        $ideas = $this->idea
                    ->with('category')
                    ->where('user_id', $user->id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
//        var_dump($ideas[0]->category->name);return;
        return View::make('frontend/account/myideas', compact('ideas','adverts','user'));
    }

    public function getUserIdeas($user_id){

        // check whether the user have any submitted ideas
//        $user = Sentry::getUser();

        // get the idea list
        $total_ideas = Idea::where('user_id','=',$user_id)->count();

        // if sif application is on live
        $today = date("Y-m-d");
//        $adverts = Advertisement::where('end', '>', $today)
//            ->where('start', '<', $today)
//            ->get();
        $user = User::where('id', '=', $user_id)->firstOrFail();
        $ideas = $this->idea
                    ->with('category')
                    ->where('user_id', $user_id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
//        var_dump($ideas[0]->category->name);return;
        return View::make('backend/account/ideas', compact('ideas','user'));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $user = Sentry::getUser();

        $ideas = Idea::with('category','advertisement');

        if (Input::get('name')) {
            $ideas = $ideas->where('ideas.name','LIKE', '%'.e(Input::get('name')).'%');
        }
        if (Input::get('first_name')) {
            $ideas = $ideas
                ->join('users', 'users.id', '=', 'ideas.user_id')
                ->where('users.first_name','LIKE', '%'.e(Input::get('first_name')).'%');
        }
        if (Input::get('advertisement_id')) {
            $ad_id = explode("-",e(Input::get('advertisement_id')));
            if(sizeof($ad_id)>1){
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0])
                                ->where('ideas.advertisement_id','=',$ad_id[1]);
            }else{
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0]);
            }
        }

        if (Input::get('sub_from')) {
            $ideas = $ideas->where('ideas.created_at', '<=', date('Y-m-d',strtotime(e(Input::get('sub_from')))));
        }
        if (Input::get('sub_to')) {
            $ideas = $ideas->where('ideas.created_at', '>=', date('Y-m-d',strtotime(e(Input::get('sub_to')))));
        }

        $ideas = $ideas
            ->where('ideas.is_sorted','1')
            ->where('ideas.is_exited','=','0')
            ->orderBy('ideas.created_at', 'DESC')
            ->paginate(10);

        $workflow_categories = DB::select( DB::raw("SELECT id, w.`name`  FROM `workflow_categories` AS w WHERE w.`is_periodical` = 0
                                                UNION
                                                SELECT CONCAT(a.`workflow_category_id`,'-',a.id) as 'id', CONCAT(w.`name`,' (', a.name,')') FROM `workflow_categories` AS w
                                                INNER JOIN `advertisements` AS a ON a.`workflow_category_id` = w.`id`
                                                WHERE w.`is_periodical` = 1"
        ));
        $wfs = array();
        foreach($workflow_categories as  $wc){
            $wfs[$wc->id] = $wc->name;
        }
        $workflow_categories = $wfs;//Workflow_category::lists('name', 'id');

        return View::make('ideas.index', compact('ideas','workflow_categories'))->with('input', Input::all());
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getListGrid()
	{
	    $ideas = $this->idea->where('is_sorted','1')->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('ideas.listgrid', compact('ideas'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getUnsortedList()
	{
//        $user = Sentry::getUser();
        $ideas = Idea::with('category');

        if (Input::get('name')) {
            $ideas = $ideas->where('ideas.name','LIKE', '%'.e(Input::get('name')).'%');
        }
        if (Input::get('first_name')) {
            $ideas = $ideas
                ->join('users', 'users.id', '=', 'ideas.user_id')
                ->where('users.first_name','LIKE', '%'.e(Input::get('first_name')).'%');
        }

        if (Input::get('sub_from')) {
            $ideas = $ideas->where('ideas.created_at', '<=', date('Y-m-d',strtotime(e(Input::get('sub_from')))));
        }
        if (Input::get('sub_to')) {
            $ideas = $ideas->where('ideas.created_at', '>=', date('Y-m-d',strtotime(e(Input::get('sub_to')))));
        }

        $ideas = $ideas
            ->where('ideas.is_sorted','0')
            ->orderBy('ideas.created_at', 'DESC')
            ->paginate(10);

        return View::make('ideas.unsortedlist', compact('ideas'))->with('input', Input::all());


//	    $ideas = $this->idea->where('is_sorted','0')->orderBy('created_at', 'DESC')->paginate(10);

//        return View::make('ideas.unsortedlist', compact('ideas'));
	}


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getExitedList()
	{
//        $user = Sentry::getUser();

        $ideas = Idea::with('category','advertisement');

        if (Input::get('name')) {
            $ideas = $ideas->where('ideas.name','LIKE', '%'.e(Input::get('name')).'%');
        }
        if (Input::get('first_name')) {
            $ideas = $ideas
                ->join('users', 'users.id', '=', 'ideas.user_id')
                ->where('users.first_name','LIKE', '%'.e(Input::get('first_name')).'%');
        }
        if (Input::get('advertisement_id')) {
            $ad_id = explode("-",e(Input::get('advertisement_id')));
            if(sizeof($ad_id)>1){
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0])
                    ->where('ideas.advertisement_id','=',$ad_id[1]);
            }else{
                $ideas = $ideas->where('ideas.workflow_category_id','=',$ad_id[0]);
            }
        }

        if (Input::get('sub_from')) {
            $ideas = $ideas->where('ideas.created_at', '<=', date('Y-m-d',strtotime(e(Input::get('sub_from')))));
        }
        if (Input::get('sub_to')) {
            $ideas = $ideas->where('ideas.created_at', '>=', date('Y-m-d',strtotime(e(Input::get('sub_to')))));
        }

        $ideas = $ideas
            ->where('ideas.is_exited','1')
            ->orderBy('ideas.created_at', 'DESC')
            ->paginate(10);

        $workflow_categories = DB::select( DB::raw("SELECT id, w.`name`  FROM `workflow_categories` AS w WHERE w.`is_periodical` = 0
                                                UNION
                                                SELECT CONCAT(a.`workflow_category_id`,'-',a.id) as 'id', CONCAT(w.`name`,' (', a.name,')') FROM `workflow_categories` AS w
                                                INNER JOIN `advertisements` AS a ON a.`workflow_category_id` = w.`id`
                                                WHERE w.`is_periodical` = 1"
        ));
        $wfs = array();
        foreach($workflow_categories as  $wc){
            $wfs[$wc->id] = $wc->name;
        }
        $workflow_categories = $wfs;//Workflow_category::lists('name', 'id');

        return View::make('ideas.exitedlist', compact('ideas','workflow_categories'))->with('input', Input::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Show the page
//        return View::make('backend/users/create', compact('groups', 'selectedGroups', 'permissions', 'selectedPermissions'));

//        $categories = Category::lists('name', 'id');
        $sectors =  "'" . implode("','", Sector::lists('name')) . "'";
        $areas = $this->getArea();
//        var_dump($areas); return;
        return View::make('ideas.create',compact('sectors','areas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{

        $user = User::find(1);
//       var_dump($user->name);
		$input = Input::all();
		$validation = Validator::make($input, Idea::$rules);

		if ($validation->passes())
		{
            $input['user_id']  = Sentry::getUser()->id;

            $input['area_id'] = $input['area_id']?$input['area_id']:'-1';
            $input['office_id'] = $input['office_id']?$input['office_id']:'-1';

            $input = $this->get_domain_parent($input,$input['area_id']);
            $input = $this->get_domain_parent($input,$input['office_id']);

			$this->idea->create($input);

			return Redirect::route('unsortedlist/idea');
		}
//        $validator = Validator::make(Input::all(), Idea::$rules);
//
//        if($validator->fails()) {
//            return Response::json(array(
//                'success' => false,
//                'errors' => $validator->getMessageBag()->toArray()
//
//            ), 400); // 400 being the HTTP code for an invalid request.
//        }
//        var_dump($validation); return;
		return Redirect::route('create/idea')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getSubmit($advertisement_id)
	{
        // Show the page
//        return View::make('backend/users/create', compact('groups', 'selectedGroups', 'permissions', 'selectedPermissions'));

//        $categories = Category::lists('name', 'id');
        $sectors =  "'" . implode("','", Sector::lists('name')) . "'";
        $areas = $this->getArea();
        if($advertisement_id=="general"){
//            $workflow_category_id = Workflow_category::where('id','1')->first()->id;
            return View::make('frontend/account/submit',compact('advertisement_id','sectors','areas'));
        }

        $advert = Advertisement::where('id',$advertisement_id)->first();
        $workflow_category_id = $advert->workflow_category_id;
        $advertisement_id = $advert->id;
//        var_dump($advert); return;
        return View::make('frontend/account/submit',compact('workflow_category_id','advertisement_id','sectors','areas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postSubmit($workflow_category_id)
	{
		$input = Input::all();
		$is_draft = Input::get('is_draft');

		$validation = Validator::make($input, Idea::$rules);

		if ($validation->passes())
		{
            $input['user_id']  = Sentry::getUser()->id;
            if($workflow_category_id!="general"){
                $input['is_sorted']  = 1;
                $input['sort_date']  = date( 'Y-m-d' );
            }
            $input['area_id'] = $input['area_id']?$input['area_id']:'-1';
            $input['office_id'] = $input['office_id']?$input['office_id']:'-1';

            $input = $this->get_domain_parent($input,$input['area_id']);
            $input = $this->get_domain_parent($input,$input['office_id']);

            $idea = $this->idea->create($input);
            if($is_draft==1){
                return Redirect::route('myideas');
            }else{
                $sectors =  "'" . implode("','", Sector::lists('name')) . "'";
                return Redirect::route('update/idea',$idea->id);
            }
		}

		return Redirect::back()->withInput()->withErrors($validation);
	}

    private function get_domain_parent($input,$did){
        $domain = Domain::where('id',$did)->first();
//        var_dump($domain);
        if($domain){
            switch($domain->type_id){
                case 1: $input['ministry_id'] = $domain->id; break;
                case 2: $input['min_division_id'] = $domain->id; break;
                case 3: $input['directorate_id'] = $domain->id; break;
                case 4: $input['division_id'] = $domain->id; break;
                case 5: $input['district_id'] = $domain->id; break;
                case 6: $input['upazilla_id'] = $domain->id; break;
            }
            if($domain->parent_id){
                $input = $this->get_domain_parent($input,$domain->parent_id);
            }
        }
//        var_dump($input);
        return $input;
    }
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
//        $categories = Category::lists('name', 'id');
//        $idea = DB::select( DB::raw("SELECT i.*, w.name 'category', a.name 'cat_advert' FROM ideas AS i
//                                        INNER JOIN workflow_categories AS w
//                                        ON i.workflow_category_id = w.id
//                                        LEFT JOIN advertisements AS a
//                                        ON i.workflow_category_id = a.workflow_category_id AND i.is_sorted = 1
//                                        AND (i.created_at BETWEEN a.start AND  a.end)
//                                        ORDER BY created_at DESC"
//        ));

		$idea = $this->idea->find($id);

        if (is_null($idea))
        {
            return Redirect::route('ideas');
        }

        $idea = $idea->load('steps.workflow_step','steps.activities','steps.activities.workflow_step_activity');
        $last_step_no = 0;
        $last_step = null;
        $last_workflow_step_id = 0;

//        foreach($idea->steps as $step){
//            var_dump($step->workflow_step);
//        }
//        return;
        foreach($idea->steps as $step){
            if($step->workflow_step->step_no > $last_step_no){
                $last_step_no = $step->workflow_step->step_no;
                $last_step = $step;

            }
        }
        $last_activity_no = 0;
        $next_steps = null;
        if($last_step){
            $last_workflow_step_id = $last_step->workflow_step_id;
            $last_step = $last_step->load('workflow_step');

            $next_steps = DB::table('workflow_steps')
                ->whereIn('id', explode(',',$last_step->workflow_step->next_step))
                ->lists( 'name','id');
            foreach($last_step->activities as $activity){
                if($activity->workflow_step_activity->activity_no > $last_activity_no){
                    $last_activity_no = $activity->workflow_step_activity->activity_no;
                }
            }
        }

        $undone_steps = Workflow_step::with('activities')
                            ->where('workflow_id','=',$idea->workflow_category_id)
                            ->where('step_no','>',$last_step_no)
                            ->get();

        $undone_activities = Workflow_step_activity::where('activity_no','>',$last_activity_no)
                                                        ->where('workflow_step_id','=',$last_workflow_step_id)
                                                        ->get();
        //$idea_step_activities = Idea_step_activity::where('')
//        var_dump($undone_steps[0]);
//        return;
        $tmp =  date( 'Y-m-d', strtotime( $idea->created_at ));
        $advert = null;
        if(!is_null($idea->advertisement_id)){
            $advert = Advertisement::where('id','=',$idea->advertisement_id)->where('start','<=', $tmp)->where('end','>=', $tmp)->first();
        }
//        var_dump($advert);
//        return;

        $user = Sentry::getUser();
        $applicant = Sentry::findGroupByName('Applicant');
        $cio = Idea_cio::where('idea_id',$idea->id)->where('active',1)->get();
        $mentors = Idea_mentor::where('idea_id',$idea->id)->where('active',1)->get();
        $owners = Idea_owner::where('idea_id',$idea->id)->where('active',1)->get();
        if ($user->inGroup($applicant)){
            return View::make('frontend.ideas.show', compact('cio', 'owners','mentors','advert','idea','undone_steps','undone_activities','last_step_no','next_steps'));
        }else{
            return View::make('ideas.show', compact('cio', 'owners','mentors','advert','idea','undone_steps','undone_activities','last_step_no','next_steps'));

        }
	}

    public function getDetailIdea($id)
	{

		$idea = $this->idea->find($id);

        if (is_null($idea))
        {
            return Redirect::route('ideas');
        }

        $idea = $idea->load('steps.workflow_step','steps.activities','steps.activities.workflow_step_activity');
        $last_step_no = 0;
        $last_step = null;
        $last_workflow_step_id = 0;

        foreach($idea->steps as $step){
            if($step->workflow_step->step_no > $last_step_no){
                $last_step_no = $step->workflow_step->step_no;
                $last_step = $step;

            }
        }
        $last_activity_no = 0;
        $next_steps = null;
        if($last_step){
            $last_workflow_step_id = $last_step->workflow_step_id;
            $last_step = $last_step->load('workflow_step');

            $next_steps = DB::table('workflow_steps')
                ->whereIn('id', explode(',',$last_step->workflow_step->next_step))
                ->lists( 'name','id');
            foreach($last_step->activities as $activity){
                if($activity->workflow_step_activity->activity_no > $last_activity_no){
                    $last_activity_no = $activity->workflow_step_activity->activity_no;
                }
            }
        }

        $undone_steps = Workflow_step::with('activities')
                            ->where('workflow_id','=',$idea->workflow_category_id)
                            ->where('step_no','>',$last_step_no)
                            ->get();

        $undone_activities = Workflow_step_activity::where('activity_no','>',$last_activity_no)
                                                        ->where('workflow_step_id','=',$last_workflow_step_id)
                                                        ->get();
        $tmp =  date( 'Y-m-d', strtotime( $idea->created_at ));
        $advert = null;
        if(!is_null($idea->advertisement_id)){
            $advert = Advertisement::where('id','=',$idea->advertisement_id)->where('start','<=', $tmp)->where('end','>=', $tmp)->first();
        }

		return View::make('ideas.detail', compact('advert','idea','undone_steps','undone_activities','last_step_no','next_steps'));
	}

    public function getDetail($id)
	{
        $ideaDetail = array();

		$idea = $this->idea->find($id);
        if (is_null($idea))
        {
            return Redirect::route('ideas');
        }

        $ideaDetail['detail'] = $idea->toArray();

        $idea = $idea->load('steps.workflow_step','steps.activities','steps.activities.workflow_step_activity');

        //var_dump($idea->toArray());

        //return;

        $last_step_no = 0;
        $last_step = null;
        $last_workflow_step_id = 0;

        foreach($idea->steps as $step){
            if($step->workflow_step->step_no > $last_step_no){
                $last_step_no = $step->workflow_step->step_no;
                $last_step = $step;
            }
        }

        $last_activity_no = 0;
        $next_steps = null;
        if($last_step){
            $last_workflow_step_id = $last_step->workflow_step_id;
            $last_step = $last_step->load('workflow_step');

            $next_steps = DB::table('workflow_steps')
                ->whereIn('id', explode(',',$last_step->workflow_step->next_step))
                ->lists( 'name','id');
            foreach($last_step->activities as $activity){
                if($activity->workflow_step_activity->activity_no > $last_activity_no){
                    $last_activity_no = $activity->workflow_step_activity->activity_no;
                }
            }
        }

        $undone_steps = Workflow_step::with('activities')
                            ->where('workflow_id','=',$idea->workflow_category_id)
                            ->where('step_no','>',$last_step_no)
                            ->get();

        $undone_activities = Workflow_step_activity::where('activity_no','>',$last_activity_no)
                                                        ->where('workflow_step_id','=',$last_workflow_step_id)
                                                        ->get();

        $tmp =  date( 'Y-m-d', strtotime( $idea->created_at ));
        $advert = null;

        if(!is_null($idea->advertisement_id)){
            $advert = Advertisement::where('id','=',$idea->advertisement_id)->where('start','<=', $tmp)->where('end','>=', $tmp)->first();
        }

		return View::make('ideas.detail', compact('advert','idea','undone_steps','undone_activities','last_step_no','next_steps'));
	}

    public function getView($ideaId){

        $idea = $this->idea->find($ideaId);

        if (is_null($idea))
        {
            return Redirect::route('ideas');
        }
        $user = Sentry::getUser();
        //var_dump($user); return;
        $applicant = Sentry::findGroupByName('Applicant');
        if ($user->inGroup($applicant)){
            return View::make('frontend.account.view', compact('idea','user'));
        }
        else{
            return View::make('ideas.view', compact('idea','user'));
        }
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
//        $categories = Category::lists('name', 'id');
		$idea = $this->idea->find($id);

		if (is_null($idea))
		{
			return Redirect::route('ideas');
		}

        $user = Sentry::getUser();
        $applicant = Sentry::findGroupByName('Applicant');

        $sectors =  "'" . implode("','", Sector::lists('name')) . "'";
        $areas = $this->getArea();
        if ($user->inGroup($applicant)){
            if($idea->is_draft==0){
                return View::make('frontend.account.view', compact('idea'));
            }else{
                return View::make('frontend.account.editidea', compact('idea','sectors','areas'));
                //return Redirect::back()->withInput();
            }
        }
        else{
            if($idea->is_draft==0){
                return View::make('ideas.view', compact('idea'));
            }else{
                return View::make('ideas.edit', compact('idea','sectors','areas'));
                //return Redirect::back()->withInput();
            }
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($id)
	{
        $sectors =  "'" . implode("','", Sector::lists('name')) . "'";
        $areas = $this->getArea();
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Idea::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$idea = $this->idea->find($id);

        $input['area_id'] = $input['area_id']?$input['area_id']:'-1';
        $input['office_id'] = $input['office_id']?$input['office_id']:'-1';

        $input = $this->get_domain_parent($input,$input['area_id']);
        $input = $this->get_domain_parent($input,$input['office_id']);
//        var_dump($input);
//        return;
		// Was the blog tweet updated?
        if ($idea->update($input)) {
            $user = Sentry::getUser();
            $applicant = Sentry::findGroupByName('Applicant');
            if ($user->inGroup($applicant)){
                if($idea->is_draft==1){
                    return Redirect::route('myideas')->with('success', Lang::get('ideas/message.update.success'));
                }else{
                    return View::make('frontend.account.editidea', compact('idea','sectors','area'))->with('success', Lang::get('ideas/message.update.success'));
                    //return Redirect::back()->withInput();
                }
            }
            else{
                if($idea->is_draft==1){
                    return Redirect::route('ideas')->with('success', Lang::get('ideas/message.update.success'));
                }else{
                    return View::make('ideas.edit', compact('idea','sectors','area'))->with('success', Lang::get('ideas/message.update.success'));
                    //return Redirect::back()->withInput();
                }
            }
        }

        // Redirect to the ideas management page
        return Redirect::to("ideas/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getSort($id)
    {
//        $workflow_categories = Workflow_category::lists('name', 'id');


        $workflow_categories = DB::select( DB::raw("SELECT id, w.`name`  FROM `workflow_categories` AS w WHERE w.`is_periodical` = 0
                                                UNION
                                                SELECT CONCAT(a.`workflow_category_id`,'-',a.id) as 'id', CONCAT(w.`name`,' (', a.name,')') FROM `workflow_categories` AS w
                                                INNER JOIN `advertisements` AS a ON a.`workflow_category_id` = w.`id` AND
                                                        CURDATE() BETWEEN a.start AND a.end
                                                WHERE w.`is_periodical` = 1"
                ));
        $wfs = array();
        foreach($workflow_categories as  $wc){
            $wfs[$wc->id] = $wc->name;
        }
        $workflow_categories = $wfs;//Workflow_category::lists('name', 'id');
//        var_dump($workflow_categories); return;
        $idea = $this->idea->find($id);

        if (is_null($idea))
        {
            return Redirect::route('ideas');
        }

        return View::make('ideas.sort', compact('idea','workflow_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShortlist()
    {
//        $workflow_categories = Workflow_category::lists('name', 'id');
//        $idea = $this->idea->find($id);
//
//        if (is_null($idea))
//        {
//            return Redirect::route('ideas');
//        }

//        $ideas = Idea::select(array('ideas.id','posts.name','posts.created_at','posts.status'));

//        return Datatables::of($ideas)->make(true);

        $table = Datatable::table()
            ->addColumn('Id','Name')
            ->setUrl(route('api/ideas'))

            ->noScript();

        return View::make('ideas.shortlist',compact('table'));
    }

    public function getIdeaList(){
        return Datatable::collection(Idea::all(array('id','name')))
            ->showColumns('id', 'name')
            ->searchColumns('name')
            ->orderColumns('id','name')
            ->make();
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postSort($id)
	{
        DB::beginTransaction();
        // get the  data
        $input = Input::all();

//        $validation = Validator::make($input, Idea::$rules);
//
//        // If validation fails, we'll exit the operation now.
//        if ($validation->fails()) {
//            // Ooops.. something went wrong
//            return Redirect::back()->withInput()->withErrors($validation);
//        }
        $idea = $this->idea->find($id);

        $ad_id = explode("-",e(Input::get('advertisement_id')));

        if(sizeof($ad_id)>1){
            $advert = Advertisement::where('id',$ad_id[1])->first();
            $idea->workflow_category_id  = $advert->workflow_category_id;
            $idea->advertisement_id  = $advert->id;
        }else{
            $idea->workflow_category_id  = $ad_id[0];
        }
        $idea->is_sorted             = true;
        $idea->sort_date             = date("Y-m-d");

        // Was the blog tweet updated?
        if ($idea->save()) {
//            if(!$this->populate_on_sort($idea->id, $idea->workflow_category_id)){
//                DB::rollback();
//                return Redirect::to("ideas/$id/sort")->with('error', Lang::get('tweets/message.update.error'));
//            }
            DB::commit();
            // Redirect to the ideas page
            return Redirect::to("ideas")->with('success', Lang::get('ideas/message.update.success'));
        }
        DB::rollback();
        // Redirect to the ideas management page
        return Redirect::to("ideas/$id/sort")->with('error', Lang::get('tweets/message.update.error'));

	}

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setOpen($id)
	{
//        echo "ddfd00"; return;
        DB::beginTransaction();

        $idea = $this->idea->find($id);

        $idea->is_opened = true;
        $idea->open_date = date("Y-m-d");
        $idea->activities_done = 0;
        $idea->total_activities = $this->getTotalActivities($idea->workflow_category_id);
//        $flg = false;

        // open the first step
        $flg = $this->populate_first_step($idea->id, $idea->workflow_category_id);
//        var_dump($idea);
//        return;

        // open the first activity
//        $flg = $this->populate_first_activity($idea->id, $idea->workflow_category_id, 1);


        // Was the blog tweet updated?
        if ($idea->save() && $flg) {
            DB::commit();
            // Redirect to the ideas page
            return Redirect::to("ideas/$id/show")->with('success', Lang::get('ideas/message.update.success'));
        }
        DB::rollback();
        // Redirect to the ideas management page
        return Redirect::to("ideas/$id/show")->with('error', Lang::get('tweets/message.update.error'));

	}


    private function getTotalActivities($workflow_id){
        $count = Workflow_step_activity::where('workflow_id', '=', $workflow_id)->count();
        return $count;
    }
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setClose($id)
	{

        // first check whether the each opened step is close

        $idea = $this->idea->find($id);
//        $idea = $idea->load('current_step');
        if($idea){

            $idea->is_closed             = true;
            $idea->close_date            = date("Y-m-d");
            // Was the blog tweet updated?
            if ($idea->save()) {
                // Redirect to the ideas page
                return Redirect::to("ideas/$id/show")->with('success', Lang::get('idea_steps/message.close.success'));
            }
        }


        // Redirect to the ideas management page
        return Redirect::to("ideas/$id/show")->with('error', Lang::get('idea_steps/message.close.error'));

	}

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setExit($id)
	{

        // first check whether the each opened step is close

        $idea = $this->idea->find($id);

        $idea->is_exited             = true;
        $idea->exit_date            = date("Y-m-d");
        // Was the blog tweet updated?
        if ($idea->save()) {
            // Redirect to the ideas page
            return Redirect::to("ideas/$id/detail")->with('success', Lang::get('idea_steps/message.close.success'));
        }
	}

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setReopen($id)
	{

        // first check whether the each opened step is close

        $idea = $this->idea->find($id);

        $idea->is_exited             = false;
//            $idea->exit_date            = date("Y-m-d");
        // Was the blog tweet updated?
        if ($idea->save()) {
            // Redirect to the ideas page
            return Redirect::to("ideas/$id/show")->with('success', Lang::get('idea_steps/message.close.success'));
        }

	}

    private function populate_first_step($idea_id, $workflow_id){
        try {
            $step = DB::table('workflow_steps')
                        ->where('workflow_id', $workflow_id)
                        ->where('step_no', 1)
                        ->first();
            var_dump($step);
            if(!is_null($step)){
                return $this->populate_step($idea_id, $workflow_id, $step->id);
            }
            return false;
        } catch(\Exception $e)
        {
            return false;
        }
    }

    private function populate_step($idea_id, $workflow_id, $step_id){
        try {
            // get the first setp
            $step = DB::table('workflow_steps')
                ->where('id', $step_id)
                ->first();
            var_dump($step);
            if(!is_null($step)){
                // populate Step data
                $idea_step_id = DB::table('idea_steps')->insertGetId(
                    array(
                        'idea_id' => $idea_id,
                        'workflow_step_id' => $step_id,
                        'prev_step' => -1,
                        'next_step' => -1,
                        'status' => false,
                        'is_opened' => false,
                        'is_closed' => false,
                        'due_date' => null,
                        'initiate_date' => null
                    )
                );
                if($idea_step_id>0){
                    return $this->populate_first_activity($idea_id, $workflow_id, $step_id, $idea_step_id);
                }
                return true;
            }
            return false;
        } catch(\Exception $e)
        {
            return false;
        }
    }

    private function populate_first_activity($idea_id, $workflow_id, $step_id, $idea_step_id){
        // populate first activity
        $activity = DB::table('workflow_step_activities')
            ->where('workflow_id', $workflow_id)
            ->where('workflow_step_id', $step_id)
            ->where('activity_no', 1)
            ->first();
        if(!is_null($activity)){
            return $this->populate_activity($idea_id, $idea_step_id, $activity->id);
        }
        return false;
    }

    private function populate_activity($idea_id, $step_id, $activity_id){
        try {
            // get the first activity
            $activity = DB::table('workflow_step_activities')
                ->where('id', $activity_id)
                ->first();
            if(!is_null($activity)){
                // populate Step data
                $idea_step_activity = new Idea_step_activity;

                $idea_step_activity->idea_id = $idea_id;
                $idea_step_activity->idea_step_id = $step_id;
                $idea_step_activity->workflow_activity_id = $activity_id;
                $idea_step_activity->activity_form_ids = $activity->forms;
                $idea_step_activity->prev_activity = -1;
                $idea_step_activity->next_activity = -1;
                $idea_step_activity->status = false;
                $idea_step_activity->is_opened = false;
                $idea_step_activity->is_closed = false;
                $idea_step_activity->due_date = null;
                $idea_step_activity->initiate_date = null;

                $idea_step_activity->save();

                return true;
            }
            return false;
        } catch(\Exception $e)
        {
        return false;
        }
    }

//    private function populate_forms($idea_id, $step_id, $activity_id, $form_id){
//        try {
//            $form = DB::table('activity_forms')
//                ->where('id', $form_id)
//                ->get();
//
//            if(!empty($form[0])){
//                $id = DB::table($form[0]->action_uri)->insert(
//                        array(
//                            'idea_id' => $idea_id,
//                            'step_id' => $step_id,
//                            'activity_id' => $activity_id
//                        )
//                      );
//                return $id;
//            }
//            return -1;
//        } catch(\Exception $e)
//        {
//            return -1;
//        }
//    }
	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'ideas';
        $confirm_route = $error = null;
        // Check if the ideas exists
        if (is_null($idea = $this->idea->find($id))) {

            $error = Lang::get('ideas/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/idea', array('id'=>$idea->id));
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

        $this->idea->find($id)->delete();
        // Redirect to the ideas management page
        return Redirect::route('ideas')->with('success', Lang::get('ideas/message.success.delete'));
	}

    public function getArea(){
        $areas = DB::select( DB::raw("
                        SELECT ds.id, ds.`name` 'district', dv.`name` 'division'

                        FROM districts AS ds
                        INNER JOIN divisions AS dv
                        ON dv.id = ds.`division_id`
                        ORDER BY dv.`name`, ds.`name`
                        "));
        $prev_div = "";
        $sel_areas = array();
        $districts = array();
        foreach ($areas as $area){
            if($prev_div==""){
                $prev_div = $area->division;
//                echo $area->division;
            }
            if($area->division != $prev_div){
//                echo $area->division;
//                var_dump($districts);
                $sel_areas[$prev_div] = $districts;
                $prev_div = $area->division;
                $districts = array();
            }
            $districts[$area->id] = $area->district;
//            echo $area->district.'\n';
        }
        $sel_areas[$prev_div] = $districts;
        return $sel_areas;
    }

}

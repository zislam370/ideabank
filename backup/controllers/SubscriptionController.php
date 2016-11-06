<?php


class SubscriptionController extends BaseController {

    /**
     * Tweet Repository
     *
     * @var Tweet
     */
    protected $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function getUserSubscriptions()
    {


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

        $subscriptions = $this->subscription
            ->where('email', $user->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
//        var_dump($ideas[0]->category->name);return;
        return View::make('frontend', compact('subscriptions','adverts','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('backend/account/subscriptions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        //$user = Sentry::getUser();

        $input = Input::all();
        $redirect = Input::get('redirect');
//        var_dump($user); return;
        $validation = Validator::make($input, Subscription::$rules);

        if ($validation->passes())
        {

            /*//  $input['body']  = Sentry::getUser()->id;
            $input['sender_id']  = Sentry::getUser()->id;
            $user = User::where('mobile','=',Input::get('to'))->first();
            $input['recever_id']  = $user->id;*/

            unset($input['to']);
            unset($input['redirect']);

            $this->subscription->create($input);
            // var_dump($input); return;

            return Redirect::route($redirect)->with('success', Lang::get('subscriptionses/subscription.success.delete'));
        }
//        $validator = Validator::make(Input::all(), Idea::$rules);
//
//        if($validator->fails()) {
//            return Response::json(array(
//                'success' => false,
//                'errors' => $validator->getSubscriptionBag()->toArray()
//
//            ), 400); // 400 being the HTTP code for an invalid request.
//        }
        return Redirect::route($redirect)
            ->withInput()
            ->withErrors($validation)
            ->with('subscription', 'There were validation errors.');
    }

    public function getView(){

        // Get the user information
        $user = Sentry::getUser();
//        var_dump($user); return;
        $applicant = Sentry::findGroupByName('Applicant');
        if ($user->inGroup($applicant)) {
//            $layout = "frontend";
            return View::make('backend/account/subscriptions', compact('user'));
        }
    }


}

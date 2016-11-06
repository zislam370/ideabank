<?php

class PublicDashboardController extends AuthorizedController
{
    /**
     * Redirect to the profile page.
     *
     * @return Redirect
     */
    public function getIndex()
    {

        // check whether the user have any submitted ideas
        $user = Sentry::getUser();
        //        var_dump($user); return;
        // get the idea list
//        $total_ideas = Idea::where('user_id','=',$user->id)->count();

        // if sif application is on live
        $today = date("Y-m-d");
        $adverts = Advertisement::where('end', '>', $today)
            ->where('start', '<', $today)
            ->get();

        $ideaCnt['totalideas'] = Idea::where('user_id','=',$user->id)
//            ->where('is_draft','<>',1)
            ->count();
        $ideaCnt['ongoingideas'] = Idea::where('user_id','=',$user->id)
            ->where('is_opened','=',1)
            ->whereNull('is_closed')
            ->count();
        $ideaCnt['finishedideas'] = Idea::where('user_id','=',$user->id)
            ->where('is_opened','=',1)
            ->where('is_closed','=',1)
            ->count();
        $ideaCnt['rejectideas'] = Idea::where('user_id','=',$user->id)
            ->where('is_rejected','=',1)
            ->count();
//        $advert_flg = sizeof($advert);

        // Show the page
//        var_dump($ideaCnt);return;
        $applicant = Sentry::findGroupByName('Applicant');
        if ($user->inGroup($applicant)){
//            $layout = "frontend";
            return View::make('frontend/account/profile', compact('user','adverts','ideaCnt'));
        }

        return View::make('backend/account/dashboard',compact('user','adverts'));

    }

}

<?php namespace Controllers\Account;

use AuthorizedController;
use IdeaController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;
use User;
use Idea;

class ProfileController extends AuthorizedController
{
    /**
     * User profile page.
     *
     * @return View
     */
    public function getIndex()
    {
        // Get the user information
        $user = Sentry::getUser();
//        var_dump($user); return;
        $applicant = Sentry::findGroupByName('Applicant');
//        $ideaCnt['totalideas'] = Idea::where('user_id','=',$user->id)
////            ->where('is_draft','<>',1)
//            ->count();
//        $ideaCnt['ongoingideas'] = Idea::where('user_id','=',$user->id)
//            ->where('is_opened','=',1)
//            ->whereNull('is_closed')
//            ->count();
//        $ideaCnt['finishedideas'] = Idea::where('user_id','=',$user->id)
//            ->where('is_opened','=',1)
//            ->where('is_closed','=',1)
//            ->count();
//        $ideaCnt['rejectideas'] = Idea::where('user_id','=',$user->id)
//            ->where('is_rejected','=',1)
//            ->count();
        if ($user->inGroup($applicant)){
//            $layout = "frontend";
//            return View::make('frontend/account/profile', compact('user','ideaCnt'));
            return View::make('frontend/account/profile', compact('user'));
        }
//        return View::make('backend/account/profile', compact('user','ideaCnt'));
        return View::make('backend/account/profile', compact('user'));

    }
    public function getUserProfile($user_id)
    {
        // Get the user information
        $user = User::where('id', '=', $user_id)->firstOrFail();

//        var_dump($user->getGroups()); return;
//        $applicant = Sentry::findGroupByName('Applicant');
//        if ($user->inGroup($applicant)){
////            $layout = "frontend";
//            return View::make('frontend/account/profile', compact('user'));
//        }
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
//        return;
        return View::make('backend/account/profile', compact('user','ideaCnt'));
    }

}

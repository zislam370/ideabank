<?php

class EditProfileController extends AuthorizedController
{
    /**
     * User editprofile page.
     *
     * @return View
     */
    public function getIndex($id)
    {
        // Get the user information
        $user = User::where('id','=',$id)->first();
//        var_dump($user); return;
        $curuser = Sentry::getUser();
        $applicant = Sentry::findGroupByName('Applicant');
        if ($curuser->inGroup($applicant)){
//            $layout = "frontend";
            return View::make('frontend/account/editprofile', compact('user'));
        }
        else{
//            $layout = "backend";
            return View::make('backend/account/editprofile', compact('user'));
        }
        // Show the page

    }

    /**
     * User profile form processing page.
     *
     * @return Redirect
     */
    public function postIndex($id)
    {
        // Declare the rules for the form validation
        $rules = array(
            'first_name'       => 'required|min:3',
//            'last_name'  => 'required|alpha_space|min:2',
            'email'            => 'email',
            'avatar' => 'mimes:jpeg,bmp,png'
        );
        $tmp_input = Input::all();
        // Create a new validator instance from our validation rules
        $validator = Validator::make($tmp_input, $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Grab the user
//        $user = Sentry::getUser();
        $user = User::where('id','=',$id)->first();
//        var_dump($user); return;
        // Update the user information
        $user->first_name = Input::get('first_name');
//        $user->last_name  = Input::get('last_name');
        $user->email    = Input::get('email');
        $user->address    = Input::get('address');
        if($user->user_type=="Organization"){
            $user->representative_name    = Input::get('representative_name');
            $user->office_name    = Input::get('office_name');
            $user->office_web_url    = Input::get('office_web_url');
            $user->contact_number    = Input::get('contact_number');
        }
        $user->avatar    = Input::file('avatar');
        $user->save();

        return Redirect::route('editprofile',$id)->with('success', 'Account successfully Edited');
//        var_dump($user); return;
        // Redirect to the settings page
//        $curuser = Sentry::getUser();
//        $applicant = Sentry::findGroupByName('Applicant');
//        if ($curuser->inGroup($applicant)){
////            $layout = "frontend";
//
//        }
//        else{
////            $layout = "backend";
//            return Redirect::route('editprofile',$id)->with('success', 'Account successfully Edited');
//        }
    }

}

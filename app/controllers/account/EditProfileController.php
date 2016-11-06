<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;

class EditProfileController extends AuthorizedController
{
    /**
     * User editprofile page.
     *
     * @return View
     */
    public function getIndex()
    {
        // Get the user information
        $user = Sentry::getUser();

        $applicant = Sentry::findGroupByName('Applicant');
        if ($user->inGroup($applicant)){
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
    public function postIndex()
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
        $user = Sentry::getUser();
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

//        var_dump($user); return;
        // Redirect to the settings page
        return Redirect::route('editprofile')->with('success', Lang::get('account/message.update.profile_edit_success'));
    }

}

<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;
use Lang;

class ChangeMobileController extends AuthorizedController
{
    /**
     * User change email page.
     *
     * @return View
     */
    public function getIndex()
    {
        // Get the user information
        $user = Sentry::getUser();
        $applicant = Sentry::findGroupByName('Applicant');
        if ($user->inGroup($applicant))
            $layout = "frontend";
        else
            $layout = "backend";

        // Show the page
        return View::make('frontend/account/change-mobile', compact('user','layout'));
    }

    /**
     * Users change email form processing page.
     *
     * @return Redirect
     */
    public function postIndex()
    {
        // Declare the rules for the form validation
        $rules = array(
            'current_password' => 'required|between:8,32',
            'mobile'           => 'required|mobile|unique:users|size:11',
            'moblie_confirm'           => 'required|same:mobile',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Grab the user
        $user = Sentry::getUser();

        // Check the user current password
        if ( ! $user->checkPassword(Input::get('current_password'))) {
            // Set the error message
            $this->messageBag->add('current_password', Lang::get('account/message.error.current_password'));

            // Redirect to the change mobile page
            return Redirect::route('change-mobile')->withErrors($this->messageBag);
        }

        // Update the user mobile
        $user->mobile = Input::get('mobile');
        $user->save();

        // send message to the user

        // Redirect to the settings page
        return Redirect::route('change-mobile')->with('success', Lang::get('account/message.update.mobile_success'));
    }

}

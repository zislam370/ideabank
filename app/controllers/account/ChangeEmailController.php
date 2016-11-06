<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;

class ChangeEmailController extends AuthorizedController
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
        return View::make('backend/account/change-email', compact('user','layout'));
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
            'email'            => 'required|email|unique:users,email,'.Sentry::getUser()->email.',email',
            'email_confirm'    => 'required|same:email',
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
        if ( ! $user->checkPassword(e(Input::get('current_password')))) {
            // Set the error message
            $this->messageBag->add('current_password', Lang::get('account/message.error.current_password'));

            // Redirect to the change email page
            return Redirect::route('change-email')->withErrors($this->messageBag);
        }

        // Update the user email
        $user->email = Input::get('email');
        $user->save();

        // Redirect to the settings page
        return Redirect::route('change-email')->with('success', Lang::get('account/message.update.email_success'));
    }

}

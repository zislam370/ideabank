<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;

class ChangePasswordController extends AuthorizedController
{
    /**
     * User change password page.
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
        return View::make($layout.'/account/change-password', compact('user','layout'));
    }

    /**
     * User change password form processing page.
     *
     * @return Redirect
     */
    protected function postIndex()
    {
        // Declare the rules for the form validation
        $rules = array(
            'old_password'     => 'required|between:8,32',
            'password'         => 'required|between:8,32',
            'password_confirm' => 'required|same:password',
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
        if ( ! $user->checkPassword(Input::get('old_password'))) {
            // Set the error message
            $this->messageBag->add('old_password', Lang::get('account/message.error.old_password'));

            // Redirect to the change password page
            return Redirect::route('change-password')->withErrors($this->messageBag);
        }

        // Update the user password
        $user->password = Input::get('password');
        $user->save();

        // Redirect to the change-password page
        return Redirect::route('change-password')->with('success', Lang::get('account/message.update.password_success'));
    }

}

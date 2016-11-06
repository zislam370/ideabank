<?php



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
            'current_password' => 'required|between:3,32',
            'mobile'            => 'required|unique:users,mobile,'.Sentry::getUser()->mobile.',mobile',
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
            $this->messageBag->add('current_password', 'Your current password is incorrect');

            // Redirect to the change mobile page
            return Redirect::route('change-mobile')->withErrors($this->messageBag);
        }

        // Update the user mobile
        $user->mobile = Input::get('mobile');
        $user->save();

        // Redirect to the settings page
        return Redirect::route('change-mobile')->with('success', 'Mobile Number successfully updated');
    }

}

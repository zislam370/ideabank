<?php

class AuthController extends BaseController
{
    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignin()
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }

        // Show the page
        return View::make('frontend.auth.signin');
    }

    /**
     * Account sign in form processing.
     *
     * @return Redirect
     */
    public function postSignin()
    {
        // Declare the rules for the form validation
        $rules = array(
            'mobile'    => 'required|mobile',
            'password' => 'required|between:3,32',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try {
            //Check for suspension or banned status
//            $user = Sentry::getUserProvider()->findByLogin($input['email']);
//            $throttle = Sentry::getThrottleProvider()->findByUserId($user->id);
//            $throttle->check();
//
//            // Set login credentials
//            $credentials = array(
//                'mobile'    => $input['mobile'],
//                'password' => $input['password']
//            );
//
//            // Try to authenticate the user
//            $user = Sentry::authenticate($credentials, $input['rememberMe']);
//            Sentry::loginAndRemember($user);

            // Try to log the user in
            $user = Sentry::authenticate(Input::only('mobile', 'password'),Input::get('remember-me', 0));

            Sentry::loginAndRemember($user);

            // Get the page we were before
            $redirect = Session::get('loginRedirect', 'account');

            // Unset the page we were before from the session
            Session::forget('loginRedirect');

            // Redirect to the users page
//            return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));

            // get the role
            // if role is applicant than go to public account
            $user = Sentry::getUser();
//            $groups = $user->getGroups();
//            foreach($groups as $group){
//                var_dump($group->name);
//            }
//            return;
            // Find the user using the user id
//            $user = Sentry::findUserByID(1);

            // Find the Administrator group
            $applicant = Sentry::findGroupByName('Applicant');

            // Get the Sentry cookie
//            $persistCookie = Sentry::getCookie()->getCookie();

            // Check if the user is in the administrator group
            if ($user->inGroup($applicant))
            {
//                echo $redirect; return;
                if(empty($redirect) || $redirect=='account'){
                    // User is in Administrator group
                    return Redirect::to("/account/myideas")->with('success', Lang::get('auth/message.signin.success'));
                }else{
                    return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));
                }
            }
            else
            {
                // User is not in Administrator group
                return Redirect::to("/account")->with('success', Lang::get('auth/message.signin.success'));
            }
            // if role is account than go to private account
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $this->messageBag->add('general', Lang::get('auth/message.account_not_found'));
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $this->messageBag->add('general', Lang::get('auth/message.account_not_activated'));
        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $this->messageBag->add('general', Lang::get('auth/message.account_suspended'));
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $this->messageBag->add('general', Lang::get('auth/message.account_banned'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account sign up.
     *
     * @return View
     */
    public function getSignup()
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }
        $heads = Form_lookup_datum::where('form_lookup_id','=',16)->lists('name', 'name');
        // Show the page
        return View::make('frontend.auth.signup',compact('heads'));
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postSignup()
    {


        // Declare the rules for the form validation
        $rules = array(
            'first_name'       => 'required|min:3',
//            'last_name'        => 'required|min:3',
            'email'            => 'email',
            'mobile'           => 'required|mobile|unique:users|size:11',
//            'mobile_confirm'   => 'required|mobile|same:mobile',
            'password'         => 'required|between:3,32',
            'password_confirm' => 'required|same:password',
            'captcha'          => 'required|captcha',
        );



        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

//        var_dump($validator->fails()); return;

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try {
            $inputs = array(
                'first_name' => Input::get('first_name'),
//                'last_name'  => Input::get('last_name'),
                'email'      => Input::get('email'),
                'mobile'      => Input::get('mobile'),
                'password'   => Input::get('password'),
                'user_type'   => Input::get('user_type'),
//                'gender'   => e(Input::get('gender')),
//                'birthyear'   => e(Input::get('birthyear')),
                'activated'     => true,
            );
            if(Input::get('user_type')=="Organization"){
                array_push($inputs, array(
//                    'organization_type'   => Input::get('organization_type'),
                    'representative_name'   => Input::get('representative_name'),
                    'office_name'   => Input::get('office_name'),
                    'office_web_url'   => Input::get('office_web_url'),
                    'contact_number'   => Input::get('contact_number'),
                ));
            }
            // Register the user
            $user = Sentry::register($inputs);
            // Find the group using the group id
            $applicantGroup = Sentry::findGroupById(2);

            // Assign the group to the user
            $user->addGroup($applicantGroup);

            // Data to be used on the email view
//            $data = array(
//                'user'          => $user,
//                'activated'     => true
////                'activationUrl' => URL::route('activate', $user->getActivationCode()),
//
//            );
            //return Redirect::to("auth/signin")->with('success', Lang::get('auth/message.signup.success'));
            // Send the activation code through email
//            Mail::send('emails.register-activate', $data, function ($m) use ($user) {
//                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
//                $m->subject('Welcome ' . $user->first_name);
//            });


            $this->sendRegSMS(array(
                'email'=>Input::get('email'),
                'mobile'=>Input::get('mobile'),
                'password'=>Input::get('password'),
                'message_tx'=>'',
            ));
//            return;
            // Redirect to the home page with sucess menu
            return Redirect::to("auth/signin")->with('success', Lang::get('auth/message.signup.success'));
//            return Redirect::to("auth/mobile_verification")->with('success', Lang::get('auth/message.signup.success'));

        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }
        return;
        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    public function getorSignup()
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }

        // Show the page
        return View::make('frontend.auth.organization');
    }


    private function sendRegSMS($userData){

        $userData['message_tx'] = "Your registration for Innovation Fund is completed.\nUserId:{$userData['mobile']}\nPassword:{$userData['password']}\nAccount login URL: http://www.e-service.gov.bd/ideabank\nThanks,\nA2I-PMO";
        $receivedData = $this->sendSMS($userData);
//        var_dump($userData);
//        echo $receivedData;
//        return true;
    }


//    private function sendSMS($userData){
//        $receivedData = $this->sendRegistrationSMS($userData);
////        echo $receivedData;
////        return true;
//    }

    private function sendSMS($userData) {
        $message_tx = $userData['message_tx'];//"Your registration for Innovation Fund is completed.\nEmail:{$userData['email']}\nPassword:{$userData['password']}\nAccount login URL: http://www.e-service.gov.bd/ideabank\nThanks,\nA2I-PMO";
//        $message_tx = "Your registration for Innovation Fund is completed.\nEmail:{$userData['email']}\nPassword:{$userData['password']}\nAccount login URL: http://www.e-service.gov.bd/ideabank\nThanks,\nA2I-PMO";
        $SMSGateway = "http://123.49.3.58:8081/web_send_sms.php";
        $SMSuser = "cG1vZmZpY2U=";
        $SMSpassw = "cG1vZmZpY2U=";
        $txt = urlencode($message_tx);
        return file_get_contents("$SMSGateway?ms=88{$userData['mobile']}&txt=$txt&username=" . base64_decode($SMSuser) . '&password=' . base64_decode($SMSpassw));
    }
    /**
     * User account activation page.
     *
     * @param string $actvationCode
     * @return
     */
    public function getActivate($activationCode = null)
    {
        // Is the user logged in?
        if (Sentry::check()) {
            return Redirect::route('account');
        }

        try {
            // Get the user we are trying to activate
            $user = Sentry::getUserProvider()->findByActivationCode($activationCode);

            // Try to activate this user account
            if ($user->attemptActivation($activationCode)) {
                // Redirect to the login page
                return Redirect::route('organization')->with('success', Lang::get('auth/message.activate.success'));
            }

            // The activation failed.
            $error = Lang::get('auth/message.activate.error');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $error = Lang::get('auth/message.activate.error');
        }

        // Ooops.. something went wrong
        return Redirect::route('organization')->with('error', $error);
    }

    /**
     * Forgot password page.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        // Show the page
        return View::make('frontend.auth.forgot-password');
    }

    private function sendForgetPassSMS($userData){
        $userData['message_tx'] = "Your password has been successfully reset to:\n{$userData['password']}\nAccount login URL: http://www.e-service.gov.bd/ideabank/public\nThanks,\nA2I-PMO";
        $receivedData = $this->sendSMS($userData);
//        echo $receivedData;
//        return true;
    }
    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */
    public function postForgotPassword()
    {
        // Declare the rules for the validator
        $rules = array(
            'mobile' => 'required|mobile',
        );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password')->withInput()->withErrors($validator);
        }

        try {
            // Get the user password recovery code
            $user = Sentry::getUserProvider()->findByLogin(Input::get('mobile'));

            // generate random data
            $new_pass = substr(md5(rand(0, 1000000)), 0, 8);

            // save the user data with password
            $user->password = $new_pass;
            if($user->save()){
                // send sms to the user
                $this->sendForgetPassSMS(array(
                    'email'=>$user->email,
                    'mobile'=>$user->mobile,
                    'password'=>$new_pass,
                ));
            }

            // Data to be used on the email view
//            $data = array(
//                'user'              => $user,
//                'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
//            );

            // Send the activation code through email
//            Mail::send('emails.forgot-password', $data, function ($m) use ($user) {
//                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
//                $m->subject('Account Password Recovery');
//            });
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return Redirect::route('forgot-password')->with('success', Lang::get('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($passwordResetCode = null)
    {
        try {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }

        // Show the page
        return View::make('frontend.auth.forgot-password-confirm');
    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param  string   $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm($passwordResetCode = null)
    {
        // Declare the rules for the form validation
        $rules = array(
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
        }

        try {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

            // Attempt to reset the user password
            if ($user->attemptResetPassword($passwordResetCode, Input::get('password'))) {
                // Password successfully reseted
                return Redirect::route('signin')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
            } else {
                // Ooops.. something went wrong
                return Redirect::route('signin')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }
    }

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        // Log the user out
        Sentry::logout();

        // Redirect to the users page
        return Redirect::route('home')->with('success', Lang::get('auth/message.logout'));
    }
    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postorSignup()
    {


        // Declare the rules for the form validation
        $rules = array(
            'first_name'       => 'required|min:3',
            'last_name'        => 'required|min:3',
            'email'            => 'email',
//            'email_confirm'    => 'required|email|same:email',
            'mobile'           => 'required|mobile|unique:users',
//            'mobile_confirm'   => 'required|mobile|same:mobile',
            'password'         => 'required|between:3,32',
            'password_confirm' => 'required|same:password',
            'captcha'          => 'required|captcha',
        );



        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);



        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }



        try {

            // Register the user
            $user = Sentry::register(array(
                'first_name' => Input::get('first_name'),
                'last_name'  => Input::get('last_name'),
                'email'      => Input::get('email'),
                'mobile'      => Input::get('mobile'),
                'password'   => Input::get('password'),
                'activated'     => true,
            ));
            // Find the group using the group id
            $applicantGroup = Sentry::findGroupById(2);

            // Assign the group to the user
            $user->addGroup($applicantGroup);

            // Data to be used on the email view
            $data = array(
                'user'          => $user,
                'activated'     => true
//                'activationUrl' => URL::route('activate', $user->getActivationCode()),

            );
            //return Redirect::to("auth/signin")->with('success', Lang::get('auth/message.signup.success'));
            // Send the activation code through email
//            Mail::send('emails.register-activate', $data, function ($m) use ($user) {
//                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
//                $m->subject('Welcome ' . $user->first_name);
//            });


            $this->sendRegSMS(array(
                'email'=>Input::get('email'),
                'mobile'=>Input::get('mobile'),
                'password'=>Input::get('password'),
                'password'=>Input::get('password'),
            ));
            // Redirect to the home page with sucess menu
            return Redirect::to("auth/organization")->with('success', Lang::get('auth/message.signup.success'));
//            return Redirect::to("auth/mobile_verification")->with('success', Lang::get('auth/message.signup.success'));

        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

}

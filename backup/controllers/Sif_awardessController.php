<?php

class Sif_awardessController extends BaseController
{
    /**
     * Contact us page.
     *
     * @return View
     */
    public function getIndex()
    {
        return View::make('frontend/sif_awardess');
    }

    /**
     * Contact us form processing page.
     *
     * @return Redirect
     */
    public function postIndex()
    {
        // Declare the rules for the form validation
        $rules = array(
            'name'        => 'required',
            'email'       => 'required|email',
            'description' => 'required',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::route('sif_awardess')->withErrors($validator);
        } else {

			// Data to be used on the email view
			$data = array(
				'name'				=>  e(Input::get('name')),
				'email'				=>  e(Input::get('email')),
				'description'		=>  e(Input::get('description'))
			);

			$from = Config::get('mail.from');

			// Send the activation code through email
			Mail::send('emails.sif_awardess', $data, function ($m) use ($from, $data) {
				$m->to($from['address'], $from['name']);
				$m->subject('Contact Form Submission');
				$m->from($data['email'], $data['name']);
			});

			return Redirect::route('sif_awardess')->with('success', Lang::get('contact.sent_success'));


		}

    }

}

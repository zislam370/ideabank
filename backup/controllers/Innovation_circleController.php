<?php

class Innovation_circleController extends BaseController
{
    /**
     * Contact us page.
     *
     * @return View
     */
    public function getIndex()
    {
        return View::make('frontend/innovation_circle');
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
            return Redirect::route('innovation_circle')->withErrors($validator);
        } else {

			// Data to be used on the email view
			$data = array(
				'name'				=>  e(Input::get('name')),
				'email'				=>  e(Input::get('email')),
				'description'		=>  e(Input::get('description'))
			);

			$from = Config::get('mail.from');

			// Send the activation code through email
			Mail::send('emails.innovation_circle', $data, function ($m) use ($from, $data) {
				$m->to($from['address'], $from['name']);
				$m->subject('Contact Form Submission');
				$m->from($data['email'], $data['name']);
			});

			return Redirect::route('innovation_circle')->with('success', Lang::get('contact.sent_success'));


		}

    }

}

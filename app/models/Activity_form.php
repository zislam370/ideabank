<?php

class Activity_form extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'description' => 'required',
		'action_uri' => 'required'
	);
}

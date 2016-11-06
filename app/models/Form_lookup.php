<?php

class Form_lookup extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'description' => 'required'
	);
}

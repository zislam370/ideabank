<?php

class Form_richtext extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required'
	);
}

<?php

class Page extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'slug' => 'required',
		'title' => 'required',
		'body'  => 'required',
	);
}

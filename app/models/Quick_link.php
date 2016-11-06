<?php

class Quick_link extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'link' => 'required|url'
	);
}

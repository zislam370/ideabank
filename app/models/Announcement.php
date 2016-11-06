<?php

class Announcement extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'body' => 'required',
//		'publish' => 'required',
//		'user_id' => 'required'
	);
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
}

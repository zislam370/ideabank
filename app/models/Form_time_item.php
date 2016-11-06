<?php

class Form_time_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_time_item_id' => 'required',
//		'head' => 'required',
//		'comment' => 'required',
//		'duration' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_time', 'form_time_id');
    }

}

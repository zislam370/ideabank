<?php

class Form_manpower_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_manpower_item_id' => 'required',
//		'head' => 'required',
//		'comment' => 'required',
//		'amount' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_manpower', 'form_manpower_id');
    }
}

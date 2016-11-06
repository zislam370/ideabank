<?php

class Form_visit_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_visit_id' => 'required',
//		'location' => 'required',
//		'purpose' => 'required',
//		'start' => 'required',
//		'end' => 'required',
//		'outcome' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_visit', 'form_visit_id');
    }

}

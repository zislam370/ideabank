<?php

class Form_deliverable_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_deliverable_id' => 'required',
//		'name' => 'required',
//		'due_date' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_deliverable', 'form_deliverable_id');
    }
}

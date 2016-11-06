<?php

class Form_payment_schedule_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_payment_schedule_id' => 'required',
//		'name' => 'required',
//		'due_date' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_payment_schedule', 'form_payment_schedule_id');
    }
}

<?php

class Form_tcv_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_payment_schedule_id' => 'required',
//		'name' => 'required',
//		'due_date' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_tcv', 'form_tvc_id');
    }
}

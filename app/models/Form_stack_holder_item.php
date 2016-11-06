<?php

class Form_stack_holder_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_stack_holder_id' => 'required',
//		'name' => 'required',
//		'role' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_stack_holder', 'form_stack_holder_id');
    }

}

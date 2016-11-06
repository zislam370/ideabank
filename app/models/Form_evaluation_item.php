<?php

class Form_evaluation_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_evaluation_id' => 'required',
//		'task' => 'required',
//		'due_date' => 'required',
//		'target' => 'required',
//		'achieved' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_evaluation', 'form_evaluation_id');
    }

}

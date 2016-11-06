<?php

class Form_budget_item extends Eloquent {
	protected $guarded = array();

    public static $rules = array(
//		'form_budget_id' => 'required',
//		'head' => 'required',
//		'amount' => 'required',
    );
    public function parent()
    {
        return $this->belongsTo('Form_budget', 'form_budget_id');
    }
}

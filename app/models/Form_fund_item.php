<?php

class Form_fund_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_fund_item_id' => 'required',
//		'head' => 'required',
//		'comment' => 'required',
//		'amount' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_fund', 'form_fund_id');
    }
}

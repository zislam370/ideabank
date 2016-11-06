<?php

class Form_payment_disbursment_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_payment_disbursment_id' => 'required',
//		'Installment' => 'required',
//		'disburse_date' => 'required',
//		'amount' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_payment_disbursment', 'form_payment_disbursment_id');
    }

}

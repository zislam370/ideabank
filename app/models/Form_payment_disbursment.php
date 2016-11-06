<?php

class Form_payment_disbursment extends Eloquent {
	protected $guarded = array();

    public static $rules = array(
        'idea_id' => 'required',
        'step_id' => 'required',
        'activity_id' => 'required',
    );
    public function items()
    {
        return $this->hasMany('Form_payment_disbursment_item');
    }
}

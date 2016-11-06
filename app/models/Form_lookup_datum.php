<?php

class Form_lookup_datum extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'form_lookup_id' => 'required',
		'name' => 'required'
	);
    public function lookup()
    {
        return $this->belongsTo('Form_lookup', 'form_lookup_id');
    }
}

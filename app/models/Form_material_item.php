<?php

class Form_material_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_material_item_id' => 'required',
//		'head' => 'required',
//		'comment' => 'required',
//		'amount' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_material', 'form_material_id');
    }
}

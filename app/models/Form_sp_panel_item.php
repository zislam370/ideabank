<?php

class Form_sp_panel_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_sp_panel_id' => 'required',
//		'name' => 'required',
//		'designation' => 'required',
//		'remark' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_sp_panel', 'form_sp_panel_id');
    }

}

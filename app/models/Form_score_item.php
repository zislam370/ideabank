<?php

class Form_score_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'form_score_item_id' => 'required',
//		'head' => 'required',
//		'comment' => 'required',
//		'score' => 'required'
	);
    public function parent()
    {
        return $this->belongsTo('Form_score', 'form_score_id');
    }

}

<?php

class Form_idea_approval extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_id' => 'required',
		'step_id' => 'required',
		'activity_id' => 'required',
		'approval_id' => 'required',
		'comment' => 'required'
	);
    public function heads()
    {
        return $this->belongsTo('Form_lookup_datum', 'approval_id');
    }
}

<?php

class Workflow_step_activity extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'workflow_id' => 'required',
		'workflow_step_id' => 'required',
		'name' => 'required',
		'activity_no' => 'required'
	);
    public function step()
    {
        return $this->belongsTo('Workflow_step', 'workflow_step_id');
    }
}

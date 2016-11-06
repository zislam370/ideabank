<?php

class Workflow_step extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'workflow_id' => 'required',
		'name' => 'required',
		'step_no' => 'required'
	);

    public function activities()
    {
        return $this->hasMany('Workflow_step_activity');
    }
}

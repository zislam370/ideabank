<?php

class Idea_step_activity_history extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_step_id' => 'required',
		'workflow_activity_id' => 'required',
		'status' => 'required',
		'due_date' => 'required',
		'initiate_date' => 'required',
		'next_activity' => 'required',
		'num_of_activities' => 'required',
		' activity_form_ids' => 'required'
	);
}

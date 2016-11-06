<?php

class Idea_step_history extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_id' => 'required',
		' workflow_step_id' => 'required',
		'next_step' => 'required',
		'num_of_steps' => 'required',
		'status' => 'required',
		'due_date' => 'required',
		'initiate_date' => 'required'
	);
}

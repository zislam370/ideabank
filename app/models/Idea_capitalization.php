<?php

class Idea_capitalization extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_id' => 'required',
		'step_id' => 'required',
		'activity_id' => 'required',
		'is_opened' => 'required',
		'is_closed' => 'required',
		'a2i_contribution' => 'required',
		'initiator_contribution' => 'required',
		'third_party_contribution' => 'required'
	);
}

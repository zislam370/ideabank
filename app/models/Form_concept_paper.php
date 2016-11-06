<?php

class Form_concept_paper extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_id' => 'required',
		'step_id' => 'required',
		'activity_id' => 'required',
//		'is_opened' => 'required',
//		'is_closed' => 'required',
		'concept' => 'required',
		'background' => 'required'
	);

    /**
     * Return how many initiated steps this idea has.
     *
     * @return array
     */
    public function items()
    {
        return $this->hasMany('Form_concept_paper_item');
    }
}

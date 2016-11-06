<?php

class Idea_step extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_id' => 'required',
		'workflow_step_id' => 'required',
		'next_step' => 'required',
		'num_of_steps' => 'required',
		'status' => 'required',
		'due_date' => 'required',
		'initiate_date' => 'required'
	);
    /**
     * Return the parent Idea.
     *
     * @return User
     */
    public function idea()
    {
        return $this->belongsTo('Idea', 'idea_id');
    }
    /**
     * Return the workflow_step info.
     *
     * @return Workflow_step
     */
    public function workflow_step()
    {
        return $this->belongsTo('Workflow_step', 'workflow_step_id');
    }
    /**
     * Return how many initiated activities this idea has.
     *
     * @return array
     */
    public function activities()
    {
        return $this->hasMany('Idea_step_activity');
    }

}

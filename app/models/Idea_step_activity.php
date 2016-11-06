<?php

class Idea_step_activity extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'idea_step_id' => 'required',
		'workflow_activity_id' => 'required',
//		'status' => 'required',
//		'due_date' => 'required',
//		'initiate_date' => 'required',
//		'next_activity' => 'required',
//		'num_of_activities' => 'required',
//		'activity_form_ids' => 'required'
	);
    /**
     * Return the parent Idea.
     *
     * @return Idea
     */
    public function idea()
    {
        return $this->belongsTo('Idea', 'idea_id');
    }
    /**
     * Return the parent idea step.
     *
     * @return Idea_step
     */
    public function idea_step()
    {
        return $this->belongsTo('Idea_step', 'idea_step_id');
    }
    /**
     * Return the workflow_step_activity info.
     *
     * @return Workflow_step_activity
     */
    public function workflow_step_activity()
    {
        return $this->belongsTo('Workflow_step_activity', 'workflow_activity_id');
    }

}

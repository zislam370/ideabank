<?php

class Form_concept_paper_item extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'form_concept_paper_id' => 'required',
		'feature' => 'required'
	);
    /**
     * Return the post's author.
     *
     * @return User
     */
    public function form_concept_paper()
    {
        return $this->belongsTo('Form_concept_paper', 'form_concept_paper_id');
    }

}

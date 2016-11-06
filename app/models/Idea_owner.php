<?php

class Idea_owner extends Eloquent {
	protected $guarded = array();

    public static $rules = array(
//		'name' => 'required',
    );

    /**
     * Return the post's author.
     *
     * @return User
     */
    public function owner()
    {
        return $this->belongsTo('User', 'user_id');
    }
    /**
     * Return the post's author.
     *
     * @return User
     */
    public function idea()
    {
        return $this->belongsTo('Idea', 'idea_id');
    }
}

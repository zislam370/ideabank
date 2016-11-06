<?php

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Idea_step_activity_attachment extends Eloquent implements StaplerableInterface {

    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment',[]);

        parent::__construct($attributes);
    }

    protected $guarded = array();

	public static $rules = array(
		'idea_step_activity_id' => 'required',
//		'head_id' => 'required',
		'comment' => 'required',
        'attachment' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,jpg,png,jpeg,txt,zip,rar',
	);
    public function head()
    {
        return $this->belongsTo('Form_lookup_datum', 'head_id');
    }
}

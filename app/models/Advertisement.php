<?php
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Advertisement extends Eloquent  implements StaplerableInterface {
    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment',[]);

        parent::__construct($attributes);
    }
	protected $guarded = array();

	public static $rules = array(
//		'workflow_category_id' => 'required',
		'link_title' => 'required',
//		'advert' => 'required',
		'name' => 'required',
		'start' => 'required',
		'end' => 'required',
	);
    public function workflow_category()
    {
        return $this->belongsTo('Workflow_category', 'workflow_category_id');
    }
//    public function idea()
//    {
//        return $this->hasMany('Idea', 'workflow_category_id');
//    }
}

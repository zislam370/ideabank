<?php

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Idea extends Eloquent  implements StaplerableInterface {

    use EloquentTrait;

//    protected $fillable = ['prob_file','sol_file'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('prob_file',[]);
        $this->hasAttachedFile('sol_file',[]);

        parent::__construct($attributes);
    }
	protected $guarded = array();

	public static $rules = array(
//		'fullname' => 'required',
		'name' => 'required',
//		'workflow_category_id' => 'required',
		'duration' => 'required|numeric|min:1',
//		'short_desc' => 'required',
		'prob_stmnt' => 'required',
		'sol_stmnt' => 'required',
        'prob_file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,jpg,png,jpeg,txt,zip,rar',
        'sol_file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,jpg,png,jpeg,txt,zip,rar',
	);

    /**
     * Return the post's author.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Return the post's author.
     *
     * @return User
     */
    public function category()
    {
        return $this->belongsTo('Workflow_category', 'workflow_category_id');
    }

    public function advertisement()
    {
        return $this->belongsTo('Advertisement','advertisement_id');
    }

    /**
     * Return how many initiated steps this idea has.
     *
     * @return array
     */
    public function steps()
    {
        return $this->hasMany('Idea_step');
    }
    public function area(){
        return $this->belongsTo('Domain','area_id');
    }
    public function division(){
        return $this->belongsTo('Domain','division_id');
    }
    public function district(){
        return $this->belongsTo('Domain','district_id');
    }
    public function upazilla(){
        return $this->belongsTo('Domain','upazilla_id');
    }
    public function office(){
        return $this->belongsTo('Domain','office_id');
    }
    public function ministry(){
        return $this->belongsTo('Domain','ministry_id');
    }
    public function mindivision(){
        return $this->belongsTo('Domain','min_division_id');
    }
    public function directorate(){
        return $this->belongsTo('Domain','directorate_id');
    }
//    /**
//     * Return how many initiated steps this idea has.
//     *
//     * @return array
//     */
//    public function mentors()
//    {
//        return $this->hasMany('Idea_mentor');
//    }
//    /**
//     * Return how many initiated steps this idea has.
//     *
//     * @return array
//     */
//    public function owners()
//    {
//        return $this->hasMany('Idea_owner');
//    }
    /**
     * Return how many initiated steps this idea has.
     *
     * @return array
     */
//    public function current_step()
//    {
//        return $this->hasOne('Idea_step');
//        //return $this->belongsTo('Idea_step','current_step_id');
//    }

}

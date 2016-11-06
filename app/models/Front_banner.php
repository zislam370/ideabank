<?php

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Front_banner extends Eloquent implements StaplerableInterface {

    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('img', [
            'styles' => [
//                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

    protected $guarded = array();

    public static $rules = array(
       // 'title' => 'required',
       // 'slide_title' => 'required',
        'img' => 'mimes:jpg,png,jpeg',
    );

}

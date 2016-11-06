<?php

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class Ck_file extends Elegant  implements StaplerableInterface
{
    use EloquentTrait;

//    protected $fillable = ['prob_file','sol_file'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('upload',[
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

    protected $guarded = array();  // Important
}
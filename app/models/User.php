<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;

class User extends SentryUserModel implements StaplerableInterface
{
    use EloquentTrait;

    // Add the 'avatar' attachment to the fillable array so that it's mass-assignable on this model.
//    protected $fillable = ['avatar'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }
    /**
     * Indicates if the model should soft delete.
     *
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Returns the user full name, it simply concatenates
     * the user first and last name.
     *
     * @return string
     */
    public function fullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function organization_type()
    {
        return $this->belongsTo('Form_lookup_datum', 'organization_type_id');
    }


    public function accountStatus()
    {
        $throttle = Sentry::findThrottlerByUserId($this->id);

        if ($throttle->isBanned()) {
            return 'banned';
        } elseif ($throttle->isSuspended()) {
            return 'suspended';
        } else {
            return '';
        }

    }

    public function area(){
        return $this->belongsTo('Domain','area_id');
    }
    public function office(){
        return $this->belongsTo('Domain','office_id');
    }

}

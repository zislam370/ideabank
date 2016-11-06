<?php

class BaseController extends Controller
{
    /**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $messageBag = null;

    /**
     * Initializer.
     *
     * @return void
     */
    public function __construct()
    {
        // CSRF Protection
        $this->beforeFilter('csrf', array('on' => 'post'));

        //
        $this->messageBag = new Illuminate\Support\MessageBag;
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function check_access($permissions){
        if ( Sentry::getUser()->hasAnyAccess($permissions) )
        {
            return true;
        }
        return false;
    }


    public function getUserWorkflowIds(){

        $groups = Sentry::getUser()->getGroups();
        $group_filter = '';
        $i = 0;
        foreach($groups as $group){
            if($i>0){
                $group_filter .= " OR ";
                $i++;
            }
            $group_filter .= " FIND_IN_SET('$group->id',groups) ";
        }
        $sql = "
                        SELECT
                          GROUP_CONCAT(`id`) 'workflow_ids'
                        FROM `eservice_idabank2`.`workflow_categories`
                        WHERE

                        $group_filter

                    ";
        $workflow_ids = DB::select( DB::raw($sql));

        return $workflow_ids[0]->workflow_ids;
    }
}

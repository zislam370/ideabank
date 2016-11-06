<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;
use DB;
use Sector;
use Domain;

class DashboardController extends AuthorizedController
{
    /**
     * Redirect to the profile page.
     *
     * @return Redirect
     */
    public function getIndex()
    {
        // Get the user information
        $user = Sentry::getUser();
//        var_dump($user); return;
        $applicant = Sentry::findGroupByName('Applicant');
        if ($user->inGroup($applicant)){
//            $layout = "frontend";
            return View::make('frontend/account/dashboard', compact('user'));
        }

        $capdev_div_ideas = $this->get_capdev_div_ideas();
        $capdev_div_idea_stat = $this->get_capdev_div_idea_stat(null,null,null);
//        return;
        $sectors =  "'" . implode("','", Sector::lists('name')) . "'";

        return View::make('backend/account/dashboard', compact('user','capdev_div_ideas','capdev_div_idea_stat','sectors'));

    }

    public function refresh_capdev_tcv(){

        $area_id = e(Input::get('area_id',-1));
        $office_id = e(Input::get('office_id',-1));
        $capdev_div_idea_tcv = $this->get_capdev_div_idea_tcv($area_id,$office_id);
        return View::make('backend/account/capdev_tcv', compact('capdev_div_idea_tcv'));
    }
    public function refresh_capdev_stat(){

        $area_id = e(Input::get('area_id',-1));
        $office_id = e(Input::get('office_id',-1));
        $sectors = e(Input::get('sectors',-1));
        $capdev_div_idea_stat = $this->get_capdev_div_idea_stat($area_id,$office_id,$sectors);
        return View::make('backend/account/capdev_stat', compact('capdev_div_idea_stat'));
    }

    public function dashboard_innovation_stats(){
        $capdev_div_idea_stat = $this->get_capdev_div_idea_stat(null,null,null);
    }
    public function dashboard_innovation_status(){
        $capdev_div_ideas = $this->get_capdev_div_ideas();
        $d1 = array();
        $d2 = array();
        $d3 = array();
        $l1 = 'আবেদন';
        $l2 = 'প্রকল্প';
        $l3 = 'বাস্তবায়িত';
        $i = 0;
        foreach($capdev_div_ideas as $capdev_div_idea){
            $d1[] = array($i,$capdev_div_idea->application);
            $d2[] = array($i,$capdev_div_idea->running);
            $d3[] = array($i,$capdev_div_idea->completed);
//            $d1[] = array($capdev_div_idea->name,$capdev_div_idea->application);
//            $d2[] = array($capdev_div_idea->name,$capdev_div_idea->running);
//            $d3[] = array($capdev_div_idea->name,$capdev_div_idea->completed);

            $i++;
        }
        $tmp = array();
        $tmp[0]['bars'] = array('order'=>1);
        $tmp[0]['data'] = $d1;
        $tmp[0]['label']= $l1;
        $tmp[1]['bars'] = array('order'=>2);
        $tmp[1]['data'] = $d2;
        $tmp[1]['label']= $l2;
        $tmp[2]['bars'] = array('order'=>3);
        $tmp[2]['data'] = $d3;
        $tmp[2]['label']= $l3;

        return $tmp;
    }

    private function get_capdev_div_idea_tcv($area_id,$office_id)
    {
        //find the type id
        $filter = 'workflow_category_id = 5';

        //Location
        //if null
        $location_str1 = "division_id,";
        $location_str2 = "AND division_id IS NOT NULL GROUP BY division_id";
        $location_str3 = "ON d.id = tmp.division_id WHERE d.type_id = 4";
        if($area_id){
            $area = Domain::where('id',$area_id)->first();
            if($area){
                if($area->type_id==4){
                    $location_str1 = "district_id,";
                    $location_str2 = "AND division_id=$area_id AND district_id IS NOT NULL GROUP BY district_id";
                    $location_str3 = "ON d.id = tmp.district_id WHERE d.type_id = 5 AND d.parent_id = $area_id ";
                }else if($area->type_id==5){
                    $location_str1 = "upazilla_id,";
                    $location_str2 = "AND district_id=$area_id AND upazilla_id IS NOT NULL GROUP BY upazilla_id";
                    $location_str3 = "ON d.id = tmp.upazilla_id WHERE d.type_id = 6 AND d.parent_id = $area_id ";
                }
            }
        }
        //office
        //check what is the domain type. considering the domain type make the query string
        $off_str = "";
        if($office_id){
            $off = Domain::where('id',$office_id)->first();
            if($off){
                if($off->type_id==1){
                    $off_str = " AND ministry_id=".$office_id." ";
                }else if($off->type_id==2){
                    $off_str = " AND min_division_id=".$office_id." ";
                }else if($off->type_id==3){
                    $off_str = " AND directorate_id=".$office_id." ";
                }
            }
        }
        $sql = "
                    SELECT d.id, d.`name`, tmp.*
                       FROM
                    domains	AS d
                    LEFT JOIN
                    (
                    SELECT

                    $location_str1

                    COUNT(CASE WHEN is_sorted = 1
                    THEN id
                    END) AS 'application' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                    THEN id
                    END) AS 'running' ,

                    COUNT(CASE WHEN is_closed = 1 AND (is_exited IS NULL OR is_exited = 0)
                    THEN id
                    END) AS 'completed' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_exited IS NULL OR is_exited = 0)
                    AND (100*(activities_done/total_activities))>50
                    THEN id
                    END) AS 'will_complete' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_exited IS NULL OR is_exited = 0)
                    AND ((100*(activities_done/total_activities))=100 OR is_closed = 1)
                    THEN id
                    END) AS 'done' ,

                    COUNT(CASE WHEN is_exited = 1
                    THEN id
                    END) AS 'not_completed' ,

                    COUNT(CASE WHEN is_sorted = 1 AND (is_opened IS NULL OR is_opened = 0)
                    THEN id
                    END) AS 'not_started' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                    AND (100*(activities_done/total_activities))>0
                    THEN id
                    END) AS 'started' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                    AND (100*(activities_done/total_activities))=0
                    THEN id
                    END) AS 'will_start'

                    FROM ideas
                    WHERE

                    $filter

                    $off_str

                    $location_str2

                    ) tmp

                    $location_str3

                    ";
        $capdev_div_idea_stat = DB::select( DB::raw($sql));
        return $capdev_div_idea_stat;
    }

    private function get_capdev_div_idea_stat($area_id,$office_id,$sectors)
    {

        //find user & role
        $workflow_ids = $this->getUserWorkflowIds();

        //find the type id
        $filter = " FIND_IN_SET(workflow_category_id,'$workflow_ids') ";

        //Location
        $location_str1 = "division_id,";
        $location_str2 = "AND division_id IS NOT NULL GROUP BY division_id";
        $location_str3 = "ON d.id = tmp.division_id WHERE d.type_id = 4";
        if($area_id){
            $area = Domain::where('id',$area_id)->first();
            if($area){
                if($area->type_id==4){
                    $location_str1 = "district_id,";
                    $location_str2 = "AND division_id=$area_id AND district_id IS NOT NULL GROUP BY district_id";
                    $location_str3 = "ON d.id = tmp.district_id WHERE d.type_id = 5 AND d.parent_id = $area_id ";
                }else if($area->type_id==5){
                    $location_str1 = "upazilla_id,";
                    $location_str2 = "AND district_id=$area_id AND upazilla_id IS NOT NULL GROUP BY upazilla_id";
                    $location_str3 = "ON d.id = tmp.upazilla_id WHERE d.type_id = 6 AND d.parent_id = $area_id ";
                }
            }
        }
        //office
        //check what is the domain type. considering the domain type make the query string
        $off_str = "";
        if($office_id){
            $off = Domain::where('id',$office_id)->first();
            if($off){
                if($off->type_id==1){
                    $off_str = " AND ministry_id=".$office_id." ";
                }else if($off->type_id==2){
                    $off_str = " AND min_division_id=".$office_id." ";
                }else if($off->type_id==3){
                    $off_str = " AND directorate_id=".$office_id." ";
                }
            }
        }
        //sectors
        //split comma sep to array than make the filter query string
        $sec_str = "";

        if($sectors){
            $secs = explode(',',$sectors);
            $i = 0;
            $max = sizeof($secs);
            $sec_str = " AND ( ";
            foreach ($secs as $sec) {
                $sec_str .= " find_in_set('$sec', sectors) ";
                if($max > $i + 1){
                    $sec_str .= " OR ";
                }
                $i = $i + 1;
            }
            $sec_str .= " ) ";
        }
        $sql = "
                    SELECT d.id, d.`name`, tmp.*
                       FROM
                    domains	AS d
                    LEFT JOIN
                    (
                    SELECT

                    $location_str1

                    COUNT(CASE WHEN is_sorted = 1
                    THEN id
                    END) AS 'application' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                    THEN id
                    END) AS 'running' ,

                    COUNT(CASE WHEN is_closed = 1 AND (is_exited IS NULL OR is_exited = 0)
                    THEN id
                    END) AS 'completed' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_exited IS NULL OR is_exited = 0)
                    AND (100*(activities_done/total_activities))>50
                    THEN id
                    END) AS 'will_complete' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_exited IS NULL OR is_exited = 0)
                    AND ((100*(activities_done/total_activities))=100 OR is_closed = 1)
                    THEN id
                    END) AS 'done' ,

                    COUNT(CASE WHEN is_exited = 1
                    THEN id
                    END) AS 'not_completed' ,

                    COUNT(CASE WHEN is_sorted = 1 AND (is_opened IS NULL OR is_opened = 0)
                    THEN id
                    END) AS 'not_started' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                    AND (100*(activities_done/total_activities))>0
                    THEN id
                    END) AS 'started' ,

                    COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                    AND (100*(activities_done/total_activities))=0
                    THEN id
                    END) AS 'will_start'

                    FROM ideas

                    WHERE

                    $filter

                    $off_str
                    $sec_str

                    $location_str2

                    ) tmp

                    $location_str3

                    ";
//        echo $sql; return;
        $capdev_div_idea_stat = DB::select( DB::raw($sql));
        return $capdev_div_idea_stat;
    }

    private function get_capdev_div_ideas(){
        $capdev_div_ideas = DB::select( DB::raw("
                        SELECT d.id, REPLACE(d.`name`,'বিভাগ','') 'name',
                          IFNULL(tmp.application,0) 'application',
                            IFNULL(tmp.running,0) 'running',
                              IFNULL(tmp.completed,0) 'completed'
                           FROM
                        domains	AS d
                        LEFT JOIN
                        (
                        SELECT division_id,

                        COUNT(CASE WHEN is_sorted = 1
                        THEN id
                        END) AS 'application' ,

                        COUNT(CASE WHEN is_opened = 1 AND (is_closed IS NULL OR is_closed = 0) AND (is_exited IS NULL OR is_exited = 0)
                        THEN id
                        END) AS 'running' ,

                        COUNT(CASE WHEN is_closed = 1 AND (is_exited IS NULL OR is_exited = 0)
                        THEN id
                        END) AS 'completed'

                        FROM ideas
                        WHERE workflow_category_id = 5
                        AND division_id IS NOT NULL
                        GROUP BY division_id
                        ) tmp
                        ON d.`id` = tmp.division_id
                        WHERE d.`type_id` = 4
                    "));
        return $capdev_div_ideas;
    }


}

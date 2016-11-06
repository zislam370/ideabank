<?php

return array(

    'Global' => array(
        array(
            'permission' => 'superuser',
            'label'      => 'Super User',
        ),
    ),

    'Admin' => array(
        array(
            'permission' => 'admin',
            'label'      => 'Admin Rights',
        ),
    ),

    'System Configuration' => array(
        array(
            'permission' => 'sys_config',
            'label'      => 'Manage System',
        ),
    ),

    'User Manager' => array(
        array(
            'permission' => 'users',
            'label'      => 'Manage User & Role',
        ),
    ),

    'Workflow' => array(
        array(
            'permission' => 'workflow',
            'label'      => 'Workflow Admin',
        ),
    ),

    'Workflow Manager' => array(
        array(
            'permission' => 'workflow_manager.read',
            'label'      => 'Read',
        ),
        array(
            'permission' => 'workflow_manager.write',
            'label'      => 'Write',
        ),
    ),

    'Admin-Dashboard' => array(
        array(
            'permission' => 'admin.dashboard',
            'label'      => 'Access To Admin Dashboard',
        ),
    ),

    'Event-Round' => array(
        array(
            'permission' => 'advertisements',
            'label'      => 'Manage Event/Round',
        ),
    ),

    'Posts' => array(
        array(
            'permission' => 'posts',
            'label'      => 'Manage Post',
        ),
    ),

    'Idea' => array(
        array(
            'permission' => 'idea.new',
            'label'      => 'New Idea',
        ),
        array(
            'permission' => 'idea.edit',
            'label'      => 'Edit Idea',
        ),
        array(
            'permission' => 'idea.selected_list',
            'label'      => 'Selected Ideas',
        ),
        array(
            'permission' => 'idea.complete_list',
            'label'      => 'Complete Ideas',
        ),
        array(
            'permission' => 'idea.exited_list',
            'label'      => 'Canceled Ideas',
        ),
        array(
            'permission' => 'idea.sorting',
            'label'      => 'Idea Sorting',
        ),
    ),

    'Idea Step' => array(
        array(
            'permission' => 'idea_steps',
            'label'      => 'Manage Step',
        ),
    ),

    'Idea Step Activities' => array(
        array(
            'permission' => 'idea_step_activity',
            'label'      => 'Manage Activities',
        ),
    ),

    'Notification' => array(
        array(
            'permission' => 'notification.send',
            'label'      => 'Send Notification',
        ),
        array(
            'permission' => 'notification.receive',
            'label'      => 'Receive Notification',
        ),
    ),

    'Idea Monitor' => array(
        array(
            'permission' => 'monitor.read',
            'label'      => 'Read',
        ),
        array(
            'permission' => 'monitor.write',
            'label'      => 'Write',
        ),
    ),

    'Idea Fund Management' => array(
        array(
            'permission' => 'fund.read',
            'label'      => 'Read',
        ),
        array(
            'permission' => 'fund.write',
            'label'      => 'Write',
        ),
    ),

    'Budget-Plan' => array(
        array(
            'permission' => 'budget_plan.read',
            'label'      => 'Read',
        ),
        array(
            'permission' => 'budget_plan.write',
            'label'      => 'Write',
        ),
    ),


    'Organize Innovation HR' => array(
        array(
            'permission' => 'org_inno_hr',
            'label'      => 'Manage HR',
        ),
    ),

);

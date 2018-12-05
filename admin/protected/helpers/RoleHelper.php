
<?php 
class RoleHelper {

public static function GetRole(){
    if ( Yii::app()->user->getState('role') == "Superadmin"){
        //set the actions which admin can access
        $actionlist = "'index','projectquestions','institutions','courses','courseitems','faculties','removeuser','deletecourseitems',
                        'deleteins','deletefacilites','deletecourse','deleteque','deleteuser','deletetemplate','editprofile'";
    }
    elseif ( Yii::app()->user->getState('role') == "Faculty"){
        //set the actions which staff can access
        $actionlist = "'projectquestions','courses','courseitems','faculties'";
    }
    elseif (Yii::app()->user->getState('role') == "Staff"){
        //set the actions which staff can access
        $actionlist = "'projectquestions','courses','courseitems','faculties'";
    }
    elseif (Yii::app()->user->getState('role') == "Admin"){
        //set the actions which staff can access
        $actionlist = "'projectquestions','courses','courseitems','faculties'";
    }

    return $actionlist;

}

}
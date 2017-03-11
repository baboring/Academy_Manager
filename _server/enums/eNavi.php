<?php
/* -------------------------------------------------------------
 purpos : Define varialbe and constant
 author : Benjamin
 date : Nov 11, 2016
 desc : 
------------------------------------------------------------- */


/*-----------------------------------------------------------
// Navi enum define
----------------------------------------------------------- */
final class Navi extends Enum{
    const Login = 'Login';
    const Join = 'Join';
    const Dashboard = 'Dashboard';
    const Profile = 'Profile';
    const Member = 'Member';
    const Student = 'Student';
    const Professor = 'Professor';
    const Program = 'Program';
    const Subject = 'Subject';
    const Enrollment = 'Enrollment';
    const Schedule = 'Schedule';

    // get path
    public static function GetUrl( $path, $action = null) {
        $res = URL.$path;
        if(null != $action)
            $res .= '/'.$action;
        return $res;
    }
}



?>
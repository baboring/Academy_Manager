<?php
/* -------------------------------------------------------------
 purpos : response json result for request
 author : Benjamin
 date : Nov 11, 2016
 desc : 
------------------------------------------------------------- */

    require_once ('_server/libs/db_connect.php');
    // require_once ('_server/modules/member/MemberHandler.php');

    class Api {
        public static $err_msg;

        public static function index() {
            // $result = array(
            //     'result' => 'fail',
            //     'err_msg' => '',
            // );
            // echo json_encode($result);
            Api::NotifyResult(null);
        }

        // Notifier for call back 
        private static function NotifyResult($result = null) {
            $html = '<script type="text/javascript">';
            $html .= 'window.onload = function() {';
            if(null != $result) {
                $html .= 'window.parent.receiveEvent('.$result.');';
            }
            $html .= '} </script>';
            echo $html;
        }

        // API Change Application Status
        public static function Application_Accept($ap_id) {
            require_once ('_server/modules/Enrollment/EnrollmentHandler.php');
            $res = EnrollmentHandler::UpdateStatus($ap_id, 1 );
            // for javascript
            $result = "{
                'func':'Callback_Application_Accept',
                'params':['".$res."','".$ap_id."']
            }";
            Api::NotifyResult($result);
        }    
       
        public static function Application_Enroll($ap_id) {
            require_once ('_server/modules/Enrollment/EnrollmentHandler.php');
            $res = EnrollmentHandler::UpdateStatus($ap_id, 2 );
            // for javascript
            $result = "{
                'func':'Callback_Application_Enroll',
                'params':['".$res."','".$ap_id."']
            }";
            Api::NotifyResult($result);
        } 

        public static function Application_Reject($ap_id) {
            require_once ('_server/modules/Enrollment/EnrollmentHandler.php');
            $res = EnrollmentHandler::UpdateStatus($ap_id, 99 );
            // for javascript
            $result = "{
                'func':'Callback_Application_Enroll',
                'params':['".$res."','".$ap_id."']
            }";
            Api::NotifyResult($result);
        }    
    }
?>
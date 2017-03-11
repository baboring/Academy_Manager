<?php

    // Session Data 
    class SessionManager {
        // is logged
        public static function IsLoggedIn() {
            return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
        }

        public static function SetLoggedIn($loginData) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["u_uid"] = $loginData->uid;

            $_SESSION["clt_uid"] = null;
            $_SESSION["clt_name"] = null;

            $_SESSION["username"] = $loginData->name;
            $_SESSION["usertype"] = $loginData->type;
            $_SESSION["authority"] = $loginData->authority;

            // for report
            $info = array();
            $info['uid'] = $loginData->uid;
            $info['name'] = $loginData->name;
            $info['email'] = $loginData->email;

            // self register client
            SessionManager::SetClientInfo($info);

        }

        public static function SetLoggedOut() {
            $_SESSION["loggedIn"] = null;
            $_SESSION["u_uid"] = null;
            $_SESSION["userid"] = null;

            $_SESSION["clt_uid"] = null;
            $_SESSION["clt_name"] = null;
            $_SESSION["username"] = null;
            $_SESSION["usertype"] = null;
            $_SESSION["authority"] = null;
            $_SESSION["userTypeNames"] = null;
        }

        /////////////////////////////////////////
        public static function GetUserName() {
            if(empty($_SESSION["username"]) || null == $_SESSION["username"])
                return "";
            return $_SESSION["username"];
        }
        /////////////////////////////////////////
        public static function GetUserTypeName() {
            if(empty($_SESSION["userTypeNames"])) {
                require_once ('_server/models/DataResult_UserTypes.php');
                    $list = Array();
                    foreach((new DataResult_UserTypes(PDO::FETCH_ASSOC, 99))->data as $key=>$value) {
                        $list[$value['m_code']] = $value['m_display'];
                    }
                    $_SESSION["userTypeNames"] = $list;
            }
            return $_SESSION["userTypeNames"][$_SESSION["usertype"]];

        }
        public static function GetUserTypeCode() {
            if(empty($_SESSION["usertype"]) || null == $_SESSION["usertype"])
                return "";
            return $_SESSION["usertype"];
        }
        /////////////////////////////////////////
        public static function GetUuid() {
            if(empty($_SESSION["u_uid"]) || null == $_SESSION["u_uid"])
                return "";
            return $_SESSION["u_uid"];
        }
        /////////////////////////////////////////
        public static function GetAuthority() {
            return $_SESSION["authority"];
        }
        public static function IsAuthority($level) {
            return ($_SESSION["authority"] >= $level);
        }

        /////////////////////////////////////////
        public static function GetDebug() {
            if(empty($_SESSION["debug"]))
                return null;
            return $_SESSION["debug"];
        }
        public static function SetDebug($val) {
            $_SESSION["debug"] = $val;
        }

        /////////////////////////////////////////
        public static function GetClientInfo() {
            if(null == $_SESSION["clt_uid"])
                return null;
            $info = array();
            
            $info['uid'] = $_SESSION["clt_uid"];
            $info['name'] = $_SESSION["clt_name"];
            $info['email'] = $_SESSION["clt_email"];

            return $info;
        }
        public static function SetClientInfo($val) {
            if(null === $val || null === $val['uid'])
                return;
            $_SESSION["clt_uid"] = $val['uid'];
            $_SESSION["clt_name"] = $val['name'];
            $_SESSION["clt_email"] = $val['email'];
        }
    }
?>
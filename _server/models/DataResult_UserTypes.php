<?php
    require_once ('_server/libs/db_connect.php');


    class DataResult_UserTypes {

        public $data;

        public function __construct($val, $auth_level = null) {//private constructor: 
            $szQuery = "select m_code,m_display from member_type ";
            $user_rows = dbCon::GetConnection()->query($szQuery);
            $this->data = $user_rows->fetchAll($val);
        }
    }

?>
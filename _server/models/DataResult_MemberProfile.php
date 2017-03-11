<?php
    require_once ('_server/libs/db_connect.php');
    // result data of list 
    class DataResult_MemberProfile {

        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            $szQuery = 'Select * ';
            $szQuery .= ' from `member` ';
            switch($key) {
                case 'uid':
                    $szQuery .= ' where `uid` = '.$val.' ';
                    break;
            }
            $szQuery .= ' LIMIT 1';
            //echo $szQuery;
            //get record from database and show
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetch(PDO::FETCH_ASSOC);
        }

    }

?>
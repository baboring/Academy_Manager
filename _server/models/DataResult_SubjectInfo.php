<?php
    require_once ('_server/libs/db_connect.php');

    // result data of Subject 
    class DataResult_SubjectInfo {

        public $err_msg;
        public $data;

        public function __construct($s_id = null) {//private constructor: 
            $szQuery = 'Select * ';
            $szQuery .= ' from `subject` ';
            if($s_id != null) {
                    $szQuery .= ' where `s_id` = '.$s_id.' ';
            }
            
            $szQuery .= ' LIMIT 1';
            //get record from database and show
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetch(PDO::FETCH_ASSOC);
        }

    }

?>
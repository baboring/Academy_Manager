<?php
    require_once ('_server/libs/db_connect.php');
    // result data of list 
    class DataResult_EnrollmentInfo {
        public $err_msg;
        public $data;

        public function __construct($u_uid) {//private constructor: 
            $szQuery = 'Select ';
            $szQuery .= '* ';
            $szQuery .= ' from `application` as AP';
            $szQuery .= ' join `program` as PG on PG.p_id = AP.ap_program_id  ';
            $szQuery .= ' where AP.ap_student_id = '.$u_uid;
            $szQuery .= ' LIMIT 1';
            //get record from database and show
            //echo $szQuery;
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>
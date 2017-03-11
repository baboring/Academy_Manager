<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of list 
    class DataResult_EnrollmentList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from `application` ");
            $this->textNav = true;
            parent::paginate($totalRecords->fetchColumn());

            $szQuery = 'Select ';
            $szQuery .= '* ';
            $szQuery .= ' from `application` as APP';
            $szQuery .= ' join `program` as PG on APP.ap_program_id = PG.p_id ';
            $szQuery .= ' join `member` as MEM on APP.ap_student_id = MEM.uid ';
            switch($key) {
                case 'st_uid':
                    $szQuery .= ' where `ap_student_id` = '.$val.' ';
                    break;
                case 'ap_id':
                    $szQuery .= ' where `ap_id` = '.$val.' ';
                    break;
            }

            $szQuery .= ' LIMIT '.parent::beginNumber().','.$this->itemsPerPage;
            //echo $szQuery;
            //get record from database and show
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>
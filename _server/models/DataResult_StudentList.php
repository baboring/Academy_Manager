<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of list 
    class DataResult_StudentList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from `student` ");
            $this->textNav = true;
            parent::paginate($totalRecords->fetchColumn());

            $szQuery = 'Select ';
            $szQuery .= 'A.st_uid ';
            $szQuery .= ',A.st_token ';
            $szQuery .= ',B.userid as `user id` ';
            $szQuery .= ',B.first_name as `first name` ';
            $szQuery .= ',B.last_name  as `last name` ';
            $szQuery .= ',st_program_id ';
            $szQuery .= 'from `student` as `A` ';
            $szQuery .= 'inner join `member` as B ';
            $szQuery .= 'on A.st_uid = B.uid ';
            switch($key) {
                case 'name':
                    $szQuery .= ' where `B.first_name` like  "%'.$val.'%" or `B.last_name` like "%'.$val.'%" ';
                    break;
                case 'email':
                    $szQuery .= ' where `B.email` like  "%'.$val.'%" ';
                    break;
            }

            $szQuery .= ' LIMIT '.parent::beginNumber().','.$this->itemsPerPage;
            //get record from database and show
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>
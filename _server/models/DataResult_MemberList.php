<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of list 
    class DataResult_MemberList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from `member` ");
            $this->textNav = true;
            parent::paginate($totalRecords->fetchColumn());

            $szQuery = 'Select ';
            $szQuery .= '`uid` ';
            $szQuery .= ',`userid` ';
            $szQuery .= ',`first_name` ';
            $szQuery .= ',`last_name` ';
            $szQuery .= ',`email` ';
            $szQuery .= ',`tel` as `Phone` ';
            $szQuery .= ',`m_code` ';
            $szQuery .= ',`reg_date` ';
            $szQuery .= ' from `member` ';
            switch($key) {
                case 'uid':
                    $szQuery .= ' where `uid` = '.$val.' ';
                    break;
                case 'userid':
                    $szQuery .= ' where `userid` like  "%'.$val.'%" ';
                    break;
                case 'email':
                    $szQuery .= ' where `email` like  "%'.$val.'%" ';
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
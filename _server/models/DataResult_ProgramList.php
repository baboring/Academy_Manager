<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of login 
    class DataResult_ProgramList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from `program` ");
            $this->textNav = true;
            parent::paginate($totalRecords->fetchColumn());

            $szQuery = 'Select ';
            $szQuery .= '* ';
            $szQuery .= ', (select count(*) from `subject` where s_program_id =  PG.p_id) as subjects';
            $szQuery .= ' from `program` as PG ';
            $szQuery .= ' LIMIT '.parent::beginNumber().','.$this->itemsPerPage;
            //get record from database and show
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>
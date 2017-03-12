<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of Subject 
    class DataResult_SubjectList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($p_id = null, $key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from `subject` ");
            $this->textNav = true;
            parent::paginate($totalRecords->fetchColumn());

            $szQuery = 'Select ';
            $szQuery .= 's_id ';
            $szQuery .= ',s_program_id ';
            $szQuery .= ',s_title ';
            $szQuery .= ',CONCAT(B.first_name," ",B.last_name) as Name ';
            //$szQuery .= ',s_professor_id ';
            $szQuery .= ',display as dayofweek';
            $szQuery .= ',s_begin_dayofweek as day';
            $szQuery .= ',s_begin_time_hour as hour';
            $szQuery .= ',s_begin_time_min as min';
            $szQuery .= ',s_take_minutes as term';
            $szQuery .= ',CONCAT(s_begin_time_hour,":",LPAD(s_begin_time_min,2,"0")) as time';
            $szQuery .= ' from `subject` as A ';
            $szQuery .= ' join `member` as B ';
            $szQuery .= ' On A.s_professor_id = B.uid ';            
            $szQuery .= ' join `dayofweek` as C ';
            $szQuery .= ' On A.s_begin_dayofweek = C.code ';            
            if($p_id != null) {
                    $szQuery .= ' where `s_program_id` = '.$p_id.' ';
            }
            switch($key) {
                case 'p_id':
                    $szQuery .= ($p_id != null)? 'and ' : ' where ';
                    $szQuery .= ' `p_id` = '.$val.' ';
                    break;
                case 's_professor_id':
                    $szQuery .= ($p_id != null)? 'and ' : ' where ';
                    $szQuery .= ' where `s_professor_id` = '.$val.' ';
                    break;
                case 'email':
                    $szQuery .= ($p_id != null)? 'and ' : ' where ';
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
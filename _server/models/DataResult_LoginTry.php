<?php
    require_once ('_server/libs/db_connect.php');
    // result data of login 
    class DataResult_LoginTry {

        public $IsCorrectPassword;
        public $err_msg;
        public $expire_date;
        public $uid;
        public $name;
        public $type;
        public $authority;

        public function __construct($userid, $password) {//private constructor: 
            $err_msg = null;
            $IsCorrectPassword = false;
            // verify if matching id & pass
            if(empty($userid)) {
                $this->err_msg = 'Error User ID is empty'; 
                return false;
            }

            $szQuery = "select uid, password, m_code, email,first_name,last_name,tel from member where userid = '".$userid."' limit 1"; 
            $res =  dbCon::GetConnection()->query($szQuery);

            if($res->rowCount() < 1) {
                $this->err_msg = 'Not exist user id';
                return false;
            }

            $data = $res->fetch();
            if($data['password'] != $password) {
                $this->err_msg = 'Password is Wrong!!!'.'<br>[TestMode - password] '.$data['password'];
                return false;
            }

            $IsCorrectPassword = true;

            $this->uid = $data['uid'];
            $this->email = $data['email'];
            $this->name = $data['first_name'].' '.$data['last_name'];

            // look up authority from types
            $szQuery = "select m_code, m_access_level, m_display from member_type where m_code = '".$data['m_code']."' limit 1"; 
            $res =  dbCon::GetConnection()->query($szQuery);
            if($res->rowCount() < 1) {
                $this->err_msg = 'Error unknown member type';
                return false;
            }            
            $data = $res->fetch();

            $this->authority = $data['m_access_level'];
            $this->type = $data['m_code'];

            // look up authority from types
            if( $data['m_code'] == 100 ) {  // student
                $szQuery = "select st_program_id from `student` where st_uid = '".$this->uid."' limit 1"; 
                $res =  dbCon::GetConnection()->query($szQuery);
                $data = $res->fetch();
            }
            else if( $data['m_code'] == 200 ) {  // staff
                $szQuery = "select sf_type from `staff` where sf_uid = '".$this->uid."' limit 1"; 
                echo $szQuery;
                $res =  dbCon::GetConnection()->query($szQuery);
                $data = $res->fetch();
            }
            else if( $data['m_code'] == 300 ) {  // profesor
                $szQuery = "select fa_type from `professor` where fa_uid = '".$this->uid."' limit 1"; 
                $res =  dbCon::GetConnection()->query($szQuery);
                $data = $res->fetch();
            }
            else {
                //error
                return false;
            }

            // success
            return true;

        }

    }

?>
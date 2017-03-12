<?php
    require_once ('_server/libs/db_connect.php');

    // NewMember Model Data
    class MemberHandler {

        const FormArgs = array(
                "uuid",
                "type",
                "first_name",
                "last_name",
                "email",
                "password",
                "businessName",
                "tel",
                "status",
                "address",
                "services", // array
                "desc_service",
                "user_id",

                "prod_company",
                "model_info",
                "plate_number"
            );

        public static $err_msg;

        // Search Member List Data
        public static function ReqData_MemberList($keyType = null, $keyword = null) {
            require_once ('_server/models/DataResult_MemberList.php');
            return new DataResult_MemberList($keyType, $keyword);
        }

        // check user id
        public static function IsExistId($user_id) {
            // insert query
            $szQuery = "select count(*) from `member` ";
            $szQuery .= " where userid = '".$user_id."'";

            $res = dbCon::GetConnection()->query($szQuery);
            return ($res->fetchColumn() > 0);
        }



       // update member
        public static function Update($dataForm) {
            if(empty($dataForm) || count($dataForm) < 1) {
                self::$err_msg = 'Error User id is empty';
                return false;
            }
            /* Begin a transaction, turning off autocommit */
            if(!dbCon::beginTransaction()) {
                self::$err_msg = 'Failed : beginTransaction';
                return false;
            }

            try {
                if(!self::UpdateAccount($dataForm['uuid'],$dataForm))
                    return false;
/*                // sub
                switch($dataForm['type']) {
                    case 100: // student
                        self::UpdateStudent($dataForm['uuid'],$dataForm);
                        break;
                    case 200: // staff
                        self::UpdateStaff($dataForm['uuid'],$dataForm);
                        break;
                    case 300: // professor
                        break;
                }
 */               
                dbCon::commit();
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = 'Error : '.$e->getMessage();
                SessionManager::SetDebug($e);
                dbCon::rollback();
                return false;
            }

            return true;
        }

        // Update Account
        private static function UpdatePassword($u_uid,$dataForm) {
            // insert query
            $szQuery = "UPDATE member set ";
            $szQuery .= "password = '".$dataForm['password']."'";
            $szQuery .= " where uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        private static function UpdateAccount($u_uid,$dataForm) {
            // insert query
            $szQuery = "UPDATE `member` set ";
            $szQuery .= "first_name = '".$dataForm['first_name']."'";
            $szQuery .= ",last_name = '".$dataForm['last_name']."'";
            $szQuery .= ",email = '".$dataForm['email']."'";
            $szQuery .= ",tel = '".$dataForm['tel']."'";
            $szQuery .= ",address = '".$dataForm['address']."'";
            $szQuery .= " where uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        // Update Client
        private static function UpdateStudent($u_uid,$dataForm) {
            // update query
            $szQuery = "UPDATE student set ";
            $szQuery .= "first_name = '".$dataForm['first_name']."'";
            $szQuery .= ",last_name = '".$dataForm['last_name']."'";
            $szQuery .= ",email = '".$dataForm['email']."'";
            $szQuery .= ",tel = '".$dataForm['tel']."'";
            $szQuery .= ",address = '".$dataForm['address']."'";
            $szQuery .= " where u_uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        // Update staff
        private static function UpdateStaff($u_uid,$dataForm) {
            // insert query
            $szQuery = "UPDATE staff set ";
            $szQuery .= "first_name = '".$dataForm['first_name']."'";
            $szQuery .= ",last_name = '".$dataForm['last_name']."'";
            $szQuery .= ",email = '".$dataForm['email']."'";
            $szQuery .= ",tel = '".$dataForm['tel']."'";
            $szQuery .= ",address = '".$dataForm['address']."'";
            $szQuery .= " where u_uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }





    }



?>
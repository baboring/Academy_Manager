<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/modules/Member/MemberHandler.php');

    // Join Handler
    class JoinHandler {

        public static $err_msg;

        // insert Account
        public static function InsertAccount($dataForm) {
            // insert query
            $szQuery = "INSERT into `member` (";
            $szQuery .= "userid";
            $szQuery .= ",password";
            $szQuery .= ",first_name";
            $szQuery .= ",last_name";
            $szQuery .= ",email";
            $szQuery .= ",tel";
            $szQuery .= ",address";
            $szQuery .= ",m_code";
            $szQuery .= ") VALUES (?,?,?,?,?,?,?,?)";

            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                if (!$stmt) {
                    echo "\nPDO::errorInfo():\n";
                    print_r($dbCon::GetConnection()->errorInfo());
                }

                $stmt->bindValue(1, $dataForm['user_id'], PDO::PARAM_STR);
                $stmt->bindValue(2, $dataForm['password'], PDO::PARAM_STR);
                $stmt->bindValue(3, $dataForm['first_name'], PDO::PARAM_STR);
                $stmt->bindValue(4, $dataForm['last_name'], PDO::PARAM_STR);
                $stmt->bindValue(5, $dataForm['email'], PDO::PARAM_STR);
                $stmt->bindValue(6, $dataForm['tel'], PDO::PARAM_STR);
                $stmt->bindValue(7, $dataForm['address'], PDO::PARAM_STR);
                $stmt->bindValue(8, $dataForm['type'], PDO::PARAM_INT);


                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    throw new PDOException('failed Insert Account');
                } 
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                SessionManager::SetDebug($e);
                throw $e;
            }
            catch(PDOException $e) {
                SessionManager::SetDebug($e);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    throw $e;
                }
                return -1;
            }
            return dbCon::GetConnection()->lastInsertId();
        }


        // insert student
        private static function InsertStudent($lastId,$dataForm) {
            // insert query
            $szQuery = "INSERT into `student` (";
            $szQuery .= "st_uid";
            $szQuery .= ",st_token";
            $szQuery .= ") VALUES (?,?)";

            //echo 'query='.$szQuery;
            try {
                // first of all, add student 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['token'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    throw new PDOException('failed Insert student');
                }
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                SessionManager::SetDebug($e);
                throw $e;
            }
            catch(PDOException $e) {
                SessionManager::SetDebug($e);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    throw $e;
                }
                return false;
            }
            return true;
        }

        // insert Professor
        private static function InsertProfessor($lastId,$dataForm) {
            // insert query
            $szQuery = "INSERT into `professor` (";
            $szQuery .= "fa_uid ";
            $szQuery .= ",fa_token ";
            $szQuery .= ") VALUES (?,?)";

            //echo 'query = '.$szQuery.' ('.$lastId.','.$dataForm['token'].')';

            try {
                // first of all, add Professor 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['token'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    throw new PDOException('failed Insert Professor');
                }
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                SessionManager::SetDebug($e);
                throw $e;
            }
            catch(PDOException $e) {
                SessionManager::SetDebug($e);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    throw $e;
                }
                return false;
            }
            return true;
        }

        // insert staff
        private static function InsertStaff($lastId,$dataForm) {
            // insert query
            $szQuery = "INSERT into `staff` (";
            $szQuery .= "sf_uid ";
            $szQuery .= ",sf_token ";
            $szQuery .= ",sf_type ";
            $szQuery .= ") VALUES (?,?,?)";

            //echo 'query='.$szQuery;
            try {
                // first of all, add Professor 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['secure'], PDO::PARAM_STR);
                $stmt->bindValue(3, 2, PDO::PARAM_INT);

                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    throw new PDOException('failed Insert Staff');
                }
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                SessionManager::SetDebug($e);
                throw $e;
            }
            catch(PDOException $e) {
                SessionManager::SetDebug($e);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    throw $e;
                }
                return false;
            }
            return true;
        }

       // add member
        public static function Add($dataForm) {
            if(empty($dataForm) || count($dataForm) < 1) {
                self::$err_msg = 'Error User id is empty';
                return false;
            }
            if(null == $dataForm['user_id'])
                $dataForm['user_id'] = $dataForm['email'];
            /* Begin a transaction, turning off autocommit */
            if(!dbCon::beginTransaction()) {
                self::$err_msg = 'Failed : beginTransaction';
                return false;
            }

            try {

                // check unique id 
                if(MemberHandler::IsExistId($dataForm['user_id']))
                    throw new Exception('Already exist user_id');

                $lastId = self::InsertAccount($dataForm);

                // client
                switch($dataForm['type']) {
                    case 100: // client
                        if(!self::InsertStudent($lastId,$dataForm)) {
                            dbCon::rollback();
                            return false;
                        }
                        break;
                    case 200: // staff
                        if(!self::InsertStaff($lastId,$dataForm)) {
                            dbCon::rollback();
                            return false;
                        }
                        break;
                    case 300: // Professor
                        if(!self::InsertProfessor($lastId,$dataForm)) {
                            dbCon::rollback();
                            return false;
                        }
                        break;
                }
                
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

    }



?>
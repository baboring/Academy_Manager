<?php
    require_once ('_server/libs/db_connect.php');

    // Enrollment Handler
    class EnrollmentHandler {

        public static $err_msg;

        // Search List Data
        public static function ReqData_EnrollmentList($keyType = null, $keyword = null) {

            require_once ('_server/models/DataResult_EnrollmentList.php');
            return new DataResult_EnrollmentList($keyType, $keyword);
        }

        public static function UpdateStatus($ap_uid, $status) {
            $szQuery = "UPDATE `application` set ";
            $szQuery .= " ap_status = ".$status;
            $szQuery .= " where ap_id = ".$ap_uid;
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

        public static function Add($dataForm) {
            // insert query
            $szQuery = "INSERT into `application` (";
            $szQuery .= "ap_program_id";
            $szQuery .= ",ap_student_id";
            $szQuery .= ") VALUES (?,?)";

            //echo 'query='.$szQuery;
            //echo var_dump($dataForm);
            try {
                // first of all, add student 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $dataForm['program_id'], PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['student_id'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    throw new PDOException('failed Insert Application');
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
    }



?>
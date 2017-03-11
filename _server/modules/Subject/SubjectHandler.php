<?php
    require_once ('_server/libs/db_connect.php');

    // Subject Handler
    class SubjectHandler {

        public static $err_msg;

        // Search List Data
        public static function ReqData_SubjectList($s_id = null, $keyType = null, $keyword = null) {

            require_once ('_server/models/DataResult_SubjectList.php');
            return new DataResult_SubjectList($s_id, $keyType, $keyword);
        }

        public static function Create($dataForm) {
            // insert query
            $szQuery = "INSERT into `subject` (";
            $szQuery .= "s_program_id ";
            $szQuery .= ",s_title ";
            $szQuery .= ",s_professor_id ";
            $szQuery .= ",s_begin_dayofweek ";
            $szQuery .= ",s_begin_time_hour ";
            $szQuery .= ",s_begin_time_min ";
            $szQuery .= ",s_take_minutes ";
            $szQuery .= ",s_room_info ";
            $szQuery .= ") VALUES (?,?,?,?,?,?,?,?)";

            //echo 'query='.$szQuery;
            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                if (!$stmt) {
                    echo "\nPDO::errorInfo():\n";
                    print_r(dbCon::GetConnection()->errorInfo());
                }

                $stmt->bindValue(1, $dataForm['program_id'], PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['subject_title'], PDO::PARAM_STR);
                $stmt->bindValue(3, $dataForm['professor_id'], PDO::PARAM_INT);
                $stmt->bindValue(4, $dataForm['begin_dayofweek'], PDO::PARAM_INT);
                $stmt->bindValue(5, $dataForm['begin_time_hour'], PDO::PARAM_INT);
                $stmt->bindValue(6, $dataForm['begin_time_min'], PDO::PARAM_INT);
                $stmt->bindValue(7, $dataForm['take_minutes'], PDO::PARAM_INT);
                $stmt->bindValue(8, $dataForm['room_info'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    var_dump($dataForm);
                    throw new PDOException('failed Insert Subject');
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

        // Update Subject
        public static function UpdateSubject($dataForm) {
            // insert query
            $szQuery = "UPDATE `subject` set ";
            $szQuery .= "s_program_id = '".$dataForm['program_id']."'";
            $szQuery .= ",s_title = '".$dataForm['subject_title']."'";
            $szQuery .= ",s_professor_id = '".$dataForm['professor_id']."'";
            $szQuery .= ",s_begin_dayofweek = '".$dataForm['begin_dayofweek']."'";
            $szQuery .= ",s_begin_time_hour = '".$dataForm['begin_time_hour']."'";
            $szQuery .= ",s_begin_time_min = '".$dataForm['begin_time_min']."'";
            $szQuery .= ",s_take_minutes = '".$dataForm['take_minutes']."'";
            $szQuery .= " where s_id = '".$dataForm['s_id']."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }



        // check Subject name
        public static function IsExistSubject($subject_name) {
            // insert query
            $szQuery = "select count(*) from `subject` ";
            $szQuery .= " where s_title = '".$subject_name."'";

            $res = dbCon::GetConnection()->query($szQuery);
            return ($res->fetchColumn() > 0);
        }

    }



?>
<?php
    require_once ('_server/libs/db_connect.php');

    // Program Handler
    class ProgramHandler {

        const FormArgs = array(
                "uuid",
                "type",
                "program_name",
                "program_memo"
            );

        public static $err_msg;

        // Search List Data
        public static function ReqData_ProgramList($keyType = null, $keyword = null) {

            require_once ('_server/models/DataResult_ProgramList.php');
            return new DataResult_ProgramList($keyType, $keyword);
        }

        public static function Create($dataForm) {
            // insert query
            $szQuery = "INSERT into `program` (";
            $szQuery .= "p_name ";
            $szQuery .= ",p_memo ";
            $szQuery .= ") VALUES (?,?)";

            //echo 'query='.$szQuery;
            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                if (!$stmt) {
                    echo "\nPDO::errorInfo():\n";
                    print_r(dbCon::GetConnection()->errorInfo());
                }

                $stmt->bindValue(1, $dataForm['program_name'], PDO::PARAM_STR);
                $stmt->bindValue(2, $dataForm['program_memo'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) {
                    print_r(dbCon::GetConnection()->errorInfo());
                    throw new PDOException('failed Insert Program');
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

        // check Program name
        public static function IsExistProgram($program_name) {
            // insert query
            $szQuery = "select count(*) from `program` ";
            $szQuery .= " where p_name = '".$program_name."'";

            $res = dbCon::GetConnection()->query($szQuery);
            return ($res->fetchColumn() > 0);
        }

    }



?>
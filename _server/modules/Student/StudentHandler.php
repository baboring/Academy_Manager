<?php
    require_once ('_server/libs/db_connect.php');

    // Module Handler
    class StudentHandler {

        const FormArgs = array(
                "uuid",
                "type",
                "first_name",
                "last_name",
            );

        // Search Student List Data
        public static function ReqData_StudentList($keyType = null, $keyword = null) {

            require_once ('_server/models/DataResult_StudentList.php');
            return new DataResult_StudentList($keyType, $keyword);
        }

    }



?>
<?php
    require_once ('_server/libs/db_connect.php');

    // Module Handler
    class ProfessorHandler {

        const FormArgs = array(
                "uuid",
                "type",
                "first_name",
                "last_name",
            );

        // Search Professor List Data
        public static function ReqData_ProfessorList($keyType = null, $keyword = null) {

            require_once ('_server/models/DataResult_ProfessorList.php');
            return new DataResult_ProfessorList($keyType, $keyword);
        }

    }



?>
<?php


    class Student {

        const FormArgs = array(
                "uuid",
                "type",
                "first_name",
                "last_name",
                "email",
                "password",
                "tel",
                "address",
                "user_id",
            );
        
        public function index() {
            self::View();
        }

        public function view() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Student/StudentView.php');
            require_once ('_server/views/footer.php');
        }

    }
?>
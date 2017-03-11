<?php


    class Profile {

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
            self::view();
        }

        public function view() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Member/MemberProfile.php');
            require_once ('_server/views/footer.php');
        }
    }
?>
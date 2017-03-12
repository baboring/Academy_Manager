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
        public function try_update() {
            require_once ('_server/modules/Member/MemberHandler.php');
            require_once ('_server/views/header.php');
            require_once ("_server/libs/MessageBox.php");

            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(Profile::FormArgs);
            $result = MemberHandler::Update($dataForm);
            $msgBox = new MessageBox();
            $msgBox->display_title = 'Update Member Profile!';
            if($result) {
            // -------- Success -----------
                $msgBox->display_contents = 'Success....';
                $msgBox->button = 'Ok';
                $msgBox->onClick = "GoUrl('".Navi::GetUrl(Navi::Profile)."');";
            } else {
            // -------- failed -----------
                $msgBox->display_contents = 'Fail!!'.MemberHandler::$err_msg;
                $msgBox->button = 'Go Back';
                $msgBox->onClick = 'HistoryBack();';
            }
            $msgBox->Display();
            require_once ('_server/views/footer.php');
        }
    }
?>
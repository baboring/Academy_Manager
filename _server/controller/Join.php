<?php


    class Join {

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
                "token",
                "license",
                "secure",
            );
        
        public function index() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            if (!empty($_GET['pwd'])) $inp_password = $_GET['pwd'];
                else $inp_password = '';            
            require_once ('_server/modules/Join/JoinView.php');
            require_once ('_server/views/footer.php');
        }

        public function try_join() {
            require_once ('_server/modules/Join/JoinHandler.php');
            require_once ('_server/views/header.php');
            require_once ("_server/libs/MessageBox.php");

            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(Join::FormArgs);
            $result = JoinHandler::Add($dataForm);
            $msgBox = new MessageBox();
            $msgBox->display_title = 'Register Member!';
            if($result) {
            // -------- Success -----------
                $msgBox->display_contents = 'Success....';
                $msgBox->button = 'Ok';
                $msgBox->onClick = "GoUrl('".Navi::GetUrl(Navi::Login)."');";
            } else {
            // -------- failed -----------
                $msgBox->display_contents = JoinHandler::$err_msg;
                $msgBox->button = 'Go Back';
                $msgBox->onClick = 'HistoryBack();';
            }
            $msgBox->Display();
            require_once ('_server/views/footer.php');
        }
    }
?>
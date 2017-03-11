<?php


    class Enrollment {

        const FormArgs = array(
                "program_id",
                "student_id",
            );
        
        public function index() {
            self::View();
        }

        public function view() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            switch(SessionManager::GetUserTypeCode()) {
                case 100:
                    require_once ('_server/modules/Enrollment/EnrollmentStatus.php');
                    break;
                case 200:
                    require_once ('_server/modules/Enrollment/EnrollmentList.php');
                    break;
                case 300:
                    break;
            }
            require_once ('_server/views/footer.php');
        }

        public function try_apply() {
            require_once ('_server/modules/Enrollment/EnrollmentHandler.php');
            require_once ('_server/views/header.php');
            require_once ("_server/libs/MessageBox.php");

            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(Enrollment::FormArgs);
            $result = EnrollmentHandler::Add($dataForm);
            $msgBox = new MessageBox();
            $msgBox->display_title = 'Program Enrollment!';
            if($result) {
            // -------- Success -----------
                $msgBox->display_contents = 'Success....';
                $msgBox->button = 'Go to Login';
                $msgBox->onClick = "GoUrl('".Navi::GetUrl(Navi::Enrollment)."');";
            } else {
            // -------- failed -----------
                $msgBox->display_contents = EnrollmentHandler::$err_msg;
                $msgBox->button = 'Go Back';
                $msgBox->onClick = 'HistoryBack();';
            }
            $msgBox->Display();
            require_once ('_server/views/footer.php');
        }
    }
?>
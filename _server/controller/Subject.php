<?php


    class Subject {

        const FormArgs = array(
                "s_id",
                "type",
                "program_id",
                "subject_title",
                "professor_id",
                "begin_dayofweek",
                "begin_time_hour",
                "begin_time_min",
                "take_minutes",
                "room_info",
            );
        
        public function index() {
            self::View();
        }

        public function view() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Subject/SubjectList.php');
            require_once ('_server/views/footer.php');
        }

        public function SubjectList($p_id) {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Subject/SubjectList.php');
            require_once ('_server/views/footer.php');
        }
        
        public function Add() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Subject/SubjectAdd.php');
            require_once ('_server/views/footer.php');
        }

        public function Edit($c_id) {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Subject/SubjectEdit.php');
            require_once ('_server/views/footer.php');
        }

        public function try_insert() {
            require_once ('_server/modules/Subject/SubjectHandler.php');
            require_once ('_server/views/header.php');
            require_once ("_server/libs/MessageBox.php");
            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(Subject::FormArgs);
            $result = SubjectHandler::Create($dataForm);
            $msgBox = new MessageBox();
            $msgBox->display_title = 'Register Subject!';
            if($result) {
            // -------- Success -----------
                $msgBox->display_contents = "Success";
                $msgBox->button = 'Next';
                $msgBox->onClick = "GoUrl('".Navi::GetUrl(Navi::Subject)."');";
            } else {
            // -------- failed -----------
                $msgBox->display_contents = SubjectHandler::$err_msg;
                $msgBox->button = 'Go Back';
                $msgBox->onClick = 'HistoryBack();';
            }
            $msgBox->Display();
            require_once ('_server/views/footer.php');
        }
        public function try_update() {
            require_once ('_server/modules/Subject/SubjectHandler.php');
            require_once ('_server/views/header.php');
            require_once ("_server/libs/MessageBox.php");
            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(Subject::FormArgs);
            $result = SubjectHandler::UpdateSubject($dataForm);
            $msgBox = new MessageBox();
            $msgBox->display_title = 'Update Subject!';
            if($result) {
            // -------- Success -----------
                $msgBox->display_contents = "Success";
                $msgBox->button = 'Next';
                $msgBox->onClick = "GoUrl('".Navi::GetUrl(Navi::Subject)."');";
            } else {
            // -------- failed -----------
                $msgBox->display_contents = SubjectHandler::$err_msg;
                $msgBox->button = 'Go Back';
                $msgBox->onClick = 'HistoryBack();';
            }
            $msgBox->Display();
            require_once ('_server/views/footer.php');
        }
    }
?>
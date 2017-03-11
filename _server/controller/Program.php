<?php


    class Program {

        const FormArgs = array(
                "uuid",
                "type",
                "program_name",
                "program_memo",
            );
        
        public function index() {
            self::View();
        }

        public function view() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Program/ProgramList.php');
            require_once ('_server/views/footer.php');
        }
        public function Add() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Program/ProgramAdd.php');
            require_once ('_server/views/footer.php');
        }

        public function try_insert() {
            require_once ('_server/modules/Program/ProgramHandler.php');
            require_once ('_server/views/header.php');
            require_once ("_server/libs/MessageBox.php");
            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(Program::FormArgs);
            $result = ProgramHandler::Create($dataForm);
            $msgBox = new MessageBox();
            $msgBox->display_title = 'Register Program!';
            if($result) {
            // -------- Success -----------
                require_once ('_server/modules/Program/ProgramList.php');
                require_once ('_server/views/footer.php');
                exit;
            } else {
            // -------- failed -----------
                $msgBox->display_contents = ProgramHandler::$err_msg;
                $msgBox->button = 'Go Back';
                $msgBox->onClick = 'HistoryBack();';
            }
            require_once ('_server/views/footer.php');
        }

    }
?>
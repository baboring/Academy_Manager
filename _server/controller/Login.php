<?php

    class Login {
        
        public function index() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/Login/LoginView.php');
            require_once ('_server/views/footer.php');
        }

        public function try_login() {

            $inp_userid = GetSafeValuePost('user_id');
            $inp_password = GetSafeValuePost('password');

            require_once ('_server/models/DataResult_LoginTry.php');
            $result = new DataResult_LoginTry($inp_userid, $inp_password);

            // login check
            if(null == $result->err_msg) {
                SessionManager::SetLoggedIn($result);
                Application::Redirect(Navi::Dashboard);
                exit(0);
            }
            else{
                $error_msg = "<h2>".$result->err_msg."</h2>";
            }
            ///////////////////////////////////////////
            require_once ('_server/views/header.php');
            require_once ('_server/modules/Login/LoginView.php');
            require_once ('_server/views/footer.php');
        }

        public function logout() {
            SessionManager::SetLoggedOut();
            header('location: '.URL);
        }
    }
?>
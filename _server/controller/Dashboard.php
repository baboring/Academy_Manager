<?php

    class Dashboard {
        
        public function index() {
            require_once ('_server/views/header.php');
            if(SessionManager::IsLoggedIn()) {
                require_once ("_server/modules/Dashboard/DashboardView.php");
            }
            require_once ('_server/views/footer.php');
        }

        public function logout() {
            GlobalData::SetLoggedOut();
            $this->index();
        }
    }
?>
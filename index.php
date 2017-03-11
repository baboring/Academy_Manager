<?php
    /* -------------------------------------------------------------
    purpos : Separate API and Application 
    author : Benjamin
    date : Nov 11, 2016
    desc : 
    ------------------------------------------------------------- */
    require_once ('_config/config.php');

    //----------------------------------------
    if (isset($_GET['func'])) {
        // Working on API functions
        require_once ('_api/functions.php');
    }
    else {
        // Main Application Run
        include_once ('_server/Application.php');

        Application::Dispatch();

    }
?>

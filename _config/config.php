<?php
/* -------------------------------------------------------------
 purpos : set up configuration
 author : Benjamin
 date : Oct 10, 2016
 desc : 
------------------------------------------------------------- */
class Config {

    public static $DsnMember; 

    public static function Setup() {

        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        define('APP_NAME', 'Academy Manager');
        define('URL', 'http://localhost:8102/');
        /** later, we can write here about db config  */
        Config::$DsnMember = json_decode('{"dsn":"mysql:host=localhost;dbname=academy","root":"root","pwd":""}', true);
        session_start();
    }
        
}

////////////////////////////////
Config::Setup();


////////////////////////////////
?>
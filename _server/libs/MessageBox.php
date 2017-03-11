<?php

    class MessageBox {
        public $display_contents;
        public $display_title;
        public $button;
        public $onClick;
        
        public function __construct() {
            $this->onClick = '';
            $this->display_contents = '';
            $this->display_title = '';
            $this->button = "button";
        }

        public function Display() {
            require_once ('_server/libs/MessageBoxView.php');
        }
    }
?>
<?php

class Paginator {
        public $itemsPerPage;
        public $range;
        public $currentPage;
        public $total;
        public $textNav;
        public $itemSelect;

        private $_navigation;
        private $_link;
        private $_pageNumHtml;
        private $_itemHtml;

        // Constructor
        public function __construct()
        {
            //set default values
            $this->itemsPerPage = 10;
            $this->range = 5;
            $this->currentPage = 1;
            $this->total = 0;
            $this->textNav = false;
            $this->itemSelect = array(10,25,50,100,'All');
            //private values
            $this->_navigation = array(
                'next'=>'Next',
                'pre' =>'Pre',
                'ipp' =>'Item per page'
            );
            //$this->_link = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_STRING);
            $this->_link = "";
            $this->_pageNumHtml = '';
            $this->_itemHtml = '';
        }

        /**
        * paginate main function
        *
        * @author The-Di-Lab <thedilab@gmail.com>
        * @access public
        * @return type
        */
        public function paginate($total_row_count)
        {
            $this->total = ceil($total_row_count / $this->itemsPerPage);
            
            //get current page
            if(isset($_GET['current']))
                $this->currentPage = $_GET['current'];
            //get item per page
            if(isset($_GET['item']))
                $this->itemsPerPage = $_GET['item'];
            //get page numbers
            $this->_pageNumHtml = $this->_getPageNumbers();
            //get item per page select box
            $this->_itemHtml = $this->_getItemSelect();
        }

        public function pageNumbers()
        {
            if(empty($this->_pageNumHtml)){
                exit('Please call function paginate() first.');
            }
            return $this->_pageNumHtml;
        }


        public function beginNumber()
        {
            return ($this->currentPage-1) * $this->itemsPerPage;
        }


        public function itemsPerPage()
        {
            if(empty($this->_itemHtml)){
                exit('Please call function paginate() first.');
            }
            return $this->_itemHtml;
        }

        private function _getPageNumbers()
        {
            $html = '<ul class="pagination">';
            //previous link button
            if($this->textNav && ($this->currentPage>1)){
                $html .= '<li><a href="'.$this->_link .'?current='.($this->currentPage-1).'"';
                $html .= '>'.$this->_navigation['pre'].'</a></li>';
            }
            //do ranged pagination only when total pages is greater than the range
            if($this->total > $this->range){
                $start = ($this->currentPage <= $this->range)? 1 : ($this->currentPage - $this->range);
                $end = ($this->total - $this->currentPage >= $this->range)? ($this->currentPage+$this->range) : $this->total;
            } else {
                $start = 1;
                $end = $this->total;
            }
            //loop through page numbers
            for($i = $start; $i <= $end; $i++){
                $html .= '<li><a href="'.$this->_link .'?current='.$i.'"';
                if($i==$this->currentPage) $html .= "class='active'";
                    $html .= '>'.$i.'</a></li>';
            }
            //next link button
            if($this->textNav && ($this->currentPage < $this->total)){
                $html .= '<li><a href="'.$this->_link .'?current='.($this->currentPage+1).'"';
                $html .= '>'.$this->_navigation['next'].'</a></li>';
            }
            $html .= '</ul>';
            return $html;
        }

        private function _getItemSelect()
        {
            $items = '';
            $ippArray = $this->itemSelect;
            foreach($ippArray as $ippOpt){
               $items .= ($ippOpt == $this->itemsPerPage) ? "<option selected value=\"$ippOpt\">$ippOpt</option>\n":"<option value=\"$ippOpt\">$ippOpt</option>\n";
            }
            return "<span class=\"paginate\">".$this->_navigation['ipp']."</span>
            <select class=\"paginate\" onchange=\"window.location='$this->_link?current=1&item='+this[this.selectedIndex].value;return false\">$items</select>\n";
        }
}

?>
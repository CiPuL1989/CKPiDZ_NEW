<?php
    class Page {
        private $PageList;
        
        public function __construct($FileName) {
            if(file_exists($FileName)) {
                include $FileName;
            }
            else { 
                echo '<p class="ErrorMessage">Nie odnaleziono pliku1 '.$FileName.'</p>';
            }
            $this->PageList = $PageList;
        }
        
        public function LoadPage($FileName){
            if(array_key_exists($FileName, $this->PageList)) {
                if(file_exists($this->PageList[$FileName])){
                    require_once $this->PageList[$FileName];
                }
                else {
                    echo 'LOAD DEFAULT PAGE1';
                }
            }
            else {
                echo 'LOAD DEFAULT PAGE2';
            }
        }
    }
?>
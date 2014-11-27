<?php
    class FILE {
        public function FileExists($Filename) {
          if(file_exists($Filename)){
              require_once $Filename;
              return TRUE;
          }
          else {
              return 'Nie odnaleniono pliku '.$Filename;
          }
        }
    }
?>
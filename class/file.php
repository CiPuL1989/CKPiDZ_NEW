<?php
    class FILE {
        public function FileExists($filename) {
          if(file_exists($filename)){
              require_once $filename;
          }
          else {
              return 'Komunikat błędu: Nie odnaleniono pliku '.$filename;
          }
        }
    }
?>
<?php    class FILE {        public function FileExists($FileName) {          if(file_exists($FileName)){              require_once $FileName;              return TRUE;          }          else {              return 'E20';          }        }    }?>
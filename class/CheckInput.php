<?php
    class CHECKINPUT {
        public function CheckSign($InputName, $InputCheck) {
            $InputName = trim($InputName);
            if(!preg_match($InputCheck, $InputName)) {
                return FALSE;
            }
            return TRUE;
        }
        public function CheckLenght($InputName, $InpuMinCheck, $InputMaxCheck) {
            $InputName = trim($InputName);
            if(strlen($InputName) < $InpuMinCheck || strlen($InputName) > $InputMaxCheck) {
                return FALSE;
            }
            else {
                return TRUE;
            }
        }
    }
?>
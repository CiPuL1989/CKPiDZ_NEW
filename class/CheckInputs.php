<?php
    class CHECKINPUT {
        public function CheckSign($InputName, $InputCheck) {
            for($i=0;$i<strlen($InputName);$i++) {
                if(!preg_match($InputCheck, $InputName[$i])) {
                    return FALSE;
                }
                else {
                    return TRUE;
                }
            }
        }
        public function CheckLenght($InputName, $InpuMinCheck, $InputMaxCheck) {
            if(strlen($InputName) < $InpuMinCheck || strlen($input) > $InputMaxCheck) {
                return FALSE;
            }
            else {
                return TRUE;
            }
        }
    }
?>
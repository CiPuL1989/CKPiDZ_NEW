<?php
    class SENDEMAIL {
        private $ActivationCode = 0;
        
        public function GenerateActivationCode(){
            $this->ActivationCode = md5(time().rand());
        }
        
        public function GetActivationCode() {
            return $this->ActivationCode;
        }
        
        public function Send($To, $Title, $Message, $Headers) {
            if(mail($To, $Title, $Message, $Headers)) {
                return 'Email autoryzacyjny został wysłany';
            }
            else {
                return 'Email autoryzacyjny nie został wysłany';
            }
        }
    }
?>
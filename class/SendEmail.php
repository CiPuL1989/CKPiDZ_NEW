<?php
    class SENDEMAIL {
        private $ActivationCode = 0;
        
        public function GenerateActivationCode($Lenght){
            $this->ActivationCode = substr(md5(date("d.m.Y.H.i.s").rand(1,1000000)) , 0 , $Lenght);
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
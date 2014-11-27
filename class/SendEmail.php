<?php
    class SENDEMAIL {
        private $ActivationCode = 0;
        
        public function GenerateActivationCode($Lenght){
            $this->ActivationCode = substr(md5(date("d.m.Y.H.i.s").rand(1,1000000)) , 0 , $lenght);
        }
        
        public function Send($To, $Title, $Message) {
            if(mail($To, $Title, $Message)) {
                return TRUE;
            }
            else {
                return 'Email autoryzacyjny nie został wysłany';
            }
        }
    }
?>
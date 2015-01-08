<?php
    class USER {
        private $Password;
        
        public function GenerateHashPassword($Password, $ActivationCode) {
            $this->Password = md5($Password.$ActivationCode);
        }
        
        public function GetPassword() {
            return $this->Password;
        }
    }
?>
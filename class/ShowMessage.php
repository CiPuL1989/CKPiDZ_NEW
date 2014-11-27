<?php
    class SHOWMESSAGE {
        public function ViewErrorMessage($Message) {
            if($Message != NULL && $Message != TRUE){
                echo '<p class="error">Komunikat błędu: '.$Message.'.</p>';
            }
        }
    }
?>
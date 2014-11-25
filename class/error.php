<?php
    class ERROR {
        public function ViewError($error) {
            if($error != NULL){
                echo 'a';
                echo '<p class="error">'.$error.'</p>';
            }
        }
    }
?>
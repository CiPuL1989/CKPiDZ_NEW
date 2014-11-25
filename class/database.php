<?php
    class DATABASE extends mysqli {
        public function __construct($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_NAME) {
            parent::__construct($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_NAME);
        }
        
        public function ErrorConnect() {
            if(mysqli_connect_errno()) {
                return 'Komunikat błędu: Brak połączenia z bazą danych '.mysqli_connect_errno().' '. mysqli_connect_error();
            }
        }
    }
?>
<?php
    class DATABASE {
        public function DATABASE_CONNECT($database_host, $database_name, $database_user, $database_password) {
            mysqli_connect($database_host, $database_name, $database_user, $database_password);
            if(mysqli_connect_errno()) {
                return 'Błąd połączenia z bazą danych';
            }
            else {
                return 'Połączenie z bazą danych';
            }
        }
    }
?>
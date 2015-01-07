<?php
    class DATABASE {
        private $Connection;
        
        public function Connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_NAME, $DATABASE_CHARSET) {
            $this->Connection = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_NAME);
            
            if($this->Connection->connect_errno) {
                return 'Połączenie z bazą danych zakończone niepowodzeniem '.mysqli_connect_errno().' '. mysqli_connect_error();
            }
            else {
                $this->Connection->set_charset($DATABASE_CHARSET);
                return TRUE;
            }
        }
        
        public function QuerySetValue($Query) {
            $Query = $this->Connection->real_escape_string($Query);
            
            if($this->Connection->query($Query)) {
                return TRUE;
            }
            else {
                return 'Zapytanie do bazy danych zakończone niepowodzeniem';
            }
        }
        
        public function QueryGetValue($Query){
            $Query = $this->Connection->real_escape_string($Query);
            
            if($Result = $this->Connection->query($Query)) {
                return $Result;
            }
            else {
                return 'Zapytanie do bazy danych zakończone niepowodzeniem';
            }
        }

        public function Close() {
            if($this->Connection->close()) {
                return TRUE;
            }
            else {
                return 'Zamknięcie połącznia z bazą danych zakończone niepowodzeniem';
            }
        }
    }
?>
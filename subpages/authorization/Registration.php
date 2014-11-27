<form name="Registration" method="post" action="">
    <input type="text" name="Forename" value="Imię" onfocus="" onblur="">
    <input type="text" name="Name" value="Nazwisko" onfocus="" onblur="">
    <select name="Function">
        <option value="0">Administrator</option>
        <option value="2">Dyrektor</option>
        <option value="3">Wicedyrektor</option>
        <option value="4">Kierownik warsztatu</option>
        <option value="5">Nauczyciel</option>
        <option value="6">Referent</option>
    </select>
    <input type="text" name="Email" value="Adres E-mail" onfocus="" onblur="">
    <input type="password" name="Password" value="Hasło użytkownika" onfocus="" onblur="">
    <input type="password" name="PasswordRepeat" value="Powtórz Hasło użytkownika" onfocus="" onblur="">
    
    <a onclick="document.Registration.submit()">Wyślij</a>
    
    <?php
        
        if(empty($_POST)) {
            $SHOWMESSAGE->ViewErrorMessage('Wypełnij wymagane pola');
        }
        else {
            $Foremane = $_POST['Forename'];
            $Name = $_POST['Name'];
            $Function = $_POST['Function'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $PasswordRepeat = $_POST['PasswordRepeat'];
            
            $ForemaneCheck = '/[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ-]/';
            $NameCheck = '/[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ-]/';
            $EmailCheck = '/^(.[a-z0-9\-]*\w)+@+([a-z0-9\-]*\w)+(\.[a-z]*\w)+$/i';
            $PasswordCheck = '/[a-zA-Z0-9]/';
            
            //$CHECKINPUT = new CHECKINPUT(); //DELETE
            
            if($CHECKINPUT->CheckSign($Foremane, $ForemaneCheck) == FALSE) {
                $SHOWMESSAGE->ViewErrorMessage('Podane imię zawiera niedozwolone znaki');
            }
            else if($CHECKINPUT->CheckLenght($Foremane, 3, 32) == FALSE) {
                $SHOWMESSAGE->ViewErrorMessage('Podane imię posiada niepoprawną długość');
            }
            else {
                if($CHECKINPUT->CheckSign($Name, $NameCheck) == FALSE) {
                    $SHOWMESSAGE->ViewErrorMessage('Podane nazwisko zawiera niedozwolone znaki');
                }
                else if($CHECKINPUT->CheckLenght($Name, 3, 32) == FALSE) {
                    $SHOWMESSAGE->ViewErrorMessage('Podane nazwisko posiada niepoprawną długość');
                }
                else {
                    if($CHECKINPUT->CheckSign($Email, $EmailCheck) == FALSE) {
                        $SHOWMESSAGE->ViewErrorMessage('Podany adres e-mail jest niepoprawny');
                    }
                    else if($CHECKINPUT->CheckLenght($Email, 6, 32) == FALSE) {
                        $SHOWMESSAGE->ViewErrorMessage('Podany adres e-mail posiada niepoprawną długość');
                    }
                    else {
                        if($Password != $PasswordRepeat) {
                            $SHOWMESSAGE->ViewErrorMessage('Podane hasła różnią się');
                        }
                        else if($CHECKINPUT->CheckSign($Password, $PasswordCheck) == FALSE || $CHECKINPUT->CheckSign($PasswordRepeat, $PasswordCheck) == FALSE) {
                            $SHOWMESSAGE->ViewErrorMessage('Podane hasło zawiera niedozwolone znaki');
                        }
                        else if($CHECKINPUT->CheckLenght($Password, 8, 16) == FALSE || $CHECKINPUT->CheckLenght($PasswordRepeat, 8, 32) == FALSE) {
                            $SHOWMESSAGE->ViewErrorMessage('Podane hasło posiada niepoprawną długość');
                        }
                        else {
                            $Title =    'CKPiDZ Ruda Śląska - aktywacja konta';
                            $Message =  'Otrzymałeś tę wiadomość, ponieważ dokonano rejestracji na stronie CKPiDZ Ruda Śląska z wykorzystaniem Twojego adresu e-mail.'
                                        .' Przygotowaliśmy dla Ciebie indywidualne konto, ale jest ono jeszcze nieaktywne. Aby móc z niego korzystać kliknij w link:'
                                        .EMAIL_CONFIRMATION_LINK;
                            
                            $SHOWMESSAGE-ViewErrorMessage($SENDMAIL->Send(EMAIL_ADDRESS, $Title, $Message));
                        }
                    }
                }
            }
        }
    ?>
    
</form>
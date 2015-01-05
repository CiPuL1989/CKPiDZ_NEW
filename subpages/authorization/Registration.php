<form name="Registration" method="post" action="index.php?Page=subpages/authorization/Registration.php">
    <input type="text" name="Forename" value="Łukasz" onfocus="" onblur="">
    <input type="text" name="Name" value="Ocipka" onfocus="" onblur="">
    <select name="Function">
        <option value="1">Administrator</option>
        <option value="2">Dyrektor</option>
        <option value="3">Wicedyrektor</option>
        <option value="4">Kierownik warsztatu</option>
        <option value="5">Nauczyciel</option>
        <option value="6">Referent</option>
    </select>
    <input type="text" name="Email" value="luk.ocipka@gmail.com" onfocus="" onblur="">
    <input type="password" name="Password" value="zaq12wsx" onfocus="" onblur="">
    <input type="password" name="PasswordRepeat" value="zaq12wsx" onfocus="" onblur="">
    
    <a onclick="document.Registration.submit()">Wyślij</a>
    
    <?php
        if(!empty($_POST)) {
            $CHECKINPUT = new CHECKINPUT();
            $SHOWMESSAGE = new SHOWMESSAGE();
            $SENDEMAIL = new SENDEMAIL();

            $Foremane = $_POST['Forename']; 
            $Name = $_POST['Name'];
            $Function = $_POST['Function'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $PasswordRepeat = $_POST['PasswordRepeat'];

            $ForemaneCheck = '/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,32}$/';
            $NameCheck = '/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ_-]{3,32}$/';
            $EmailCheck = '/^([a-zA-Z0-9\._-]+)@([a-zA-Z0-9\._-]+)\.([a-zA-Z]+)$/';
            $PasswordCheck = '/^[a-zA-Z0-9]{8,16}$/';

            if($CHECKINPUT->CheckSign($Foremane, $ForemaneCheck) == FALSE) {
                $SHOWMESSAGE->ViewErrorMessage('Podane imię zawiera niedozwolone znaki lub posiada niepoprawną długość');
            }
            else {
                if($CHECKINPUT->CheckSign($Name, $NameCheck) == FALSE) {
                    $SHOWMESSAGE->ViewErrorMessage('Podane nazwisko zawiera niedozwolone znaki lub posiada niepoprawną długość');
                }
                else {
                    if($CHECKINPUT->CheckSign($Email, $EmailCheck) == FALSE) {
                        $SHOWMESSAGE->ViewErrorMessage('Podany adres e-mail jest niepoprawny lub posiada niepoprawną długość');
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
                            if($Function<1 && $Function>6 ){
                                $SHOWMESSAGE->ViewErrorMessage('Wybrałęś niedozwoloną funcję');
                            }
                            else {
                                $SENDEMAIL->GenerateActivationCode(25);
                                $Title =    'CKPiDZ Ruda Śląska - aktywacja konta';
                                $Message =  '<html><body>'.
                                            '<p>Witaj, </p>'.
                                            '<p></p>'.
                                            'Otrzymałeś tę wiadomość, ponieważ dokonano rejestracji na stronie CKPiDZ Ruda Śląska z wykorzystaniem Twojego adresu e-mail. Przygotowaliśmy dla Ciebie indywidualne konto, ale jest ono jeszcze nieaktywne. Aby móc z niego korzystać kliknij w link:'.
                                            '<p>'.EMAIL_CONFIRMATION_LINK.$SENDEMAIL->GetActivationCode().'</p>'.
                                            '<p></p>'.
                                            'Administrator'.
                                            '<p>Centrum Kształcenia Praktycznego i Doskonalenia Zawodowego w Rudzie Śląskiej</p>'.
                                            '<p>ul. Hallera 6, 41-709 Ruda Śląska</p>'.
                                            '<p>tel. (32) 248-73-80, email: ckpidz@ckprsl.pl, www: ckprsl.pl</p>'.
                                            '</body></html>';
                                
                                $Headers = "MIME-Version: 1.0\r\n";
                                $Headers .= "Content-Type: text/html; charset=utf-8\r\n";
                                
                                $SHOWMESSAGE->ViewErrorMessage($SENDEMAIL->Send(EMAIL_ADDRESS, $Title, $Message, $Headers));
                            }
                        }
                    }
                }
            }
        }
    ?>
    
</form>
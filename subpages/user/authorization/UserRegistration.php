<form name="UserRegistration" method="post" action="index.php?Page=UserRegistration">    <input type="text" name="Forename" value="Imię" onfocus="" onblur="">    <input type="text" name="Name" value="Nazwisko" onfocus="" onblur="">    <select name="Function">        <option value="1">Administrator</option>        <option value="2">Dyrektor</option>        <option value="3">Wicedyrektor</option>        <option value="4">Kierownik warsztatu</option>        <option value="5">Nauczyciel</option>        <option value="6">Referent</option>    </select>    <input type="text" name="Email" value="Adres Email" onfocus="" onblur="">    <input type="password" name="Password" value="Password" onfocus="" onblur="">    <input type="password" name="PasswordRepeat" value="Password" onfocus="" onblur="">    <a onclick="document.UserRegistration.submit()">Wyślij</a>    <?php        if(!empty($_POST)) {            $INPUT = new INPUT();            $MESSAGE = new MESSAGE('settings/MessageCode.php');            $EMAIL = new EMAIL();            $DATABASE = new DATABASE();            $USER = new USER();            $Foremane = $_POST['Forename'];             $Name = $_POST['Name'];            $Function = $_POST['Function'];            $Email = $_POST['Email'];            $Password = $_POST['Password'];            $PasswordRepeat = $_POST['PasswordRepeat'];                        $ForemaneCheck = '/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,32}$/';            $NameCheck = '/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ_-]{3,32}$/';            $EmailCheck = '/^([a-zA-Z0-9\._-]+)@([a-zA-Z0-9\._-]+)\.([a-zA-Z]+)$/';            $PasswordCheck = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/';                        if($INPUT->CheckSign($Foremane, $ForemaneCheck) == FALSE) {                $MESSAGE->ViewMessage('E40');            }            else {                if($INPUT->CheckSign($Name, $NameCheck) == FALSE) {                    $MESSAGE->ViewMessage('E41');                }                else {                    if($INPUT->CheckSign($Email, $EmailCheck) == FALSE) {                        $MESSAGE->ViewMessage('E42');                    }                    else {                        if($Password != $PasswordRepeat) {                            $MESSAGE->ViewMessage('E43');                        }                        else if($INPUT->CheckSign($Password, $PasswordCheck) == FALSE) {                            $MESSAGE->ViewMessage('E44');                        }                        else {                            if($Function<1 && $Function>6 ){                                $MESSAGE->ViewMessage('E45');                            }                            else {                                $MESSAGE->ViewMessage($DATABASE->Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME, DATABASE_CHARSET));                                    $Query = "SELECT EMAIL FROM CKPiDZ_Users WHERE EMAIL = '".$DATABASE->RealEscapeString($Email)."'";                                $MESSAGE->ViewMessage($Result = $DATABASE->QueryGetValue($Query));                                                                if($Result->num_rows != 0) {                                    $MESSAGE->ViewMessage('E46');                                }                                else {                                    $EMAIL->GenerateActivationCode();                                    $Title = 'CKPiDZ Ruda Śląska - aktywacja konta';                                    $Headers = "MIME-Version: 1.0\r\n";                                    $Headers .= "Content-Type: text/html; charset=utf-8\r\n";                                    $EmailMessage =  "Otrzymałeś(aś) tę wiadomość, ponieważ dokonano rejestracji na stronie CKPiDZ Ruda Śląska z wykorzystaniem Twojego adresu e-mail. Przygotowaliśmy dla Ciebie indywidualne konto, ale jest ono jeszcze nieaktywne. Aby móc z niego korzystać kliknij w odnośnik:".                                                "<p><a href='".EMAIL_CONFIRMATION_LINK1.$Email.EMAIL_CONFIRMATION_LINK2.$EMAIL->GetActivationCode()."'>http://ckprsl.pl/CKPiDZ_NEW/index.php?Page=AccountActivation</a></p>";                                    $EmailMessage = EMAIL_BEGINING.$EmailMessage.EMAIL_END;                                    $MESSAGE->ViewMessage($EMAIL->Send($Email, $Title, $EmailMessage, $Headers));                                    $EmailMessage = '<p>Otrzymałeś tę wiadomość, ponieważ dokonano rejestracji na stronie CKPiDZ Ruda Śląska. Aby użytkownik mógł zacząć korzystać z serwisu wymagana jest akceptacja konta w panelu administracjnym.</p>';                                    $EmailMessage = EMAIL_BEGINING.$EmailMessage.EMAIL_END;                                    $EMAIL->Send(EMAIL_ADDRESS, $Title, $EmailMessage, $Headers);                                    $Query = "INSERT INTO CKPiDZ_Users (FORENAME, NAME, EMAIL, PASSWORD, FUNCTION, ACTIVATION_CODE) VALUES ('"                                            .$DATABASE->RealEscapeString($Foremane)."', '"                                            .$DATABASE->RealEscapeString($Name)."', '"                                            .$DATABASE->RealEscapeString($Email)."', '"                                            .$DATABASE->RealEscapeString($USER->GenerateHashPassword($Password, $EMAIL->GetActivationCode()))."', '"                                            .$DATABASE->RealEscapeString($Function)."', '"                                            .$DATABASE->RealEscapeString($EMAIL->GetActivationCode())."')";                                    $MESSAGE->ViewMessage($DATABASE->QuerySetValue($Query));                                                                        $_POST = array();                                }                                $Result->free;                                $MESSAGE->ViewMessage($DATABASE->Close());                            }                        }                    }                }            }        }    ?></form>
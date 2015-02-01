<form name="Login" method="post" action="index.php?Page=UserLogin">
    <input type="text" name="Email" value="Adres Email" onfocus="" onblur="">
    <input type="password" name="Password" value="Password" onfocus="" onblur="">
    <a onclick="document.Login.submit()">Zaloguj</a>
</form>

<?php
    if(!empty($_POST)) {
        $MESSAGE = new MESSAGE('settings/MessageCode.php');
        $INPUT = new INPUT();

        $Email = $_POST['Email'];
        $Password = $_POST['Password'];

        $EmailCheck = '/^([a-zA-Z0-9\._-]+)@([a-zA-Z0-9\._-]+)\.([a-zA-Z]+)$/';
        $PasswordCheck = '/^[a-zA-Z0-9]{8,16}$/';

        if($INPUT->CheckSign($Email, $EmailCheck) == FALSE) {
            $MESSAGE->ViewMessage('E42');
        }
        else if($INPUT->CheckLenght($Password, 8, 16) == FALSE) {
            $MESSAGE->ViewMessage('E44');
        }
        else {
            $DATABASE = new DATABASE();
            $MESSAGE->ViewMessage($DATABASE->Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME, DATABASE_CHARSET));

            $Query = "SELECT ACTIVE_ACCOUNT_USER, ACTIVE_ACCOUNT_ADMIN, PASSWORD, ACTIVATION_CODE FROM CKPiDZ_Users WHERE EMAIL = '".$DATABASE->RealEscapeString($Email)."'";
            $MESSAGE->ViewMessage($Result = $DATABASE->QueryGetValue($Query));
            
            if($Result->num_rows != 1){
                $MESSAGE->ViewMessage('E60');
            }
            else {
                $Object = $Result->fetch_object();
                
                if($Object->ACTIVE_ACCOUNT_USER != 1){
                    $MESSAGE->ViewMessage('E61');
                }
                else if($Object->ACTIVE_ACCOUNT_ADMIN != 1) {
                    $MESSAGE->ViewMessage('E62');
                }
                else {
                    $USER = new USER();
                    
                    if($Object->PASSWORD != $USER->GenerateHashPassword($Password, $Object->ACTIVATION_CODE)){
                        $MESSAGE->ViewMessage('E63');
                    }
                    else {
                        $MESSAGE->ViewMessage($USER->Login($Email));
                    }
                }
            }
            $MESSAGE->ViewMessage($DATABASE->Close());
        }
    }
?>
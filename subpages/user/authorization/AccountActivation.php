<?php    $DATABASE = new DATABASE();    $MESSAGE = new MESSAGE('settings/MessageCode.php');    $INPUT = new INPUT();      $Email = $_GET['UserEmail'];    $ActivationCode = $_GET['ActivationCode'];        $EmailCheck = '/^([a-zA-Z0-9\._-]+)@([a-zA-Z0-9\._-]+)\.([a-zA-Z]+)$/';        if($INPUT->CheckSign($Email, $EmailCheck) == FALSE) {        $MESSAGE->ViewMessage('E42');    }    else if($INPUT->CheckLenght($ActivationCode, 32, 32) == FALSE) {        $MESSAGE->ViewMessage('E50');    }    else {        $MESSAGE->ViewMessage($DATABASE->Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME, DATABASE_CHARSET));            $Query = "SELECT ID, ACTIVE_ACCOUNT_ADMIN, ACTIVE_ACCOUNT_USER FROM CKPiDZ_Users WHERE ACTIVATION_CODE = '".$DATABASE->RealEscapeString($ActivationCode)."' AND EMAIL = '".$DATABASE->RealEscapeString($Email)."'";        $MESSAGE->ViewMessage($Result = $DATABASE->QueryGetValue($Query));        if($Result->num_rows != 1){            $MESSAGE->ViewMessage('E50');        }        else {            $Object = $Result->fetch_object();            $Query = "UPDATE CKPiDZ_Users SET ACTIVE_ACCOUNT_USER = '1' WHERE ID = '".$Object->ID."'";            $MESSAGE->ViewMessage($DATABASE->QuerySetValue($Query));            if($Object->ACTIVE_ACCOUNT_ADMIN == 0){                $MESSAGE->ViewMessage('S50');            }            else if($Object->ACTIVE_ACCOUNT_USER == 1) {                $MESSAGE->ViewMessage('E51');            }            else {                $MESSAGE->ViewMessage('S51');            }        }        $MESSAGE->ViewMessage($DATABASE->Close());    }?>
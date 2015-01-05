<?php
    session_start();
    session_regenerate_id();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>CKPiDZ Ruda Śląska</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/Style.css"/>
    </head>
    <body>
        <?php
            $Filename = 'class/File.php';
            if(file_exists($Filename)) {
                require_once $Filename;
            }
            else {
                echo '<p class="error">Komunikat błędu: Nie odnaleziono pliku '.$Filename.'</p>';
            }
            
            $Filename = 'class/ShowMessage.php';
            if(file_exists($Filename)) {
                require_once $Filename;
            }
            else { 
                echo '<p class="error">Komunikat błędu: Nie odnaleziono pliku '.$Filename.'</p>';
            }

            $FILE = new FILE();
            $SHOWMESSAGE = new SHOWMESSAGE();
            
            $SHOWMESSAGE->ViewErrorMessage($FILE->FileExists('settings/Settings.php'));
            $SHOWMESSAGE->ViewErrorMessage($FILE->FileExists('subpages/Menu.php'));
            $SHOWMESSAGE->ViewErrorMessage($FILE->FileExists('class/Database.php'));
            $SHOWMESSAGE->ViewErrorMessage($FILE->FileExists('class/CheckInput.php'));
            $SHOWMESSAGE->ViewErrorMessage($FILE->FileExists('class/SendEmail.php'));
            
            $DATABASE = new DATABASE(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
            $SHOWMESSAGE->ViewErrorMessage($DATABASE->ErrorConnect());
            
            //KOD
            $PAGE = $_GET['Page'];
            if(!empty($PAGE)) {
                $SHOWMESSAGE->ViewErrorMessage($FILE->FileExists($PAGE));
            }
            
            $DATABASE->close();
        ?>
    </body>
</html>
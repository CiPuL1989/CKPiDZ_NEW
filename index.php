<?php
    session_start();
    session_regenerate_id();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>CKPiDZ Ruda Śląska</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <?php
            $filename = 'class/file.php';
            if(file_exists($filename)) {
                require_once $filename;
            }
            else {
                echo '<p class="error">Nie odnaleziono pliku '.$filename.'</p>';
            }
            
            $filename = 'class/error.php';
            if(file_exists($filename)) {
                require_once $filename;
            }
            else { 
                echo '<p class="error">Nie odnaleziono pliku '.$filename.'</p>';
            }

            $FILE = new FILE();
            $ERROR = new ERROR();
            
            $ERROR->ViewError($FILE->FileExists('settings/database.php'));
            $ERROR->ViewError($FILE->FileExists('class/database.php'));
            
            $DATABASE = new DATABASE(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
            $ERROR->ViewError($DATABASE->ErrorConnect());

            
            
            $DATABASE->close();
        ?>
    </body>
</html>
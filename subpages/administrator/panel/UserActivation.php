<form name="UserActivation" method="post" action="index.php?Page=UserActivation">
    <table>
        
    <?php
        $USER = new USER();
        $MESSAGE = new MESSAGE('settings/MessageCode.php');
        $DATABASE = new DATABASE();

        if($USER->CheckLogin() == FALSE) {
            $MESSAGE->ViewMessage('E80');
        }
        else {
            $MESSAGE->ViewMessage($DATABASE->Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME, DATABASE_CHARSET));

            $Query = "SELECT ID, FORENAME, NAME, EMAIL, FUNCTION FROM CKPiDZ_Users WHERE ACTIVE_ACCOUNT_ADMIN = '0'";
            $MESSAGE->ViewMessage($Result = $DATABASE->QueryGetValue($Query));

            if($Result->num_rows < 1) {
                $MESSAGE->ViewMessage('E81');
            }
            else {
                $Function = array (
                    '1' => 'Administrator',
                    '2' => 'Dyrektor',
                    '3' => 'Wicedyrektor',
                    '4' => 'Kierownik warsztatu',
                    '5' => 'Nauczyciel',
                    '6' => 'Referent'
                );

                for($$i = 0; $i<$Result->num_rows; $i++) {
                    $Object = $Result->fetch_object();
                    
                    echo    '<tr>'.
                                '<td>'.$Object->FORENAME.'</td>'.
                                '<td>'.$Object->NAME.'</td>'.
                                '<td>'.$Object->EMAIL.'</td>'.
                                '<td>'.$Function[$Object->FUNCTION].'</td>'.
                                '<td><a onclick="document.UserActivation.submit()">Aktywuj</a></td>'.
                            '</tr>';
                }
            }
            $MESSAGE->ViewMessage($DATABASE->Close());
        }
    ?>

    </table>
</form>
<?php

$aType = $POST['auth']; //Register or Login or Logout

switch ($aType) {
    case 'register':
        //register success / failure
        break;
    case 'login':
        //do login, maybe 2fa here
        break;
    case 'logout':
        //clear session
        break;
}
?>
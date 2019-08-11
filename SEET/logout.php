<?php
// *** Logout the current user.
$logoutGoTo = "logins.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['staffcomfirmed']);
unset($_SESSION['MM_Username']);
unset($_SESSION['programme']);
unset($_SESSION['number']);
unset($_SESSION['id_staff']);
unset($_SESSION['programme']);
unset($_SESSION['session']);
unset($_SESSION['matricno']);
unset($_SESSION['id_staff']);
unset($_SESSION['names']);

//remove PHPSESSID from browser
if ( isset( $_COOKIE[session_name()] ) )
setcookie("PHPSESSID","",time()-3600,"/");
//clear session from globals
$_SESSION = array();
//clear session from disk
session_destroy();


if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
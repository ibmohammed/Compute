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

if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
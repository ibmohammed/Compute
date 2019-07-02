<?php
// *** Logout the current user.
$logoutGoTo = "studentlogin.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Usernames'] = NULL;
$_SESSION['MM_UserGroups'] = NULL;
unset($_SESSION['MM_Usernames']);
unset($_SESSION['MM_UserGroups']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
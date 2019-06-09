<?php
//Logut and destroy session
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_GET['logout']))
{
  unset($_SESSION['usercomfirmed']);
  unset($_SESSION['MM_Username']);
  unset($_SESSION['programme']);
  unset($_SESSION['matricno']);
  unset($_SESSION['session']);
  unset($_SESSION['matricno']);

  header("location:../index.html");
}
else
if(isset($_GET['logout1']))
{
  //unset($_SESSION['staffcomfirmed']);
  //session_destroy();
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
  header("location:../index.html");
}
?>

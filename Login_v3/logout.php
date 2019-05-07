<?php
//Logut and destroy session
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_GET['logout']))
{
  unset($_SESSION['usercomfirmed']);
  header("location:../index.html");
}
else
if(isset($_GET['logout1']))
{
  unset($_SESSION['staffcomfirmed']);
  //session_destroy();
  header("location:../index.html");
}
?>

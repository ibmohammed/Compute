<?php

if (!isset($_SESSION))
{
  session_start();
}

$_SESSION['username'] = $uname;
$_SESSION['password'] = $pwrd;
$_SESSION['deptcode'] = $prog;
$_SESSION['stid'] = $id;

$stff = login_scomfirm($number, $logs);
mysqli_stmt_execute($stff);
mysqli_stmt_bind_result($stff, $stfid, $name, $number, $contact, $dept_id);
mysqli_stmt_store_result($stff);
mysqli_stmt_fetch($stff);
		
if (password_verify($password, $pwrd)) 
{
	$_SESSION['users_types'] = 1;
	$_SESSION['page_name'] = "NSPZ RMS-Teahing_Staff";
	$_SESSION['themenu'] = "newmenus_staff.php";
	//$page_dir = "s_profile.php";
	$page_dir = "index.php";
	include("dchronicle.php");	
}
else 
{
	echo '<script type="text/javascript">
	alert("incorrect login details");
	location.replace("logins.php");
	</script>';
}


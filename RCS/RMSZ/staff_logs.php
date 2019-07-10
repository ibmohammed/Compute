<?php

$_SESSION['staffcomfirmed'] = $uname;
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
	$page_dir = "s_profile.php";
	include("dchronicle.php");	
}
else 
{
	echo '<script type="text/javascript">
	alert("incorrect login detailsjjj");
	location.replace("logins.php");
	</script>';
}


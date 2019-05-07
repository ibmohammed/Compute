<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "studentlogin.php";
if (!((isset($_SESSION['names'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html PUBLIC-//W3C//DTD XHTML 1.0 Transitional//EN"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="icon" href="RMSZ/images/nipoly2 (1).GIF" type="image/x-jpg">


 <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   

<title>Manage Students Manage Couses Ma</title>
<style type="text/css">
.auto-style1 {
	margin-right: 13px;
}
.auto-style2 {
	margin-right: 97px;
}
</style>




</head>

<body>
<div align="center" style="width:80%;" >
<?php 
if (!isset($_SESSION)) {
  session_start();
}

$departmentcode = $_SESSION['deptcode'];?>
<div align="justify" style="width:1000px;">

	<div>
		<div>
			<img alt="rmshead" height="100" src="RMSZ/newhd.png" width="950" /></div>
	<!--	<div style="width:1000px; height:20px;border-radius:5px;border:solid; border-color:navy;">-->
	<hr style="width:1330px;"/>
			Welcome: <?php echo $_SESSION['names'];
			$prgs = $_SESSION['deptcode']; 
			?> 
	<hr style="width:1330px;"/>
		
		<div style="border-style: none; border-width: medium; float:left; width:357px; font-size:13px; ">
<?php 	include('studentmenu.php');?>
		</div>
		<div style="float:left; width:636px;">
		<?php
// call other pages to index menu		
 include('RMSZ/menus.php');
	//include('grpedit.php');
	
 
 ?>
		</div>
	</div>
</div>
</div>
</body>

</html>

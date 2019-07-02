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

$MM_restrictGoTo = "logins.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
<?php include("includes/header.php"); ?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	color: #0033FF;
}
a:hover {
	color: #0066FF;
}
.style1 {font-size: 20px}
-->
</style>

</head>

<body>
<fieldset >
<table width="80%" align="center" >
  <tr>
    <td><img src="header1.png" width="100%" height="80" /></td>
  </tr>
</table>
  <table width="80%" align="center" >
  <tr>
    <td bgcolor="#4F81BD"><marquee behavior="alternate">
      <strong style="color:#FF0000;">Nipoly Consult........</strong>
      </marquee>    </td>
  </tr></table>
  <table width="80%" align="center" >

  <tr bgcolor="#33CCFF">
    <td width="15%" valign="top" bgcolor="#FFFFFF"><table  border="0">
      <tr>
        <td><a href="student.php"><img src="images/index/students.png" width="270" height="40" border="0" /></a></td>
      </tr>
      <tr>
        <td><a href="courses.php"><img src="images/index/courses.png" width="270" height="40" border="0" /></a></td>
      </tr>
      <tr>
        <td><a href="manageuser.php"><img src="images/index/users.png" width="270" height="40" border="0" /></a></td>
      </tr>
      <tr>
        <td><a href="manuallist.php"><img src="images/index/manual.png" width="270" height="40" border="0" /></a></td>
      </tr>
      <tr>
        <td><a href="6sem.php"><img src="images/index/6sp.png" width="270" height="40" border="0" /></a></td>
      </tr>
      <tr>
        <td><a href="3sem.php"><img src="images/index/3sp.png" width="270" height="40" border="0" /></a></td>
      </tr>
      <tr>
        <td><a href="backups2.php"><img src="images/index/backup.png" width="270" height="40" /></a></td>
      </tr>
      
    </table></td>
    <td width="50%" valign="top" bgcolor="#FFFFFF"><div align="center">
<a href="logout.php">Log out</a><br  /> 
    <a href="grad.php?id=3">3 Semester Programmes Graduation List</a> <br >
    <a href="grad.php?id=6">6 Semester </a><a href="grad.php?id=3">Programmes </a><a href="grad.php?id=6">
		Graduation List</a>
    <br/><a href="login.php?menu=<?php echo "adminedits";?>">HOD's Only</a></div>
      <p align="center">&nbsp;</p>
      <p align="center"><span class="style1" style="background:#173763; border-radius:round; border: 2px solid; border-radius: 10px; color:#FFF; font-weight:bold; text-decoration:none; color:#FFFFFF;"><a href="newcourse.php">
	  New Programme</a></span></p>
    <p align="center"><span class="style1" style="background:#173763; border-radius:round; border: 2px solid; border-radius: 10px; color:#FFF; font-weight:bold;  text-decoration:none; color:#FFFFFF;"><a href="scoresheet.php">
	Mark and Attendance 1</a></span></p>
     <p align="center"><span class="style1" style="background:#173763; border-radius:round; border: 2px solid; border-radius: 10px; color:#FFF; font-weight:bold;  text-decoration:none; color:#FFFFFF;"><a href="scoresheet2.php">
	 Mark and Attendance 2</a></span></p>
    <p align="center"><span class="style1" style="background:#173763; border-radius:round; border: 2px solid; border-radius: 10px; color:#FFF; font-weight:bold;  text-decoration:none; color:#FFFFFF;"><a href="analysis.php">
	Result Analysis</a></span></p></td>
  </tr>
</table>
</fieldset>

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
-->
</style>
</head>

<body>
<table width="70%" align="center" >
  <tr>
    <td colspan="2"><img src="header1.png" width="100%" height="110" /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#4F81BD"><marquee behavior="alternate"><strong style="color:#FF0000;">Nipoly Consult........</strong></marquee> </td>
  </tr>
 <tr>
    <td width="4%" valign="top"S><table width="12%" >
      <tr>
        <td><a href="index.php"><strong>Home</strong></a></td>
      </tr>
      <?php
 if (isset($_POST['student'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username LIKE '$name' AND password LIKE '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'];
$pd=$row['password'] ;
 if ((!$_POST['pasword'])|| (!$_POST['username'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:student.php");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}   
}elseif (isset($_POST['courses'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username LIKE '$name' AND password LIKE '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'] ;
$pd=$row['password'] ;
 if ((!$_POST['pasword'])|| (!$_POST['username'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:courses.php");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}   
}elseif (isset($_POST['manageuser'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username = '$name' AND password = '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'] ;
$pd=$row['password'] ;
 if ((!$_POST['pasword'])|| (!$_POST['school'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:manageuser.php");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}   
}elseif (isset($_POST['6sem'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username = '$name' AND password = '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'];
$pd=$row['password'];
 if ((!$_POST['pasword'])|| (!$_POST['school'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:6sem.php");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}   
}elseif (isset($_POST['3sem'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username = '$name' AND password = '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'] ;
$pd=$row['password'] ;
 if ((!$_POST['pasword'])|| (!$_POST['username'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:3sem.php?id=3");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}
}elseif (isset($_POST['backup'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username = '$name' AND password = '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'] ;
$pd=$row['password'] ;
 if ((!$_POST['pasword'])|| (!$_POST['username'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:backups2.php");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}
}elseif (isset($_POST['adminedits'])){
$pwd= $_POST['pasword'];
$name= $_POST['username'];
if ($name!=="HOD"){
echo "<script language='javascript'>";
echo "alert('This can only be accesed by HOD')";
echo "</script>";
}elseif($name=="HOD"){

?>
      <?php
 $log = mysql_query("SELECT *  FROM logintbl WHERE username = '$name' AND password = '$pwd'",$db);
if ($log){
$row=mysql_fetch_array($log);

$user =$row['username'] ;
$pd=$row['password'] ;
 if ((!$_POST['pasword'])|| (!$_POST['username'])){
 echo "<font color= 'red'>";  echo("password and username field cannot be empty");  echo "</font>";
 }
if (($user == $name) AND ($pd == $pwd )){
    header("location:adminedit.php");
}
echo "<font color= 'red'>"; echo ("Incorret password or Username"); echo "</font>";
}
}
}
  ?>
    </table></td>
    <td width="63%"><?php if (isset($_GET['menu'])){
	  $name=$_GET['menu'];?>
	  <form action="" method="post" name="pword" id="pword">
    
	  <table align="center">
        <tr>
          <td align="center"><center>
            <strong>Login            </strong>
          </center>
              <table width="100%"
border="0" cellpadding="2" cellspacing="2" bgcolor="#000000"
style="text-align: left; width: 262px; height: 66px; margin-left: auto; margin-right: auto;">
                <tbody>
                  <tr bgcolor="#F0F0F0">
                    <td style="vertical-align: top;"><span style="color: #4F81BD; font-weight: bold">Username:</span></td>
                    <td style="vertical-align: top;"><select name="username" >
                      <option>Select User</option>
                      <option>Coordinator</option>
                      <option>HOD</option>
                      <option>Other User</option>
                      <option>Admin User</option>
                    </select></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="26" bgcolor="#F0F0F0" style="vertical-align: top;"><span style="color:#4F81BD; font-weight: bold">Password:</span></td>
                    <td bgcolor="#F0F0F0" style="vertical-align: top; text-align: left;"><input
name="pasword" type="password" /></td>
                  </tr>
                </tbody>
              </table>
              <input type="submit" name="<?php echo $name;?>" value="Login" />
            <input name="Reset"
value="Reset" type="reset" />            </td>
        </tr>
      </table>
    </form><?php }?>
	</td>
  </tr>
</table>
 
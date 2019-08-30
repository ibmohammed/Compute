<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_logs = "localhost";
$database_logs = "nigerpol_consultdbsnw";
$username_logs = "nigerpol_root";
$password_logs = "number012345@";


$logs = mysqli_connect($hostname_logs, $username_logs, $password_logs, $database_logs);
// Check connection
if (!$logs) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
<?php // require_once('Connections/logs.php'); ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Results Management System</title>
<link href="stylesheets/bootstrap.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.auto-style1 {
	text-decoration: underline;
}
.auto-style2 {
	color: #0000FF;
}
</style>
</head>

<body>
<br />

<table align="center">
  <tr>
    <td align="center" style="width: 681px; height: 43px"><a href="index.php">
      <input type="submit" name="button2" id="button2" value="Back" onchange="window.close();" />
    </a></td>
  </tr>
  <tr>
    <td style="width: 681px"><font color="#FF0000" class="center"><span class="auto-style1"><strong>
	Note: </strong></span>Follow the steps below to transfer data from another 
	computer to your computer<br />
	<br />
	</font><span class="auto-style2"><font class="center">1. Backup your data 
	from the sourse Computer<br />
	2. Goto drive C (Local Disk (C:)) on the Source Computer<br />
	3. Open the folder named &quot;backups&quot;<br />
	4. Copy all the content that have the current date<br />
	5. Paste the coppied content into the folder named &quot;backups&quot; in the same 
	location (Local Disk (C:)) on your computer<br />
	6. Then enter Enter Backup Date using this Format: d-m-YYY (1-2-2016) in the 
	field provided below</font></span></td>
  </tr>
</table>

<?php

if (isset($_POST['button'])){
$dt = $_POST['date'];
if (!$dt){
	header('transferdata.php');
  }
 error_reporting(-1);
 ini_set('display_errors', true);
 require_once('Connections/logs.php'); 

$table_name = "coresult";
$table_name1 = "course";
$table_name2 = "logintbl";
$table_name3 = "results";
$table_name4 = "studentsnm";
$table_name5 = "dept";
$table_name6 = "entered";


$backup_file  = "/public_html/RMSZ/backups/".$dt."coresult.sql";
$backup_file2  = "/public_html/RMSZ/backups/".$dt."course.sql";
$backup_file3  = "/public_html/RMSZ/backups/".$dt."logintbl.sql";
$backup_file4  = "/public_html/RMSZ/backups/".$dt."results.sql";
$backup_file5  = "/public_html/RMSZ/backups/".$dt."studentsnm.sql";
$backup_file6  = "/public_html/RMSZ/backups/".$dt."dept.sql";
$backup_file7  = "/public_html/RMSZ/backups/".$dt."entered.sql";

$sn = '';

$sql="LOAD DATA  INFILE '$backup_file' INTO TABLE $table_name  SET sn = ''";
$sql1="LOAD DATA  INFILE '$backup_file2' INTO TABLE $table_name1  SET sn = ''";
$sql2="LOAD DATA  INFILE '$backup_file3' INTO TABLE $table_name2 SET id = ''";
$sql3="LOAD DATA  INFILE '$backup_file4' INTO TABLE $table_name3  SET sn = ''";
$sql4="LOAD DATA  INFILE '$backup_file5' INTO TABLE $table_name4  SET sn = ''";
$sql5="LOAD DATA  INFILE '$backup_file6' INTO TABLE $table_name5  SET id = ''";
$sql6="LOAD DATA  INFILE '$backup_file7' INTO TABLE $table_name6  SET sn = ''";

/*
LOAD DATA INFILE '' INTO TABLE $table_name SET sn = '';
*/

mysqli_select_db($logs,'nigerpol_consultdbsnw');
$retval = mysqli_query($logs,$sql) or die('Could not take data backup: ' . mysqli_error($logs));
$retval1 = mysqli_query($logs,$sql1) or die('Could not take data backup:1 ' . mysqli_error($logs));
$retval2= mysqli_query($logs,$sql2) or die('Could not take data backup:2' . mysqli_error($logs));
$retval3 = mysqli_query($logs,$sql3) or die('Could not take data backup:3 ' . mysqli_error($logs));
$retval4 = mysqli_query($logs,$sql4) or die('Could not take data backup:4 ' . mysqli_error($logs));
$retval5 = mysqli_query($logs,$sql5) or die('Could not take data backup:5 ' . mysqli_error($logs));
$retval6 = mysqli_query($logs,$sql6) or die('Could not take data backup:6 ' . mysqli_error($logs));

/*if(! $retval ||! $retval1 || ! $retval2 || ! $retval3 || ! $retval4)
{
 vgf */ 

echo "data Uploaded successfully\n";
mysqli_close($logs);
}?>

<br /><br />
<table width="347" align="center">
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action=""><table width="339">
  <tr>
    <td align="center"><strong>ENTER BACKUP DATE:</strong> <br />     <input name="date" type="text" placeholder = "Date format:<?php echo date('j-n-Y');?>" /></td>
    </tr>
</table>
    <input type="submit" name="button" id="button" value="Submit" />
    </form></td>
  </tr>
</table>
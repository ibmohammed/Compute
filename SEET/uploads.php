<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Results Management System</title>
<link href="stylesheets/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<a href="index.php"></a>
<table align="center">
  <tr>
    <td align="center"><a href="index.php">
      <input type="submit" name="button2" id="button2" value="Back" />
    </a></td>
  </tr>
  <tr>
    <td><font color="#FF0000" class="center">To upload Backup, Enter Backup Date using this Format: ddd-mmm-YYY</font></td>
  </tr>
</table>
<?php

if (isset($_POST['button'])){
$dt = $_POST['date'];
if (!$dt){
	header('location:backups.php');
	}
  error_reporting(-1);
  ini_set('display_errors', true);
  
  //require("includes/header.php");

$table_name = "coresult";
$table_name1 = "course";
$table_name2 = "logintbl";
$table_name3 = "results";
$table_name4 = "studentsnm";
$table_name5 = "dept";
$table_name6 = "entered";

$backup_file  = "/backups/".$dt."coresult.sql";
$backup_file2  = "/backups/".$dt."course.sql";
$backup_file3  = "/backups/".$dt."logintbl.sql";
$backup_file4  = "/backups/".$dt."results.sql";
$backup_file5  = "/backups/".$dt."studentsnm.sql";
$backup_file6  = "/backups/".$dt."dept.sql";
$backup_file7  = "/backups/".$dt."entered.sql";

$sql="LOAD DATA INFILE '$backup_file' INTO TABLE $table_name";
$sql1="LOAD DATA INFILE '$backup_file2' INTO TABLE $table_name1";
$sql2="LOAD DATA INFILE '$backup_file3' INTO TABLE $table_name2";
$sql3="LOAD DATA INFILE '$backup_file4' INTO TABLE $table_name3";
$sql4="LOAD DATA INFILE '$backup_file5' INTO TABLE $table_name4";
$sql5="LOAD DATA INFILE '$backup_file6' INTO TABLE $table_name5";
$sql6="LOAD DATA INFILE '$backup_file7' INTO TABLE $table_name6";

mysql_select_db('consultdbsnw');
$retval = mysqli_query($logs, $sql);
$retval1 = mysqli_query($logs, $sql1);
$retval2= mysqli_query($logs, $sql2);
$retval3 = mysqli_query($logs, $sql3);
$retval4 = mysqli_query($logs, $sql4);
$retval4 = mysqli_query($logs, $sql5);
$retval4 = mysqli_query($logs, $sql6);
if(! $retval ||! $retval1 || ! $retval3 || ! $retval4)
{
  die('Could not take data backup: ' . mysql_error());
}
echo "data Uploaded successfully\n";
mysql_close($logs);
}?>

<br /><br />
<table width="347" align="center">
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action=""><table width="339">
  <tr>
    <td align="center"><strong>BACKUP DATE:</strong> <br />     <input name="date" type="text" placeholder = "Date format:<?php echo date('j-n-Y');?>" /></td>
    </tr>
</table>
    <input type="submit" name="button" id="button" value="Submit" />
    </form></td>
  </tr>
</table>
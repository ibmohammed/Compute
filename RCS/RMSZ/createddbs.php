<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Results Management System</title>
<link href="stylesheets/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<?php 

if (isset($_GET['upload'])){
	echo "Have you backed up your data?<br/>";
	echo "<a href='createddbs.php?yes'>"."YES"."</a>".  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"  ."<a href='createddbs.php?no'>"."NO"."</a>";
	
	}elseif(isset($_GET['yes'])){
?>


<?php include("includes/header.php"); 
		// create db 

$createdb = mysql_query("CREATE DATABASE `$dbname` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
    }else if ($db_select){
		// drop database
		$drop = mysql_query("DROP DATABASE $dbname"); 
		$createdb = mysql_query("CREATE DATABASE `$dbname` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
 
		}
 
 
// create table coresult
$coresult= mysql_query("CREATE  TABLE  `$dbname`.`coresult` (  `sn` int( 11  )  NOT  NULL  AUTO_INCREMENT ,
 `name` varchar( 60  )  NOT  NULL ,
 `matric_no` char( 255  )  NOT  NULL ,
 `code` varchar( 10  )  NOT  NULL ,
 `unit` int( 11  )  NOT  NULL ,
 `score` varchar( 5  )  NOT  NULL ,
 `grade` varchar( 5  )  NOT  NULL ,
 `points` varchar( 10  )  NOT  NULL ,
 `programme` varchar( 255  )  NOT  NULL ,
 `semester` varchar( 255  )  NOT  NULL ,
 `session` varchar( 255  )  NOT  NULL ,
 `stat` varchar( 10  )  NOT  NULL ,
 `year` int( 5  )  NOT  NULL ,
 PRIMARY  KEY (  `sn`  ) ,
 KEY  `matric no` (  `matric_no`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1 AUTO_INCREMENT  =31");
 
 // create table course
$course = mysql_query("CREATE  TABLE  `$dbname`.`course` (  `sn` int( 11  )  NOT  NULL  AUTO_INCREMENT ,
 `Programme` varchar( 255  )  NOT  NULL ,
 `unit` int( 2  )  NOT  NULL ,
 `semester` int( 2  )  NOT  NULL ,
 `code` varchar( 255  )  NOT  NULL ,
 `title` varchar( 255  )  NOT  NULL ,
  `sessions` varchar( 40  )  NOT  NULL ,
 PRIMARY  KEY (  `sn`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1 AUTO_INCREMENT  =98");
 
 // create table login 
 
 $login = mysql_query("CREATE  TABLE  `$dbname`.`logintbl` (  `id` int( 11  )  NOT  NULL  AUTO_INCREMENT ,
 `username` varchar( 255  )  NOT  NULL ,
 `password` varchar( 255  )  NOT  NULL ,
 `progs` varchar( 255  )  NOT  NULL ,
 PRIMARY  KEY (  `id`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1 AUTO_INCREMENT  =6");
 
 // create table results
$results = mysql_query("CREATE  TABLE  `$dbname`.`results` (  `sn` int( 11  )  NOT  NULL  AUTO_INCREMENT ,
 `name` varchar( 60  )  NOT  NULL ,
 `matric_no` char( 255  )  NOT  NULL ,
 `code` varchar( 10  )  NOT  NULL ,
 `unit` int( 11  )  NOT  NULL ,
 `score` varchar( 5  )  NOT  NULL ,
 `grade` varchar( 5  )  NOT  NULL ,
 `points` varchar( 10  )  NOT  NULL ,
 `programme` varchar( 255  )  NOT  NULL ,
 `semester` varchar( 255  )  NOT  NULL ,
 `session` varchar( 255  )  NOT  NULL ,
 `stat` int( 1  )  NOT  NULL ,
 PRIMARY  KEY (  `sn`  ) ,
 KEY  `matric no` (  `matric_no`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1 AUTO_INCREMENT  =1330");
 
 // create table students
$students = mysql_query("CREATE  TABLE  `$dbname`.`studentsnm` (  `sn` int( 11  )  NOT  NULL  AUTO_INCREMENT ,
 `names` varchar( 255  )  NOT  NULL ,
 `matno` varchar( 255  )  NOT  NULL ,
 `dept` varchar( 255  )  NOT  NULL ,
 `year` int( 11  )  NOT  NULL ,
 `images` varchar( 255  )  NOT  NULL ,
 `session` varchar( 255  )  NOT  NULL ,
 `status` int( 1  )  NOT  NULL ,
 `stat` int( 1  )  NOT  NULL ,
 `Withdrwan` varchar( 1  )  NOT  NULL ,
 `sex` varchar( 2  )  NOT  NULL ,
 UNIQUE  KEY  `sn` (  `sn`  ) ,
 UNIQUE  KEY  `matno` (  `matno`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1 AUTO_INCREMENT  =64");
 
 // creat dept
 $depts = mysql_query("CREATE TABLE `$dbname`.`dept` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`dep` VARCHAR( 255 ) NOT NULL ,
`prev` INT NOT NULL ,
`prog` VARCHAR( 20 ) NOT NULL ,
UNIQUE (
`dep`
)
) ENGINE = InnoDB
"); 
 
 // prompt 
 

 echo "<br><br><br><br><br><br><br><br> <table align='center' border='1' bordercolor = 'sky blue'><tr><td  align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Database Creation Succesful<br > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click Ok To complete Upload&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>";

 echo "</td></tr><tr><td align='right' bgcolor='#D6D6D6'><br><a href = 'backups.php'><button> &nbsp;&nbsp; Ok  &nbsp;&nbsp;</button></a> &nbsp;&nbsp;&nbsp;&nbsp;<br><br></td></tr></table>";

}elseif(isset($_GET['no'])){
	header('location:index.php');
	
	}?>
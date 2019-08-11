<?php include("includes/header.php");?>
<?php
$mt= $_GET['matricno'];
$smstr= $_GET['semester'];
$ss= $_GET['session'];
if (!$mt || !$smstr || !$ss){
    echo "You have not entered all the requried details"."<br />"
        ."pls go back and try again";
    exit;
}
//DELETE FROM `consultdbsnw`.`logintbl` WHERE `logintbl`.`id` = 5
 $del= mysql_query("DELETE FROM consultdbsnw.entrytbl WHERE entrytbl.matric_no like '$mt'");
if (!$del){
    die (mysql_error());
    }
die ("Record Deleted");
?>

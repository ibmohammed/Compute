<?php 
//if ($semester ==1){
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester <='$semester'&& matric_no='$matno' && grade='AE'");
if(!$sql){
die(mysql_error());
}?>
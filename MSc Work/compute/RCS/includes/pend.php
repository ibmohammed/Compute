<?php
 
//if ($semester ==1){
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && matric_no='$matno' && grade='PEND' && semester <='$semester'");
if(!$sql){
die(mysql_error());
}?>
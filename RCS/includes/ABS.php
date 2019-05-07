<?php
$semester ==1;
$sqlm= mysql_query("SELECT * FROM results WHERE programme='$programme' && matric_no='$matno' && semester <='$semester' && grade='ABS'");

if(!$sql){
die(mysql_error());
}

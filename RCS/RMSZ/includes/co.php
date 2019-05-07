<?php
$semester ==1;
$sql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$programme' && matric_no='$matno' && semester <='$semester' && grade='F'");

if(!$sql){
die(mysql_error());
}
?>
<?php
$semester ==1;
$sql= mysqli_query($conn,"SELECT * FROM results WHERE prog_id='$programme' && matric_no='$matno' && semester <='$semester' && grade='F'");

if(!$sql){
die(mysqli_error());
}
?>
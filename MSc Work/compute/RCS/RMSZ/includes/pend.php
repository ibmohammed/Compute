<?php
 
//if ($semester ==1){
$sql= mysqli_query($conn,"SELECT * FROM results 
WHERE programme='$programme' && matric_no='$matno' && grade='PEND' && semester <='$semester'") or die(mysql_error());
?>
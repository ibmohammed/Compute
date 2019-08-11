<?php
 
//if ($semester ==1){
$sql= mysqli_query($conn,"SELECT * FROM results 
WHERE prog_id='$programme' && matric_no='$matno' && grade='PEND' && semester <='$semester'") or die(mysqli_error());
?>
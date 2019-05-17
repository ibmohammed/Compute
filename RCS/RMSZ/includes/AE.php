<?php 
//if ($semester ==1){
$sql= mysqli_query($conn,"SELECT * FROM results 
WHERE prog_id='$programme' && semester <='$semester'&& matric_no='$matno' && grade='AE'")or die(mysqli_error());
?>
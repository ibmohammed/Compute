<?php 
//if ($semester ==1){
$sql= mysqli_query($conn,"SELECT * FROM results 
WHERE programme='$programme' && semester <='$semester'&& matric_no='$matno' && grade='AE'")or die(mysql_error());
?>
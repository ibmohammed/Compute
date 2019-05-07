<?php 

$query= mysqli_query($conn,"SELECT * FROM results 
WHERE programme='$programme' && matric_no='$matno' && grade='SICK'") or die(mysql_error());
?>
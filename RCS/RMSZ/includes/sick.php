<?php 

$query= mysqli_query($conn,"SELECT * FROM results 
WHERE prog_id='$programme' && matric_no='$matno' && grade='SICK'") or die(mysqli_error());
?>
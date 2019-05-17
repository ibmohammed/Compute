<?php
//$semester ==1;
$sqlm= mysqli_query($conn,"SELECT * FROM results 
WHERE prog_id='$programme' && matric_no='$matno' && semester <='$semester' && grade='ABS'") or die(mysqli_error());
?>
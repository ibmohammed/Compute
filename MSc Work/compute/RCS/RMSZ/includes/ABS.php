<?php
//$semester ==1;
$sqlm= mysqli_query($conn,"SELECT * FROM results 
WHERE programme='$programme' && matric_no='$matno' && semester <='$semester' && grade='ABS'") or die(mysql_error());
?>
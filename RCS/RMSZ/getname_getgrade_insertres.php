<?php
$score = $data[1];
$smatno = $data[0];
// get students names from table 
$namee = get_student_name($conn,$smatno);
$stdnames = mysqli_fetch_assoc($namee);
$snames = $stdnames["names"];
include("includes/scoregrade.php");
//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
$point = $n[$grade1];
?>
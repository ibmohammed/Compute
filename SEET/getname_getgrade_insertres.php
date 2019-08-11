<?php
$score = $data[1];
$score = preg_replace("/[^0-9]/", "", $score);

$smatno = $data[0];
$smatno = preg_replace("/[^a-zA-Z0-9\s\/]/", "", $smatno);

if ((strpos( $smatno, "/") !== false) && preg_match('/^\d{2}$/', $score))
{
// get students names from table 
$namee = get_student_name($conn,$smatno);
$stdnames = mysqli_fetch_assoc($namee);
$snames = $stdnames["names"];
include("includes/scoregrade.php");
//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
$point = $n[$grade1];

}
else 
							{
								echo '<script type="text/javascript">
								alert("Please check the records you are uploading");
								location.replace("index.php?csv");
								</script>';
							}
?>
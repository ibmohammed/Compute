<?php
$score = $data[1];
$score = preg_replace("/[^0-9]/", "", $score);

$smatno = $data[0];
$smatno = preg_replace("/[^a-zA-Z0-9\s\/]/", "", $smatno);

//if ((strpos( $smatno, "/") !== false))
//preg_match("/[PH]{2}/",   $score) 
//preg_match('/^[0-9]{3}\z/',$number);
if ((strpos( $smatno, "/") !== false) && preg_match('/^\d{2}$/', $score))
//if ((strpos( $smatno, "/") !== false) && preg_match('/[^A-Z0-9]{2}\z/',$score))
{
// get students names from table 
$namee = get_student_name($conn,$smatno);
$stdnames = mysqli_fetch_assoc($namee);
$snames = $stdnames["names"];
include("includes/scoregrade.php");
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
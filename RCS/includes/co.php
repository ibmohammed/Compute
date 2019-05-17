<?php
$semester ==1;
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && matric_no='$matno' && semester <='$semester' && grade='F'");

if(!$sql){
die(mysqli_error());
}

/*
}elseif ($semester ==2){

$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester < '3' && matric_no='$matno' && grade='F'");

}elseif ($semester ==3){
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester < '4' && matric_no='$matno' && grade='F'");

}elseif ($semester ==4){
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester < '5' && matric_no='$matno' && grade='F'");

}elseif ($semester ==5){
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester < '6' && matric_no='$matno' && grade='F'");

}elseif ($semester ==6){
$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester < '7' && matric_no='$matno' && grade='F'");
}*/
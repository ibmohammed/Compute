<?php 

$query= mysql_query("SELECT * FROM results WHERE programme='$programme' && matric_no='$matno' && grade='SICK'");
if(!$query){
die(mysql_error());
}?>
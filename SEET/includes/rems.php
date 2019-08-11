<?php $sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && session='$session' && matric_no='$matno'");
if(!$sql){
die(mysql_error());
}
?>
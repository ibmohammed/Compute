<?php 
// Post Grad programmes
$prgs = mysql_query("SELECT * FROM dept WHERE prev = '6' ORDER BY `dept`.`dep` ASC") or die(mysql_error()."Post Grad programmes");

while($rows = mysql_fetch_array($prgs)){
echo "<option>".$rows['dep']."</option>";
}
?>
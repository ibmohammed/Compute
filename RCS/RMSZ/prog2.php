<?php 
// 6 semester programmes
$prgs = mysql_query("SELECT * FROM dept WHERE prev != '6' && prev != '4' && prev != '1' ORDER BY `dept`.`dep` ASC") or die(mysql_error()."6 semester programmes");

while($rows = mysql_fetch_array($prgs)){
echo "<option>".$rows['dep']."</option>";
}
?>
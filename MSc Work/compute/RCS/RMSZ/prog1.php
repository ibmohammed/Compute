<?php 
// 3 semester programmes
$prgs = mysql_query("SELECT * FROM dept WHERE prev = '1' || prev = '4' ORDER BY `dept`.`dep` ASC") or die(mysql_error()."3 semester programmes");

while($rows = mysql_fetch_array($prgs)){

echo "<option>".$rows['dep']."</option>";

}

?>
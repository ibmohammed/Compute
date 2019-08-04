<?php 

$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];


?>
<br>
<hr>
<form action="<?php echo $the_act;?>" method="post" name="grade" id="grade11" target="_blank">
  <input type="hidden" name="programme" value="<?php echo $programme;?>">
 <input type="hidden" name="semester" value="<?php echo $semester;?>">
 <input type="hidden" name="session" value="<?php echo $session;?>">
 <input type="hidden" name="year" value="<?php echo $year;?>">
 <input name="start"  type="hidden" id="start" value="0" />
      <input name="list" type="hidden" id="list" value="20" />
 <input name="Submit" type="submit" id="Submit" value="Export Result to Word" />
  </form>

<br>
<hr>
<form action="<?php echo $the_print;?>" method="post" name="print" id="grade11" target="_blank">
  <input type="hidden" name="programme" value="<?php echo $programme;?>">
 <input type="hidden" name="semester" value="<?php echo $semester;?>">
 <input type="hidden" name="session" value="<?php echo $session;?>">
 <input type="hidden" name="year" value="<?php echo $year;?>">
 <input name="start"  type="hidden" id="start" value="0" />
      <input name="list" type="hidden" id="list" value="20" />
 <input name="Submit" type="submit" id="Submit" value="Print Result" />
  </form>

<hr>
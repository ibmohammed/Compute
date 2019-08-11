<?php include("includes/header.php"); ?>    

    <table width="80%" border="0" align="center">
  <tr>
    <td>
	<?php
if(isset($_POST['Submit2'])){
	$programme=$_POST['programme'];
	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];
	$name= $_POST['name'];
	$matno= $_POST['matno'];
	$count = $_POST['count'];
	$count=$count-1;
	$m=0;
$mm = mysql_query("UPDATE `consultdbsnw`.`studentsnm` SET `stat` = '1' WHERE `studentsnm`.`matno`='$matno'") or die(mysql_error());
	while($m<=$count){
$m=$m+1;
$scr= "score".$m;
$score = $_POST[$scr];
$s = "sn".$m;
$sn = $_POST[$s];
// new data
$scr1= "scores".$m;
$score1 = $_POST[$scr1];
$s1 = "sn".$m;
$sn1 = $_POST[$s1];


include("includes/scoregrade.php");
$point = $n[$grade1];
$un="unit".$m;
$unit=$_POST[$un];
$cod="code".$m;
$code = $_POST[$cod];

// new data
$point1 = $n[$grade1];
$un1="unit".$m;
$unit1=$_POST[$un1];
$cod1="code".$m;
$code1 = $_POST[$cod1];
// stat = 1 mean spill


$query=mysql_query("UPDATE  `consultdbsnw`.`results` SET  `code`='$code',`unit`='$unit',`score` =  '$score',`grade` =  '$grade1',`points`='$point',`stat`='1' WHERE  `results`.`sn` ='$sn'") or die(mysql_error());
// keep old result
$oldres= mysql_query("INSERT INTO `consultdbsnw`.`coresult` (`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`, `programme`, `semester`, `session`, `stat`) VALUES ('$name', '$matno', '$code1', '$unit1', '$score1', '$grade1', '$point', '$programme', '$semester', '$session', 'spill','$year')")or die(mysql_error());

}
echo "<script language = 'javascript'>"."alert('Records updated')"."</script>";
echo "<font color = 'red'><i>"."Records Updated"."</i></font>";
	}
?>
	
	<?php if(isset($_POST['Submit'])){
	$programme=$_POST['programme'];
	$session=$_POST['session'];
	$year=$_POST['year'];
	$semester=$_POST['semester'];
	$matno=$_POST['matno'];
	$query=mysql_query("SELECT * FROM `course` WHERE programme ='$programme' && semester = '$semester'  && sessions = '$session'");
	$sql=mysql_query("SELECT * FROM `studentsnm` WHERE matno='$matno'");
	$row=mysql_fetch_array($sql);

	
	?>
	
	<table border="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table border="0">
        <tr>
          <td ><span style="font-weight: bold">Name:</span></td>
          <td ><input name="name" type="text" id="name" value="<?php echo $row['names'];?>" size="40" />
          </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">MatricNo:</span></td>
          <td ><input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>"/>
          </td>
        </tr>
      </table>
        <table border="0">
          <tr>
            <?php 
				$msql=mysql_query("SELECT * FROM  `results` WHERE matric_no='$matno' && semester='$semester'");
if(!$msql){
die(mysql_error());}

			$n=0; 
						while (($col= mysql_fetch_array($query)) && ($rows = mysql_fetch_array($msql))){
			 $n=$n+1;
			 ?><td ><span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
			    
			    <input name="<?php echo'sn'.$n;?>" type="hidden" id="sn" value="<?php echo $rows['sn'];?>" />
			    <input name="<?php echo'score'.$n;?>" type="text" value="<?php echo $rows['score'];?>" size="4">
                <input name="<?php echo'scores'.$n;?>" type="hidden" value="<?php echo $rows['score'];?>" size="4" />
				<input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>" size="4">
				<input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>" size="4">
			 </span></td>
            <?php }?>
          </tr>
        </table>
        <input name="count" type="hidden" id="count" value="<?php echo $n;?>" />
        <input type="submit" name="Submit2" value="Submit" />
        <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
        <input type="hidden" name="session"  value="<?php echo $session;?>"/>
        <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
        <input type="hidden" name="year"  value="<?php echo $year;?>"/>
    </form>
    </td>
  </tr>
</table>

	<?php 
	exit;
	}
	
	?>
	
	</td>
  </tr>
</table>
<table width="80%" align="center">
  <tr>
    <td><form action="" method="post" name="grade" id="grade">
      <strong>INPUT RESULTS</strong>
      <table style="text-align: left;color:blue;">
        <tr>
          <td ><span style="font-weight: bold">PROGRAMME:</span></td>
          <td ><span style="font-weight: bold">
            <select name="programme" id="programme">
			<option selected="selected">Select Programme</option>
            
             <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'  && dep LIKE '%Pre-HND%'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
                      </select>
          </span> </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">MATRIC NUMBER: </span></td>
          <td ><span style="font-weight: bold">
            <input type="text" name="matno" />
              </span></td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">SESSION:</span></td>
          <td ><span style="font-weight: bold">
            <select name="session">
             <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                      <?php echo include('includes/sessions.php');?>

              </select>
          -          
          <select name="year" id="year">
            <option selected="selected"></option>
			<option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
          </select>
          </span></td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">SEMESTER:</span></td>
          <td ><span style="font-weight: bold">
            <select name="semester">
			<option selected="selected"></option>
              <option value="1">First Semester</option>
              <option value="2">Second Semester</option>
              <option value="3">Third Semester</option>
            </select>
          </span></td>
        </tr>
      </table>
      <input name="Submit" value="Submit" type="submit" />
      <br />
    </form></td>
  </tr>
</table>


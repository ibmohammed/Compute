
<?php
// set sessions
if (!isset($_SESSION)) {
  session_start();
}



 include("includes/header.php"); ?>        
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>

<div>

<?php 

if(isset($_POST['Submit0'])){



$code = $_POST['code'];
$unit = $_POST['unit'];
$count = $_POST['rows'];
$semester=$_POST['semester'];
//	$session=$_POST['session'];
	$session= date('Y');
		$programme=$_POST['dept'];
	//$year=$_POST['year'];		
	//$session = $_POST['session'];
	
for($x = 1; $x<=$count;$x++){
// loop begins


$nm = "names".$x;
$sco = "score".$x;
$mtn = "matno".$x;

	$name= $_POST[$nm];
	$matno= $_POST[$mtn];
	$score = $_POST[$sco];

// verify if records exist 

include("includes/scoregrade.php");
$point = $n[$grade1];

$stres = mysql_query("SELECT * FROM `consultdbsnw`.`results` WHERE `matric_no` ='$matno' && `code` = '$code' &&`unit` ='$unit'") or die(mysql_error());
$nrows= mysql_num_rows($stres);

if($nrows == 0){

					// insert results
					$query=mysql_query("INSERT IGNORE INTO `consultdbsnw`.`results` 
					(`sn`, `name`, `matric_no`, `code`,`unit`,`score`, `grade`,`points`, 
					`programme`, `semester`, `session`) 
					VALUES (NULL, '$name', '$matno','$code','$unit', '$score', '$grade1',
					'$point', '$programme', '$semester', '$session')");

					echo "<div style = 'color:pink;'>Records Inserted for". $matno."</div><br/>";

				}elseif($nrows >= 1){

//update results


echo "<div style = 'color:purple;'>records Replaced for". $matno."</div><br/>";
}

} //end of loop

include('backform.php');

exit;
}elseif(isset($_POST['scor'])){
// echo " I cant see any session";
if (!isset($_SESSION)) {
  session_start();
}
$unit = $_POST['unit'];
$dept = $_SESSION['prog'];
$year = $_SESSION['class'];
$code = $_POST['scors'];
$semester = $_SESSION['semester'];

$quri = mysql_query("SELECT * FROM `studentsnm` where dept = '$dept' && year = '$year'") or die(mysql_error());

echo '<div align="center">Course Code: '. $code.'</div>';

?>
	
	<form method="post" action="" name="formscore">
	
	<table style = "font-size:10px; width:600px;">
		<tr>
			<td >SN	&nbsp;</td>
			<td >Name</td>
			<td >Matno</td>
			<td style="width: 144px" >Score</td>
		</tr>
		
		<?php 
		$n = 0;
		while($rows = mysql_fetch_array($quri)){
$matno = $rows['matno'];

$marks = mysql_query("SELECT score, grade FROM `results` WHERE matric_no = '$matno' && code = '$code' && semester = '$semester' ") or die(mysql_error());
$num_row = mysql_num_rows($quri);
$cols = mysql_fetch_array($marks);
$n++;

		?>
		<tr >
			<td ><?php echo $n;?></td>
			<td ><?php echo $rows['names'];?>
			<input name="names<?php echo $n;?>" type="hidden"  value="<?php echo $rows['names'];?>"/></td>
			<td ><?php echo $rows['matno'];?>
			<input name="matno<?php echo $n;?>" type="hidden"  value="<?php echo $rows['matno'];?>"/></td>
			<td style="width: 144px" >
			
				<input name="score<?php echo $n;?>" type="text" value="<?php echo $cols['score'];?>" size="3" style="font-size:11px;" />
			</td>
		</tr><?php }?>
		<tr>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td >
      	    &nbsp;</td>
			<td style="width: 144px">
			<input name="dept" type="hidden"  value="<?php echo $dept;?>"/>
			<input name="semester" type="hidden"  value="<?php echo $semester;?>"/>
			<input name="code" type="hidden"  value="<?php echo $code;?>"/>
			<input name="unit" type="hidden"  value="<?php echo $unit;?>"/>
				<input name="rows" type="hidden" value="<?php echo $num_row;?>" />
			
			</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td >&nbsp;</td>
			<td >
      	    <?php
      	    
include('backform.php');

 ?>
      	    
      	    &nbsp;</td>
			<td style="width: 144px">
			
			<input name="Submit0" type="submit" value="Submit" style="border:thin; color:blue;"/></td>
		</tr>
	</table>

</form>


<?php
exit;
 }




if(isset($_GET['btn'])){
echo "Welcome Home";
}


if(isset($_POST['Submit'])){

//collect form data
$semester = $_POST['semester'];
$programme = $_POST['courseid'];
$class = $_POST['class'];
$session = $_POST['session'];


// assign valuse to session 

$_SESSION['semester'] = $semester;
$_SESSION['prog'] = $programme;
$_SESSION['class'] = $class;
$_SESSION['session'] = $session;

// query to view courses
$sql = mysql_query("SELECT * FROM `course` WHERE Programme = '$programme' && semester = '$semester' && sessions = '$session'") or die(mysql_error());

?>

	<table style = "font-size:10px; width:600px;">
		<tr>
			<td ><strong>SN	&nbsp;</strong></td>
			<td ><strong>Course Title</strong></td>
			<td ><strong>Course code</strong></td>
			<td ><strong>Course Unit</strong></td>
			<td  colspan="3"><strong>Actions</strong></td>
		</tr>
		<?php 
		$n = 0;
		while($row = mysql_fetch_array($sql)){
		$n++;
		?>
		
		<tr>
			<td ><?php echo $n;?></td>
			<td ><?php echo $row[5];?>&nbsp;</td>
			<td ><?php echo $row[4];?>&nbsp;</td>
			<td ><?php echo $row[2];?>&nbsp;</td>
			<td >&nbsp;<?php echo $row[0];?></td>
			<td >&nbsp;</td>
			<td style="height: 23px; width: 44px;"><form name="scor" action="" method="post">  
			<input name="unit" type="hidden" value="<?php  echo $row[2];?>"/> 
				<input name="scors" type="hidden" value="<?php  echo $row[4];?>"/> 
				<input name="scor" type="submit" value="Input Score" style="border:thin; color:blue;"/></form></td>
		</tr><?php }?>
	</table>

<?php
exit;
}
?>
	
	
	
</div>


<form action="" method="post" name="grade" id="grade">
      <strong>INPUT RESULTS</strong>
		<table style="width: 40%; height: 142px">
			<tr>
				<td style="height: 30px">Semester:</td>
				<td style="height: 30px"><input name="semester" type="text" />&nbsp;</td>
			</tr>
			<tr>
				<td>Programme:</td>
				<td><select name="courseid">
          <option selected="selected">Select Programme</option>
            
             <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              </select></td>
			</tr>
			<tr>
				<td style="height: 26px">Class:</td>
				<td style="height: 26px"><select name="class">
				<option>14</option>
				<option>15</option>
				<option>16</option>
				<option>17</option>
				<option>18</option>
				<option>19</option>
				<option>20</option>
				</select></td>
			</tr>
			<tr>
				<td>Session:</td>
				<td>
				<input name="session" type="text" value="<?php echo date('Y')."/". (date('Y')+1);?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
      <input name="Submit" value="Submit" type="submit"  style="border:thin; color:blue;"/>
      <br />
    </form>

</body>

</html>

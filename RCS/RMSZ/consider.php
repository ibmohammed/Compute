<?php include("includes/header.php"); ?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Consideration</title>
<style type="text/css">

tbody {
	display:table-row-group;
}
</style>
</head>

<body>
<?php 
if(isset($_POST['Submit1'])){

foreach($_POST['sn'] as $selected){
//$sn = $_POST['sn']; 

$sql = mysqli_query($conn,"UPDATE `results` SET  `score` =  '40', `grade` = 'E', `points` = '2' WHERE  
`results`.`sn` ='$selected'") or die(mysqli_error());

echo "Consideration done.";

}

}elseif(isset($_POST['Submit'])){

$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$score = $_POST['score'];


$ql = mysqli_query($conn,"SELECT * FROM  `results` WHERE  (score >= $score && score < 40) && programme = '$programme' &&
 semester = '$semester' && session = '$session' ") or die(mysqli_error());?>
 
 <form method="post">

<table style="width: 40%">
	<tr>
		<td>Name</td>
		<td>Matric No.</td>
		<td>Code</td>
		<td>Score</td>
	</tr>
	<?php while($row = mysqli_fetch_assoc($ql)){?>
	<tr>
		<td>
		
			<input name="matno0" type="text" value = "<?php echo $row['name'];?>" disabled="disabled" /></td>
		<td>
		
			<input name="matno" type="text" value = "<?php echo $row['matric_no'];?>" disabled="disabled" />
			<input name="sn[]" type="hidden" value="<?php echo $row[0];?>" />
		</td>
		<td>
		
			<input name="code" type="text" value = "<?php echo $row['code'];?>" disabled="disabled" style="width: 76px" /></td>
		<td>
		
			<input name="score" type="text" value = "<?php echo $row['score'];?>" style="width: 55px" /></td>
	</tr><?php } ?>
	<tr>
		<td>
		
			&nbsp;</td>
		<td>
		
			&nbsp;</td>
		<td>
		
			<input name="Submit1" type="submit" value="submit" />&nbsp;</td>
		<td>
		
			&nbsp;</td>
	</tr>
</table>
 </form>
 

<?php
exit;
 }
?>


<form method="post">

<table style="width: 40%">
	<tr>
		<td style="height: 30px">Enter Score:</td>
		<td style="height: 30px">
		
			<input name="score" type="text" style="width: 46px" />
		&nbsp;</td>
    </tr>
	<tr>
		<td>Programme:</td>
		<td>
      
      <select name="programme" id="programme">
<option selected="selected"> <?php // echo $_GET['depts'];?></option>

 <?php include('dptcode.php') ;
            
            
//$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode' && `dep` LIKE '%National Diploma%'") or die(mysqli_error());
  
          $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
                        
		<?php
			//include('prog1.php');
			//include('prog2.php');
			//include('prog3.php');
			 ?>
      </select></td>
    </tr>
	<tr>
		<td>Semester:</td>
		<td><select name="semester" id="semester">
        <option selected="selected"></option>
        <option value="1">First Semester</option>
        <option value="2">Second Semester</option>
        <option value="3">Third Semester</option>
        <option value="4">Fourth Semester</option>
        <!--<option value="5">Fifth Semester</option>
        <option value="6">Sixth Semester</option> -->
      </select></td>
    </tr>
	<tr>
		<td>Session:</td>
		<td><select name="session" id="session">
      <option selected="selected"></option>
      <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
        <?php echo include('includes/sessions.php');?>
      </select>-<select name="year" id="select2">
          <option selected="selected"></option>
		  <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
             <?php 
                         for($i = 2017; $i<=2020; $i++){
                         
                         echo "<option>".$i."</option>";
                         }
                         ?>
        </select></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input name="Submit" type="submit" value="submit">&nbsp;</td>
	</tr>
</table>

</form>


</body>

</html>

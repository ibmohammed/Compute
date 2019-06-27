
<?php 
$conn = $logs;
if(isset($_POST['Submit1'])){

foreach($_POST['sn'] as $selected){
//$sn = $_POST['sn']; 

$sql = mysqli_query($conn,"UPDATE `results` SET  `score` =  '40', `grade` = 'E', `points` = '2' WHERE  
`results`.`sn` ='$selected'") or die(mysqli_error($conn));

echo "Consideration done.";

}

}elseif(isset($_POST['Submit'])){

$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$score = $_POST['score'];


$ql = mysqli_query($conn,"SELECT * FROM  `results` WHERE  (score >= $score && score < 40) && prog_id = '$programme' &&
 semester = '$semester' && session = '$session' ") or die(mysqli_error($conn));?>
 
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
			<input name="sn[]" type="hidden" value="<?php echo $row['sn'];?>" />
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

<table  class="table table-bordered">
	<tr>
		<td>Enter Score:</td>
		<td>
		
			<input name="score" type="text" class="form-control" placeholder="Enter Score"/>
		</td>
    </tr>
	<tr>
		<td>Programme:</td>
		<td>
			<select name="programme" id="programme" class="form-control">
			<option selected="selected" value="">Select Programme</option>
				<?php include('dptcode.php') ;
				$queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
				while($pcd = mysqli_fetch_assoc($queri)){
				?>
				<option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
				<?php }?>
			</select>
	</td>
    </tr>
	<tr>
		<td>Semester:</td>
		<td>
		<select name="semester" id="semester" class="form-control">
		<option selected="selected" value="">Select Semester</option>
			<option value="1">First Semester</option>
			<option value="2">Second Semester</option>
			<option value="3">Third Semester</option>
			<option value="4">Fourth Semester</option>
     	</select>
	  </td>
    </tr>
	<tr>
		<td>Session:</td>
		<td>
		<select name="session" id="session" class="form-control">
			<option selected="selected" value="">Select Session</option>
			<option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
			<?php echo include('includes/sessions.php');?>
        </select>
		-
		<select name="year" id="select2" class="form-control">
			<option selected="selected" value="">Select Year</option>
			<option>9</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			<option>13</option>
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<?php 
			for($i = 17; $i<=20; $i++)
			{
			echo "<option>".$i."</option>";
			}
			?>
        </select>
		
		</td>
	</tr>
	
</table>
<br>
<input name="Submit" type="submit" value="submit" class="btn btn-gradient-primary mr-2">
<br>
<hr>

</form>
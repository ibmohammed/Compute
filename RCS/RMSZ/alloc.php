<?php
if (!isset($_SESSION))
{
  session_start();
  //require_once('../../functions/queries.php');
  //require_once('../../connections/connection.php');
}
require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');



if(isset($_POST['Resets']))
{
	if (!empty($_POST['reset_list']))
	{
	
	
		foreach($_POST['reset_list'] as $selected)
		{
			//$//staff_id = $_POST['staff_id']; 
			//$_SESSION['staff_id'] = $_POST['staff_id'];
			
		
			$sql = "UPDATE `course` SET `staff_id` = '0' WHERE `course`.`sn` = '$selected'";
			
			
			$sqls = mysqli_query($logs, $sql) or die(mysqli_error($logs));
		
		}
		
			
	}
}



if(isset($_POST['Submit']))
{
	if (!empty($_POST['course_list']))
	{
	
	
		foreach($_POST['course_list'] as $selected)
		{
			$staff_id = $_POST['staff_id']; 
			$_SESSION['staff_id'] = $_POST['staff_id'];
			
		
			$sql = "UPDATE `course` SET `staff_id` = '$staff_id' WHERE `course`.`sn` = '$selected'";
			
			
			$sqls = mysqli_query($logs, $sql) or die(mysqli_error($logs));
		
		}
		
			
	}
}



if(@$_SESSION['staff_id'] == True){

$msql = "SELECT * FROM `course` WHERE staff_id = '".$_SESSION['staff_id']."'";
$msqls = mysqli_query($logs, $msql);

//}

?>
	<h4 style="color:red">Courses Allocated to <?php echo @$_SESSION['names']." (".@$_SESSION['number'].")";?></h4>
	<form name="form2" method="post" action="">
	
		<table class="table table-bordered">
			<tr>
				<th>#</th>
				<th>Code</th>
				<th>Title</th>
				<th>Unit</th>
				
			</tr>
		<?php 
		//$in = 0;
		while($col = mysqli_fetch_assoc($msqls)){ //$in++;?>
			<tr>
				<td><input type="checkbox" name="reset_list[]" value="<?php echo $col['sn'];?>" class="form-control"></td>
				<td><?php echo $col['code'];?></td>
				<td><?php echo $col['title'];?></td>
				<td><?php echo $col['unit'];?></td>
			</tr>
			<?php }?>
		</table>
		<br>
	<p>
		<button name="Resets" class="btn btn-gradient-primary mr-2">Reset</button></p>
	
	</form>
	<br>
	<hr>
<?php 
}

// end action?>	
	
	<div>
	<form name ="form1" method="post" action="">
	<table class="table table-bordered">
	<tr>
	<td colspan="3">
	<select name="staff_id" class="form-control">
	<option selected="selected">Select staff</option>
	
	
	
	<?php 
	
	//$numrow = mysqli_num_rows($dprtment);
	//$_SESSION['deptid'];
	$dprtment =  staff_alloc($_SESSION['deptid'], $logs);
	//$in = 0;
	while ($srow = mysqli_fetch_assoc($dprtment))
	{  
	$_SESSION['names'] = $srow['names'];
	$_SESSION['number'] = $srow['number'];
	?>
	<option value="<?php echo $srow['id'];?>"><?php echo $srow['names']." (".$srow['number'].")";?></option>
	<?php 
	}?>
	</select>
	</td>
	</tr>
	<tr>
	<th>#</th>
	<th>Code</th>
	<th>Title</th>
	<th>Unit</th>
	<th>Semester<?php echo $_SESSION['deptid'];?></th>
	</tr>
	<?php 
	$pgram =  programmes($_SESSION['deptid'], $logs);
	while($prow = mysqli_fetch_assoc($pgram))
{
	$crs =  t_courses($_SESSION['prgid'], $logs);
	while($rows = mysqli_fetch_assoc($crs))
	{
	?>
	<tr>
	<td><input type="checkbox" name="course_list[]" value="<?php echo $rows['sn'];?>" class="form-control"></td>
	<td><?php echo $rows['code'];?></td>
	<td><?php echo $rows['title'];?></td>
	<td><?php echo $rows['unit'];?></td>
	<td><?php echo $rows['semester'];?></td>
	
	</tr>	
	<?php 
	}
}
?></table>
<br>
<button name="Submit" class="btn btn-gradient-primary mr-2">Allocate	</button>
</form>
</div>
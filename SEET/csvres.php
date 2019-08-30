<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    


<?php  
include("csvres_extend.php");
if(isset($_POST['Submitf']))
{
	if ($_POST['programme'] =="" || $_POST['session'] == "" || $_POST['semester'] == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?csv");
		</script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?csv'><br>&lt;&lt;Back</a>");
	}

	$crss = mysqli_prepare($logs,"SELECT code, title FROM `course` WHERE 
	`prog_id` = ? && `semester` = ? && `sessions` = ?") 
	or die(mysqli_error($logs));
	mysqli_stmt_bind_param($crss, "sss", $programme,$semester,$session);

	// set parameter
	$programme = $_POST['programme'];
	//$programme = mysqli_escape_string($logs,$programme);
	$session=$_POST['session'];
	$semester=$_POST['semester'];

	mysqli_stmt_execute($crss);
	$result = mysqli_stmt_get_result($crss);

	$semsesprog = 1;// to enable selection of variables in csv_choosefile.php
	include("csv_choosefile.php");
	//exit;
 }
 
if (empty($_GET['csv'])) 
{ 
	?> 
	<br>
		<hr>
		<br>
		<i style ="color:red;">Select programme, session and semester to upload score for</i>
	<form action="" method="post" name="grade" id="grade">
		<table class="table table-bordered">
			<tr>
			<td>PROGRAMME:</td>
			<td>
				<select name="programme" id="programme" class="form-control">
					<option selected="selected" value="">Select Programme</option>
					<?php include('dptcode.php') ;
						 while($pcd = mysqli_fetch_array($prgqry, MYSQLI_ASSOC))
						{
							?>
							<option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
							<?php 
						}?>
				</select>
			</td>
			</tr>
			<tr>
				<td>SESSION:</td>
				<td>
					<select name="session" class="form-control">
						<option selected="selected" value="">Select Session</option>
						<option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
									<?php echo include('includes/sessions.php');?>
						<option>2018/2019</option>
					</select>
				</td>
			</tr>
			<tr>
				<td >SEMESTER:</td>
				<td >
					<select name="semester" class="form-control">
						<option selected="selected" value="">Select Semester</option>
						<option value="1">First Semester</option>
						<option value="2">Second Semester</option>
						<option value="3">Third Semester</option>
						<option value="4">Fourth Semester</option>
						<option value="5">Fift Semester</option>
						<option value="6">Sixth Semester</option>
					</select>
				</td>
			</tr>
		</table>
		<br>
		<input name="Submitf" value="Submit" type="submit" class="btn btn-gradient-primary mr-2"/>
		<br />
		<hr>
		</form>
		<br>
		<hr>
		<br>
	<?php
}
?>

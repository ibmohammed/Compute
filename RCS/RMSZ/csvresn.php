<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    

<?php  
include("csvres_extend.php");
if(isset($_POST['Submitff']))
{
	$programme=$_POST['dept_id'];
	$ncode=$_POST['code'];
	$programme = mysqli_escape_string($conn, $programme);


	$myqry = "SELECT * FROM entered 
	WHERE 
	code='".$_POST['code']."' && prog_id ='".$_POST['dept_id']."' 
	&& semester='".$_POST['semester']."' && session='".$_POST['session']."'";
	$chh = mysqli_query($conn, $myqry) or die(mysqli_error($conn).'999');
	//mysqli_num_rows()


	if(mysqli_num_rows($chh) > 0)
	{
		// view result 
		$rec = "SELECT * FROM `results` WHERE code='".$_POST['code']."'
		&& prog_id='".$_POST['dept_id']."' && semester='".$_POST['semester']."' && session='".$_POST['session']."'";
		$clue = mysqli_query($conn, $rec) or die(mysqli_error($conn));
		echo '<h3>Uploaded Scores for '.$_POST['code'].' </h3>';
		?>
		<!-- -->
		<table class="table table-bordered">
			<tr>
				<th>#	</th>
				<th>Names	</th>
				<th>Matric Number	</th>
				<th>Code	</th>
				<th>Unit	</th>
				<th>Score	</th>
				<th>Grade	</th>
			</tr>
			<?php 
			$no = 0;
			while ($value = mysqli_fetch_assoc($clue))
			{
				$no++;
				?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['matric_no'];?></td>
					<td><?php echo $value['code'];?></td>
					<td><?php echo $value['unit'];?></td>
					<td><?php echo $value['score'];?></td>
					<td><?php echo $value['grade'];?></td>
				</tr>
				<?php 
			}?>
		</table>
		<!--  -->
		<?php 
		//exit(); 
	}
	else
	{
		echo "No scores entered/uploaded yet!!";
	}
}
else
{
	if (empty($_GET['csvrn'])) 
	{ 
		$id_staff = $_SESSION['id_staff'];

	$crss = "SELECT `code`, `title`, `unit`, `prog_id`, `semester`, `sessions` FROM `course` WHERE `staff_id` = ?";
	if($crss = mysqli_prepare($conn,$crss))
	{
		mysqli_stmt_bind_param($crss, "i", $id_staff);
		// set parameter
		$id_staff = $_SESSION['id_staff'];
	}
	else
	{
		die(mysqli_error($conn));	
	}
	
	mysqli_stmt_execute($crss);
	$result = mysqli_stmt_get_result($crss);


		echo '<h3>Upload Scores</h3>';
		// comfirm if record entered 
	//	include("csv_choosefile.php");
	$semsesprog = 0;
	include("csv_choosefile.php");
	}
}
?>

<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    


<?php  
if(isset($_POST['Submit']))
{
	$code = $_POST['ccodes'];
	$semst = $_POST['semester'];
	$sesn = $_POST['session'];
	$prgrm = $_POST['programme'];
	//get the course code Unit
	$unitt ="SELECT unit FROM `course`  
						 WHERE 
						 `code` = '$code' && 
						 `prog_id`= '$prgrm' && 
						 `semester` = '$semst' && 
						 `sessions`= '$sesn'";
	$unt = mysqli_query($conn,$unitt)or die(mysqli_error($conn));




				$unitss =mysqli_fetch_assoc($unt);
				$cunits = $unitss['unit'];
	// check if recordsexist			
	$sqry = "SELECT * FROM `entered` 
					  WHERE 
					  `code` = '$code' && 
					  `prog_id`= '$prgrm' && 
					  `semester` = '$semst' && 
					  `session`= '$sesn'";
	$qqry = mysqli_query($conn,$sqry) or die(mysqli_error($conn));
	$nmrws = mysqli_num_rows($qqry);
	
	if($nmrws == 0)
	{  
		$fname = $_FILES['csv']['name'];
		echo 'upload file name: '. $fname. ' ';
		$chk_ext = explode(".",$fname);
		if(strtolower(end($chk_ext)) == "csv")
		{
			$filename = $_FILES['csv']['tmp_name'];
			$handle = fopen($filename, "r");
			while (($data = fgetcsv($handle,1000,",")) !== FALSE)
			{
				$score = $data[1];
				$smatno = $data[0];
				// get students names from table 
				$snmss = "SELECT `names` FROM `studentsnm` 
							 			 WHERE 
										 `matno` = '$smatno'";
				$snms = mysqli_query($conn,$snmss);
				$stdnmr = mysqli_fetch_assoc($snms);
				$snames = $stdnmr['names'];
				//$snames = mysql_escape_string($snames);
				include("includes/scoregrade.php");
				//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
				$point = $n[$grade1];
				$emtq ="INSERT IGNORE INTO `results`  
				(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`) 
				VALUES( 
				'".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
				'".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
				'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
				'".addslashes($sesn)."'			
				)";
				mysqli_query($conn,$emtq) or die(mysqli_error($conn)); 
			}
			fclose($handle);
			echo "Successfully imported";
			$qsl = "INSERT INTO `entered` (`code`, `unit`, `prog_id`, `semester`, `session`)
			VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')";
			$qry = mysqli_query($conn,$qsl) or die(mysqli_error($conn));
		}
		else
		{
			echo "Invalid file";
		}
	}// numrow----
	else
	{
		// Delete from table entered  and results to enable records overwrite
		mysqli_query($conn,"DELETE FROM `entered` WHERE
		`code`= '$code' && 
		`unit` = '$cunits' && 
		`prog_id` = '$prgrm' && 
		`semester` = '$semst' && 
		`session` = '$sesn' ") or die(mysqli_error($conn).'hhn');

		mysqli_query($conn,"DELETE FROM `results`  WHERE 
		`code`= '$code' && 
		`unit` = '$cunits' &&
		`prog_id` = '$prgrm' &&
		`semester` = '$semst' &&
		`session` = '$sesn'") or die (mysqli_error($conn).'hh');

		$fname = $_FILES['csv']['name'];

		echo 'upload file name: '. $fname. ' ';
		$chk_ext = explode(".",$fname);

		if(strtolower(end($chk_ext)) == "csv")
		{

			$filename = $_FILES['csv']['tmp_name'];
			$handle = fopen($filename, "r");

			while (($data = fgetcsv($handle,1000,",")) !== FALSE)
			{
				$score = $data[1];
				$smatno = $data[0];

				// get students names from table 

				
				//$snms = mysqli_query($conn,"SELECT `names` FROM `studentsnm` 
				//WHERE `matno` = '$smatno'");
				//$stdnmr = mysqli_fetch_assoc($snms);
				
				$snms = mysqli_prepare($conn,"SELECT `names` FROM `studentsnm` 
														   WHERE `matno` = ?");
				
				mysqli_stmt_bind_param($snms, "sssissssss", $smatno,);
				
				mysqli_stmt_execute($snms);
				$stdnmr = mysqli_stmt_get_result();
				$stdnmr = mysqli_fetch_aarray($snms, MYSQLI_ASSOC);

				$snames = $stdnmr['names'];

				//$snames = mysql_escape_string($snames);

				include("includes/scoregrade.php");

				//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd

				
				/* $resultsss =	mysqli_query($conn,"INSERT IGNORE INTO `results`  
				(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`) 
				VALUES( 
				'".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
				'".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
				'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
				'".addslashes($sesn)."'			

				) 
				") or die(mysqli_error($conn));  */


				$point = $n[$grade1];
			$resultsss =	mysqli_prepare($conn,"INSERT IGNORE INTO `results`  
				(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`) 
				VALUES(?,?,?,?,?,?,?,?,?,?
				) 
				") or die(mysqli_error($conn)); 

mysqli_stmt_bind_param($resultsss, "sssissssss", $names,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
mysqli_stmt_execute($resultsss);


			}

			fclose($handle);
			echo "Successfully imported";

			/*$qry = mysqli_query(
									$conn,"INSERT INTO `entered` 
									(`code`, `unit`, `prog_id`, `semester`, `session`
									)
									VALUES(
										'$code', '$cunits', '$prgrm', '$semst', '$sesn'
										)"
								) or die(mysqli_error($conn));
								*/

		$qry= mysqli_prepare($conn,"INSERT INTO `entered` 
								(`code`, `unit`, `prog_id`, `semester`, `session`
								)VALUES(?,?,?,?,?)"
							)or die(mysqli_error($conn));
			mysqli_stmt_bind_param($qry, "sssss", $code, $cunits, $prgrm, $semst, $sesn);
			mysqli_stmt_execute($qry);
		}

		else
		{
			echo "Invalid file";
		}
	}

}
elseif(isset($_POST['Submitf']))
{
	$crss = mysqli_prepare($conn,"SELECT code FROM `course` WHERE 
	`prog_id` = ? && `semester` = ? && `sessions` = ?") 
	or die(mysqli_error($conn));
	mysqli_stmt_bind_param($crss, "sss", $programme,$semester,$session);

	// set parameter
	$programme = $_POST['programme'];
	//$programme = mysqli_escape_string($conn,$programme);
	$session=$_POST['session'];
	$semester=$_POST['semester'];

	mysqli_stmt_execute($crss);
	$crss = mysqli_stmt_get_result($crss);
	?>
	<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


		<table class="table table-bordered">
			<tr>
				<td>Course Code:</td>
				<td>
					<select name="ccodes" class="form-control">
						<?php while($rows = mysqli_fetch_array($crss, MYSQLI_ASSOC)){?>
						<option><?php echo $rows['code'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Choose your file:</td>
				<td>  <input name="csv" type="file" id="csv" class="form-control"/> </td>
			</tr>
		</table>

		<input name="programme" value="<?php echo $programme;?>" type="hidden"/>
		<input name="session" value="<?php echo $session;?>" type="hidden"/>
		<input name="semester" value="<?php echo $semester;?>" type="hidden"/>
		
		<input name="Submit" type="submit" value="Submit" class="btn btn-gradient-primary mr-2"> 
	</form>
	
	<?php
	exit;
 }
 
if (empty($_GET['csv'])) 
{ 
	?> 
	<form action="" method="post" name="grade" id="grade">
		<table class="table table-bordered">
			<tr>
			<td>PROGRAMME:</td>
			<td>
				<select name="programme" id="programme" class="form-control">
					<option selected="selected" value="">Select Programme</option>
					<?php include('dptcode.php') ;
						//$queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
						 //query from newmenu line 21
						 while($pcd = mysqli_fetch_array($prgqry, MYSQLI_ASSOC))
						//while($pcd = mysqli_fetch_assoc($queri))
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
	<?php
}
?>

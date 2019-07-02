<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    


<?php  


if(isset($_POST['Submitm']))
{
	$code = $_POST['ccodes'];
	//$semst = $_POST['semester'];
	//$sesn = $_POST['session'];
	//$prgrm = $_POST['programme'];
	$semst = $_SESSION['semester'];
	$sesn= $_SESSION['sessions'];
	$prgrm= $_SESSION['prog_id'];
	//$prgrm = mysql_escape_string($prgrm);
	//get the course code Unit
	$unitt ="SELECT unit FROM `course`  
						WHERE `code` = '$code' && 
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
				
				$snms = mysqli_query($conn,"SELECT `names` FROM `studentsnm` 
														   WHERE `matno` = '$smatno'");
				$stdnmr = mysqli_fetch_assoc($snms);
				$snames = $stdnmr['names'];
				
				//$snames = mysql_escape_string($snames);
					
				include("includes/scoregrade.php");
				
				//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd

				$point = $n[$grade1];
				mysqli_query($conn, "INSERT IGNORE INTO `results`  
				(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`) 
				VALUES( 
					'".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
					'".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
					'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
					'".addslashes($sesn)."'			
					) 
				") or die(mysqli_error($conn)); 
			
			}

			fclose($handle);
			echo "Successfully imported";
				
			$qry = mysqli_query(
										$conn,"INSERT INTO `entered`
										(
										`code`, `unit`, `prog_id`, `semester`, `session`
										)
										VALUES(
											'$code', '$cunits', '$prgrm', '$semst', '$sesn'
											)"
								) or die(mysqli_error($conn));

		}
		else
		{
			echo "Invalid file";
		}

	}

}



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

	if (empty($_GET['csv'])) 
	{ 
		




	$crss = "SELECT * FROM `course` WHERE staff_id = '".$_SESSION['id_staff']."'";
		$msqls = mysqli_query($logs, $crss);
		echo '<h3>Upload Scores</h3>';
		// comfirm if record entered 
		?>

		<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
						
			<table class="table table-bordered">
				<tr>
				<td>Course Code:</td>
				<td>
				<select name="ccodes" class="form-control" id="exampleSelectGender">
				<option selected="selected"><?php// echo $_POST['code'];?></option>
				<?php while($rows = mysqli_fetch_assoc($msqls)){?>			
				<option><?php echo $rows['code'];?></option>
				<?php }?>
				</select></td>
			</tr>
			<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" class="form-control"/> </td>
			</tr>
		</table>
		<br>
		
		<input name="Submitm" type="submit" value="Submit" class="btn btn-gradient-primary mr-2"> 
		<hr>
		<br>
			
		</form>

		<?php

	}
}
?>

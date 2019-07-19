<?php 
function insert_entered($conn, $code, $cunits, $prgrm, $semst, $sesn)
{
	$qry= mysqli_prepare($conn,"INSERT INTO `entered` 
					(`code`, `unit`, `prog_id`, `semester`, `session`
					)VALUES(?,?,?,?,?)"
				)or die(mysqli_error($conn));
	mysqli_stmt_bind_param($qry, "sssss", $code, $cunits, $prgrm, $semst, $sesn);
	$me = mysqli_stmt_execute($qry);
	return $me;
}

function insert_result($con, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn){
	$resultsss =	mysqli_prepare($con,"INSERT IGNORE INTO `results`  
	(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`prog_id`, `semester`, `session`) 
	VALUES(?,?,?,?,?,?,?,?,?,?
	) 
	") or die(mysqli_error($conn)); 
	mysqli_stmt_bind_param($resultsss, "sssissssss", $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
	
return $resultsss;
}


function update_result($con, $score,$grade1,$point,$co_spill,$smatno,$code){
	$resultsss =	mysqli_prepare($con,"UPDATE `results` 
    SET 
	`score` =  ?,
	`grade` =  ?,
	`points` = ?, 
	`co_spill` = ?
    WHERE  
	`results`.`matric_no` = ? &&  
	`results`.`code` = ?
	") or die(mysqli_error($conn)); 
	mysqli_stmt_bind_param($resultsss, "ssssss", $score,$grade1,$point,$co_spill,$smatno,$code);

return $resultsss;
}



function get_student_name($con, $smatno){
	$namee = mysqli_query($con, "SELECT `names` 
	FROM `studentsnm` WHERE `matno` = '$smatno'") or die(mysqli_error($con)."hhjk");

	return $namee;
}

if(isset($_POST['Submitm']))
{
	
    $code = $_POST['ccodes'];
	$semst = $_SESSION['semester'];
	$sesn = $_SESSION['sessions'];
	$prgrm = $_SESSION['prog_id'];
   
    
	$unitt ="SELECT unit FROM `course`  
						 WHERE 
					 `code`= '$code' && 
					 `prog_id` =  '$prgrm' && 
					 `semester` = '$semst' && 
					 `sessions` = '$sesn'";
   $unt = mysqli_query($conn,$unitt) or die(mysqli_error($conn));
			$unitss = mysqli_fetch_assoc($unt);
			$cunits = $unitss["unit"];
	// check if recordsexist			
	$sqry = "SELECT * FROM `entered` 
					  WHERE 
					 `code`= '$code' && 
					 `prog_id` =  '$prgrm' && 
					 `semester` = '$semst' && 
					 `session` = '$sesn'";
	if($qqry = mysqli_query($conn,$sqry))
	{
		$nmrws = mysqli_num_rows($qqry);
	}

	//if($compute_co ==0){

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
				// get students names from table 
				//include("includes/scoregrade.php");
				// insert into result table
				include("getname_getgrade_insertres.php");
				// insert into result table
				$resultssn = insert_result($conn, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
				mysqli_stmt_execute($resultssn);

				// chronicle 
				$lids = mysqli_insert_id($conn);
				$action = "INSERTED";
				include("dchronicle_res.php");
				// End of chronicles 
	
			}
			fclose($handle);
			echo "Successfully imported";
			// add to table entered courses
			insert_entered($conn, $code, $cunits, $prgrm, $semst, $sesn);
			 
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
		`prog_id` =  '$prgrm' && 
		`semester` = '$semst' && 
		`session` = '$sesn' ") or die(mysqli_error($conn).'hhn');
// Delete from result table
		mysqli_query($conn,"DELETE FROM `results`  WHERE 
		`code`= '$code' && 
		`unit` = '$cunits' && 
		`prog_id` =  '$prgrm' && 
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
				// get students names from table 
				//include("includes/scoregrade.php");
				// insert into result table
				include("getname_getgrade_insertres.php");
				// insert into result table


				$resultssn = insert_result($conn, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
				mysqli_stmt_execute($resultssn);

				// chronicle 
				$lids = mysqli_insert_id($logs);
				$action = "Overwrite";
				include("dchronicle_res.php");
				// End of chronicles

			}

			fclose($handle);
			echo "Successfully imported";
			// add to table entered courses
			insert_entered($conn, $code, $cunits, $prgrm, $semst, $sesn);

		
 
		}
		else
		{
			echo "Invalid file";
		}
	}



//}elseif($compute_co ==1){
	// update query 

/*
 *
 * 
 * 		$fname = $_FILES['csv']['name'];
		echo 'upload file name: '. $fname. ' ';
		$chk_ext = explode(".",$fname);
		if(strtolower(end($chk_ext)) == "csv")
		{
			$filename = $_FILES['csv']['tmp_name'];
			$handle = fopen($filename, "r");

			while (($data = fgetcsv($handle,1000,",")) !== FALSE)
			{
				// get students names from table 
				//include("includes/scoregrade.php");
				// insert into result table
				include("getname_getgrade_insertres.php");
				// insert into result table
				if($co_spill == 1){
					$co_spill = "co";
					$succeed = "CO Result";
				}elseif($co_spill == 0){
					$co_spill = "spo";
					$succeed = "SPO Result";
				}

				$resultssn = update_result($conn, $score,$grade1,$point,$co_spill,$smatno,$code);
				mysqli_stmt_execute($resultssn);

				// chronicle 
				//$lids = mysqli_insert_id($logs);
				//$action = "Overwrite";
				//include("dchronicle_res.php");
				// End of chronicles

			}

			fclose($handle);
			echo "Successfully Updated".@$succeed;
 */


//}				


}
?>
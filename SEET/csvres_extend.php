<?php 
if(isset($_POST['Submitm']))
{
	
    $code = $_POST['ccodes'];
	$semst = $_SESSION['semester'];
	$sesn = $_SESSION['sessions'];
	$prgrm = $_SESSION['prog_id'];

	if($compute_co == 0)
	{
		$extn = "csvco";
	
	}
	else
	{
		$extn = "csv";
	}
   
	if ($prgrm =="" || $code == "" || $sesn == "" || $semst == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?'.$extn.'");
		</script>';
		
		//die("Empty fields not allowed!!!"."<a href='index.php?csv'><br>&lt;&lt;Back</a>");
	}

    
	$unitt ="SELECT unit FROM `course`  
						 WHERE 
					 `code`= '$code' && 
					 `prog_id` =  '$prgrm' && 
					 `semester` = '$semst' && 
					 `sessions` = '$sesn'";
   $unt = mysqli_query($logs,$unitt) or die(mysqli_error($logs));
			$unitss = mysqli_fetch_assoc($unt);
			$cunits = $unitss["unit"];
	// check if recordsexist			
	$sqry = "SELECT * FROM `entered` 
					  WHERE 
					 `code`= '$code' && 
					 `prog_id` =  '$prgrm' && 
					 `semester` = '$semst' && 
					 `session` = '$sesn'";
	if($qqry = mysqli_query($logs,$sqry))
	{
		$nmrws = mysqli_num_rows($qqry);
	}

	if($compute_co == 0)
	{

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
					

					$resultssn = insert_result($logs, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
					mysqli_stmt_execute($resultssn);

					// save Carry Over scores
					
					if ($score>=0 and $score <=39){
						$co_spill = "co";
						$curent_sess  = (date("Y") - 1)."/".date("Y");

						$resultssn = insert_prev_result($logs, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn,$curent_sess,$co_spill);
								 	// insert_prev_result($logs, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn,$curent_sess,$co_spill)
					mysqli_stmt_execute($resultssn);
					}

					// chronicle 
					$lids = mysqli_insert_id($logs);
					$action = "INSERTED";
					include("dchronicle_res.php");
					// End of chronicles 
		
				}
				fclose($handle);
				echo "Successfully imported";
				// add to table entered courses
				insert_entered($logs, $code, $cunits, $prgrm, $semst, $sesn);
				
			}
			else
			{
				echo "Invalid file";
			}
		}// numrow----
		else
		{
			// Delete from table entered  and results to enable records overwrite
			mysqli_query($logs,"DELETE FROM `entered` WHERE
			`code`= '$code' && 
			`unit` = '$cunits' && 
			`prog_id` =  '$prgrm' && 
			`semester` = '$semst' && 
			`session` = '$sesn' ") or die(mysqli_error($logs).'hhn');
			// Delete from result table
			mysqli_query($logs,"DELETE FROM `results`  WHERE 
			`code`= '$code' && 
			`unit` = '$cunits' && 
			`prog_id` =  '$prgrm' && 
			`semester` = '$semst' && 
			`session` = '$sesn'") or die (mysqli_error($logs).'hh');

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

					$resultssn = insert_result($logs, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn);
					mysqli_stmt_execute($resultssn);

						// save Carry Over scores
						
					if ($score>=0 and $score <=39){
						$co_spill = "co";
						//insert_prev_result($con, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn,$co_spill);
						$resultssn = update_prev_result($logs,$score,$grade1,$point,$co_spill,$smatno,$code);
						mysqli_stmt_execute($resultssn);
					}

					// chronicle 
					$lids = mysqli_insert_id($logs);
					$action = "Overwrite";
					include("dchronicle_res.php");
					// End of chronicles

				}

				fclose($handle);
				echo "Successfully importednn";
				// add to table entered courses
				insert_entered($logs, $code, $cunits, $prgrm, $semst, $sesn);
	
			}
			else
			{
				echo "Invalid file";
			}
		}

	}elseif($compute_co ==1)
	{
		// update query 
		$curent_sess  = (date("Y") - 1)."/".date("Y");

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
				if($co_spill == 1){
					$co_spill = "co";
					$succeed = "CO Result";
				}elseif($co_spill == 0){
					$co_spill = "spo";
					$succeed = "SPO Result";
				}

				$resultssn = update_result($logs, $score,$grade1,$point,$curent_sess,$co_spill,$smatno,$code);
				mysqli_stmt_execute($resultssn);

				// save Spill Over scores
			if ($score>=0 and $score <=39){
				
				$resultssn = insert_prev_result($con, $snames,$smatno,$code,$cunits,$score,$grade1,$point,$prgrm,$semst,$sesn,$curent_sess,$co_spill);
				mysqli_stmt_execute($resultssn);
			}

			}

			fclose($handle);
			echo "Successfully Updated".@$succeed;

			}				

	}
}
?>
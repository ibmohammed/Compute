<br>
		<hr>
		<br>
        <i style ="color:red;">Select the course code and Choose file containing the scores to upload<?php //echo $_SESSION['id_staff'];?></i>
		<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
						
			<table class="table table-bordered">
				<tr>
				<td>Course Code:</td>
				<td>
				<select name="ccodes" class="form-control" id="exampleSelectGender">
				<option selected="selected" value="">Select Course</option>
					<?php 
					//$thestif =  $_SESSION['id_staff'];
					//$crsss = "SELECT * FROM `course` WHERE staff_id =  '$thestif'";	
					//$crsss = mysqli_query($logs, $crsss);
					while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{ 
						if($semsesprog == 0)
						{
							$_SESSION['semester']= @$rows['semester'];
							$_SESSION['sessions']= @$rows['sessions'];
							$_SESSION['prog_id'] = @$rows['prog_id'];

							

							$stmt = mysqli_prepare($logs, "SELECT * FROM `entered` 
							WHERE `code` = ? && `unit`=? && `prog_id`=? & `semester`=? && `session`=?") or die(mysqli_error($logs));

							//$stmtts = select_entered($logs, $thecode, $theunit, $theprogid, $thesemester, $thesession);
							$nrows = $crss = mysqli_stmt_get_result($stmt);
							mysqli_stmt_bind_param($stmt, "sisss", $thecode, $theunit, $theprogid, $thesemester, $thesession);
							$thecode = $rows['code'];
							$theunit = $rows['unit'];
							$theprogid = $rows['prog_id'];
							$thesemester = $rows['semester'];
							$thesession = $rows['sessions'];
							
						    mysqli_stmt_execute($stmt);
							mysqli_stmt_bind_result($stmt, $sn, $code, $unit, $prog_id, $semester, $session);
							mysqli_stmt_store_result($stmt);
							mysqli_stmt_fetch($stmt);



							if(mysqli_stmt_num_rows($stmt) == 0)
						{
							?>
							<option value="<?php echo $rows['code'];?>">
								<?php echo $rows['title']." (".$rows['code'].")";?>
							</option>
							<?php 
						}
						}
						else
						{
							$_SESSION['semester'] = $_POST['semester'];
							$_SESSION['sessions'] = $_POST['session'];
							$_SESSION['prog_id'] = $_POST['programme'];?>
							<option value="<?php echo $rows['code'];?>">
								<?php echo $rows['title']." (".$rows['code'].")";?>
							</option>
							<?php 
						}
						
					}?>
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
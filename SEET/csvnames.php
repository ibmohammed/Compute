<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    



<?php  
if(isset($_POST['Submit'])){

				$sesn = $_POST['session'];
				$sesn = preg_replace("/[^0-9\/]/", "", $sesn);
				$prgrm = $_POST['programme'];
				$prgrm = preg_replace("/[^0-9]/", "", $prgrm);
				
				$year=$_POST['year'];
				$year = preg_replace("/[^0-9]/", "", $year);


				$fname = $_FILES['csv']['name'];

				if ($prgrm =="" || $year == "" || $sesn == "") 
				{
					echo '<script type="text/javascript">
					alert("Empty fields not allowed!!!");
					location.replace("index.php?csvn");
					</script>';
					//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
				}
			
				echo 'upload file name: '. $fname. ' ';
				$chk_ext = explode(".",$fname);


			if(strtolower(end($chk_ext)) == "csv")
			{
						$filename = $_FILES['csv']['tmp_name'];
						$handle = fopen($filename, "r");
		
						while (($data = fgetcsv($handle,1000,",")) !== FALSE)
		
						{
							//$prgrm = mysql_escape_string($prgrm);
							$names = $data[0];
							$names = preg_replace("/[^a-zA-Z\s]/", "", $names);

							$matno = $data[1];
							$matno = preg_replace("/[^a-zA-Z0-9\s\/]/", "", $matno);
							//Check if data1 and data2 has the required contents 
							$is_this_a_matno = $matno;
							$is_this_thenames = $names;
							if (strpos( $is_this_a_matno, "/") !== false)
							{
								//$names = mysql_escape_string($names);
								$images = "";
								$status = 0;
								$stat = 0;
								$Withdrwan = 0;
								$sex = "";

								$imports = "INSERT INTO`studentsnm`  
										(`names`, `matno`, `prog_id`, `year`, `images`, `session`, `status`, `stat`, `Withdrwan`, `sex`) 
										VALUES( 
											'".addslashes($names)."',
											'".addslashes($matno)."',
											'".addslashes($prgrm)."',
											'".addslashes($year)."',
											'".addslashes($images)."',
											'".addslashes($sesn)."',
											'".addslashes($status)."',
											'".addslashes($stat)."',
											'".addslashes($Withdrwan)."',
											'".addslashes($sex)."'
						
										) ON DUPLICATE KEY UPDATE
											`names` = '".addslashes($names)."', 
											`matno` = '".addslashes($matno)."', 
											`prog_id` = '".addslashes($prgrm)."', 
											`year` = '".addslashes($year)."', 
											`session` = '".addslashes($sesn)."'
									";
									mysqli_query($conn,$imports) or die(mysqli_error($conn)); 
									$options = [
										'cost' => 11,
									];
									$pp = "Easy0123";
								$stat = "Enable";
								$hash = password_hash($pp, PASSWORD_BCRYPT,  $options);
								
								$students_log =	"INSERT INTO `students_log` 
								(`matric_no`,`password`,`status`) 
								VALUES('".addslashes($matno)."', '".addslashes($hash)."', '".addslashes($stat)."')";

								mysqli_query($conn, $students_log) or die(mysqli_error($conn)); 
							}
							else 
							{
								echo '<script type="text/javascript">
								alert("Please check the records you are uploading");
								location.replace("index.php?csvn");
								</script>';
							}
						}
					fclose($handle);
					echo "Successfully imported";
			}
		else
		{
			echo "Invalid file";
		}
}
?>
<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
    <table class="table table-bordered" >
		<tr>
          <td style="height: 30px" ><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
		  <td style="height: 30px" >
		  <select name="programme" id="programme" class="form-control">
   			<option selected="selected" value="">Select Programmes</option>
  			 <?php include('dptcode.php');
			$queri = prog_function($logs);
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
              
              <?php }?>
          </select> </td>
        </tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">SESSION:</span></td>
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
				<td><span style="font-weight: bold; color: #000000">YEAR:</span></td>
				<td>
		  <select name="year" id="year" class="form-control">
            <option selected="selected">Year</option>
			<?php
              for($i = 10; $i<=22; $i++)
              {
                echo "<option>".$i."</option>";
              }
              ?>
          </select></td>
		</tr>
		<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" class="btn btn-gradient-primary mr-2"/></td>
		</tr>
	</table>
	<br>
	<p><input class="btn btn-gradient-primary mr-2" name="Submit" type="submit" value="Submit"> </p>
	<br>
</form>
 <hr>

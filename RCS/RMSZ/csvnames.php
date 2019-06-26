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
								$pp = "Eeasy0123.";
							$stat = "Enable";
							$hash = password_hash($pp, PASSWORD_BCRYPT,  $options);
							
				$students_log =	"INSERT INTO `students_log` 
					(`matric_no`,`password`,`status`) 
					VALUES('".addslashes($matno)."', '".addslashes($hash)."', '".addslashes($stat)."')";

			mysqli_query($conn, $students_log) or die(mysqli_error($conn)); 
					          
		
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
         			
         			 <?php include('dptcode.php') ;
            
            
			//$qqry = "SELECT * FROM `dept` WHERE prog = '$departmentcode'";
			$queri = prog_function($logs);
			//$queri = mysqli_query($conn,$qqry) or die(mysqli_error());
            
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
			<option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
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

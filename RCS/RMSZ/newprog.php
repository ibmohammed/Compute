
<?php  
if(isset($_POST['Submit'])){


 error_reporting(-1);
 ini_set('display_errors', true); 
//connect to the database 
require('includes/header.php');  
// 

				$fname = $_FILES['csv']['name'];
			
				echo 'upload file name: '. $fname. ' ';
				$chk_ext = explode(".",$fname);


			if(strtolower(end($chk_ext)) == "csv")
	
			{

						$filename = $_FILES['csv']['tmp_name'];
						$handle = fopen($filename, "r");
		
						while (($data = fgetcsv($handle,1000,",")) !== FALSE)
		
						{
						
				$dep = $data[0];
				
		
				
				mysqli_query($conn,"INSERT INTO `departments` (`name`, `code`, `schl_id`)
				VALUES( 
                    '".addslashes($data[0])."',
					'".addslashes($data[1])."',
					'".addslashes($_POST['schl'])."'

                ) ON DUPLICATE KEY UPDATE
				   `name` = '".addslashes($data[0])."',
					`code` = '".addslashes($data[1])."',
					`schl_id` = '".addslashes($_POST['schl'])."' 

				   ") or die(mysqli_error()); 
            
       }

					fclose($handle);
					echo "Successfully imported";

			}

		else
		{
			echo "Invalid file";
		}
}

$schqry = mysqli_query($logs, "SELECT schl_id, school FROM `schools`") or die(mysqli_error($logs));
?>




<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table class="table table-bordered" >
		<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv"  class="btn btn-gradient-primary mr-2"/></td>
			</tr>
			<tr>
			<td>School</td>
			<td> 
				<select name="schl" class="form-control">
					<option selected = "selected" value="">Select School</option>
					<?php 
					while($rows = mysqli_fetch_assoc($schqry))
					{?>
						<option value="<?php echo $rows['schl_id'];?>"><?php echo $rows['school'];?></option>
						<?php 
					}?>
				</select>
			</td>

		</tr>
	</table>
	<br>
	<p><input name="Submit" type="submit" value="Submit"  class="btn btn-gradient-primary mr-2"/> </p>
	<br>
</form>
 <hr>




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
						//$prgrm = mysql_escape_string($prgrm);
			
		    	//$smatno = $data[1];
				$dep = $data[0];
				
		// check if students records exist 
				
				//$snms = mysqli_query($conn,"SELECT `names` FROM `dept` WHERE `dep` = '$dep'") or die(mysql_error());

				//$numrows = mysql_num_rows($snms);



				
				mysqli_query($conn,"INSERT INTO `dept` (`dep`)
				VALUES( 
                    '".addslashes($data[0])."'
                ) ON DUPLICATE KEY UPDATE
				   `dep` = '".addslashes($data[0])."' 

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
?>




<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table style="width: 60%">
		<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" /></td>
		</tr>
	</table>
	<input name="Submit" type="submit" value="Submit" /> 
</form>
 



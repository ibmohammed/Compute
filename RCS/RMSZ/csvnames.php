<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    



<?php  
if(isset($_POST['Submit'])){

				$sesn = $_POST['session'];
				$prgrm = $_POST['programme'];
				
				$year=$_POST['year'];



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
			
							//$names = mysql_escape_string($names);
						
							$imports = "INSERT INTO`studentsnm`  
									(`names`, `matno`, `dept`, `year`, `session`) 
									VALUES( 
					                    '".addslashes($names)."',
					                    '".addslashes($data[1])."',
					                    '".addslashes($prgrm)."',
					                    '".addslashes($year)."',
					                    '".addslashes($sesn)."'
					
									   ) ON DUPLICATE KEY UPDATE
									    `names` = '".addslashes($names)."', 
									    `matno` = '".addslashes($data[1])."', 
									    `dept` = '".addslashes($prgrm)."', 
									    `year` = '".addslashes($year)."', 
									    `session` = '".addslashes($sesn)."'
									    
								";
								mysqli_query($conn,$imports); 
					            
					          
		
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
          <td style="height: 30px" ><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
          <td style="height: 30px" ><select name="programme" id="programme">
         			<option selected="selected"></option>
         			
         			 <?php include('dptcode.php') ;
            
            
			$qqry = "SELECT * FROM `dept` WHERE prog = '$departmentcode'";
			$queri = mysqli_query($conn,$qqry) or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
          </select> </td>
        </tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">SESSION:</span></td>
			<td>  &nbsp;<select name="session">
          <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                    <?php echo include('includes/sessions.php');?>
				<option>2018/2019</option>
          </select><select name="year" id="year">
            <option selected="selected"></option>
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
			<td>  <input name="csv" type="file" id="csv" /></td>
		</tr>
	</table>
	<input name="Submit" type="submit" value="Submit"> 
</form>
 

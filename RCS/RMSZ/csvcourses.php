<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    



<?php  
if(isset($_POST['Submit'])){

				$sesn = $_POST['session'];
				$prgrm = $_POST['programme'];
				$semst = $_POST['semester'];
			//	$year=$_POST['year'];



				$fname = $_FILES['csv']['name'];
			
				echo 'upload file name: '. $fname. ' ';
				$chk_ext = explode(".",$fname);


			if(strtolower(end($chk_ext)) == "csv")
	
			{


$filename = $_FILES['csv']['tmp_name'];
						$handle = fopen($filename, "r");
		
						while (($data = fgetcsv($handle,1000,",")) !== FALSE)
		
						{
						        

$snm = mysqli_query($conn,"SELECT * FROM `course`
			WHERE 
			`Programme` =	'".addslashes($prgrm)."'&&
                `unit` =    '".addslashes($data[2])."'&&
                `semester` =   '".addslashes($semst)."'&&
                `code` =    '".addslashes($data[0])."'&&
				`sessions` =	'".addslashes($sesn)."'

			 ") or die(mysqli_error());
			  
			 if(mysqli_num_rows($snm)==0){
			 
		$snms = mysqli_query($conn,"INSERT INTO `course` 
		(`Programme`,`unit`,`semester`,`code`,`title`,`sessions`) 
				VALUES(
				'".addslashes($prgrm)."',
                '".addslashes($data[2])."',
                '".addslashes($semst)."',
                '".addslashes($data[0])."',
                '".addslashes($data[1])."',
				'".addslashes($sesn)."'
				)
			 ") or die(mysqli_error()); 
			 
			 }else{
			 
$snm = mysqli_query($conn,"UPDATE `course` SET

			`Programme` =	'".addslashes($prgrm)."',
                `unit` =    '".addslashes($data[2])."',
                `semester` =   '".addslashes($semst)."',
                `code` =    '".addslashes($data[0])."',
                `title` =    '".addslashes($data[1])."',
				`sessions` =	'".addslashes($sesn)."'
			WHERE 
			`Programme` =	'".addslashes($prgrm)."'&&
                `unit` =    '".addslashes($data[2])."'&&
                `semester` =   '".addslashes($semst)."'&&
                `code` =    '".addslashes($data[0])."'&&
				`sessions` =	'".addslashes($sesn)."'

			 ") or die(mysqli_error());
			 
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


    <table style="width: 60%">
		<tr>
          <td style="height: 30px" ><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
          <td style="height: 30px" ><select name="programme" id="programme">
         			<option selected="selected"></option>
         			
         			 <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
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

          </select></td>
		</tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">SEMESTER:</span></td>
			<td>  <select name="semester">
            <option selected="selected"></option>
			<option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
			<option value="4">Fourth Semester</option>
            <option value="5">Fift Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
		</tr>
		<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" /></td>
		</tr>
	</table>
	<input name="Submit" type="submit" value="Submit"> 
</form>
 
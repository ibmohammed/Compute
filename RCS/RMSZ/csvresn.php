<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    


<?php  
if(isset($_POST['Submit'])){



				$code = $_POST['ccodes'];
				$semst = $_POST['semester'];
				$sesn = $_POST['session'];
				$prgrm = $_POST['programme'];
				//$prgrm = mysql_escape_string($prgrm);
				
//get the course code Unit
			$unitt ="SELECT unit FROM `course`  WHERE 
	`code` = '$code' && `Programme`= '$prgrm' && `semester` = '$semst' && `sessions`= '$sesn'";
	$unt = mysqli_query($conn,$unitt)or die(mysqli_error());
				$unitss =mysqli_fetch_assoc($unt);
				
				$cunits = $unitss['unit'];
	// check if recordsexist			
	$sqry = "SELECT * FROM `entered` WHERE 
	`code` = '$code' && `programme`= '$prgrm' && `semester` = '$semst' && `session`= '$sesn'";
	$qqry = mysqli_query($conn,$sqry) or die(mysqli_error());
    $nmrws = mysqli_num_rows($qqry);
    
    
if($nmrws == 0){  

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
											
											$snmss = "SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'";
											$snms = mysqli_query($conn,$snmss);
											$stdnmr = mysqli_fetch_assoc($snms);
											$snames = $stdnmr['names'];
											
												//$snames = mysql_escape_string($snames);
												
											include("includes/scoregrade.php");
											
											//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
							
											$point = $n[$grade1];
											$emtq ="INSERT IGNORE INTO `results`  
											(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`programme`, `semester`, `session`) 
											VALUES( 
							                    '".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
							                    '".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
												'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
												'".addslashes($sesn)."'			
										
							                ) 
										";
										mysqli_query($conn,$emtq) or die(mysqli_error()); 
							            
				    					}
						
									fclose($handle);
									echo "Successfully imported";
									
							 $qsl = "INSERT INTO `entered` (`code`, `unit`, `programme`, `semester`, `session`)
							 VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')";
							 $qry = mysqli_query($conn,$qsl) or die(mysqli_error());
				   
				
							}
				
							else
							{
								echo "Invalid file";
							}
				
				

}// numrow----

else{

// Delete from table entered  and results to enable records overwrite

mysqli_query($conn,"DELETE FROM `entered` WHERE
     `code`= '$code' && 
     `unit` = '$cunits' && 
     `programme` = '$prgrm' && 
     `semester` = '$semst' && 
     `session` = '$sesn' ") or die(mysqli_error().'hhn');

mysqli_query($conn,"DELETE FROM `results`  WHERE 
`code`= '$code' && 
`unit` = '$cunits' &&
`programme` = '$prgrm' &&
`semester` = '$semst' &&
 `session` = '$sesn'") or die (mysqli_error().'hh');





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
											
											$snms = mysqli_query($conn,"SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'");
											$stdnmr = mysqli_fetch_assoc($snms);
											$snames = $stdnmr['names'];
											
												//$snames = mysql_escape_string($snames);
												
											include("includes/scoregrade.php");
											
											//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
							
											$point = $n[$grade1];
											mysqli_query($conn,"INSERT IGNORE INTO `results`  
											(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`programme`, `semester`, `session`) 
											VALUES( 
							                    '".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
							                    '".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
												'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
												'".addslashes($sesn)."'			
										
							                ) 
							            ") or die(mysqli_error()); 
							            
				    					}
						
									fclose($handle);
									echo "Successfully imported";
									
							 $qry = mysqli_query($conn,"INSERT INTO `entered` (`code`, `unit`, `programme`, `semester`, `session`)
				    	 	VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')") or die(mysqli_error());
				   
				
							}
				
							else
							{
								echo "Invalid file";
							}







}

    
}

else



//connect to the database 
//include('includes/header.php');// 


if(isset($_POST['Submitf'])){

$programme=$_POST['dept_id'];
$ncode=$_POST['code'];
$programme = mysqli_escape_string($conn,$programme);


$myqry = "SELECT * FROM entered WHERE code='GNS 101'
 && dept_id='$programme' && semester='1' && session='2017/2018'";
$chh = mysqli_query($conn, $myqry) or die(mysqli_error($conn));
//mysqli_num_rows()

/*$myqry = "SELECT * FROM entered WHERE code='".$_POST['code']."'
 && programme='".$_POST['programme']."' && semester='".$_POST['semester']."' && session='".$_POST['session']."'";
$chh = mysqli_query($conn, $myqry) or die(mysqli_error($conn));
//mysqli_num_rows()
*/
 if(mysqli_num_rows($chh) > 0)
 {
		// view result 
$rec = "SELECT * FROM `results` WHERE code='".$_POST['code']."'
 && dept_id='".$_POST['dept_id']."' && semester='".$_POST['semester']."' && session='".$_POST['session']."'";
$clue = mysqli_query($conn, $rec) or die(mysqli_error($conn));
?>
<!-- -->
<table>
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
	while ($value = mysqli_fetch_assoc($clue)){
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
	<?php }?>
</table>
<!--  -->
<?php 
//exit(); 
}
else
{





//	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];

$crss = mysqli_query($conn,"SELECT * FROM `course` WHERE 
`dept_id` = '$programme' && `semester` = '$semester' && `sessions` = '$session' ") 
or die(mysqli_error($conn));


// comfirm if record entered 

 
 
?>


<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table style="width: 100%">
		<tr>
			<td>Course Code:</td>
			<td>&nbsp;<select name="ccodes">
			<?php while($rows = mysqli_fetch_assoc($crss)){?>
			<option selected="selected"><?php echo $_POST['code'];?></option>
			<option><?php echo $rows['code'];?></option>
			<?php }?>
			</select></td>
		</tr>
		<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" /> </td>
		</tr>
	</table>

	<input name="programme" value="<?php echo $programme;?>" type="hidden"/>
	<input name="session" value="<?php echo $session;?>" type="hidden"/>
	<input name="semester" value="<?php echo $semester;?>" type="hidden"/>
	
	<input name="Submit" type="submit" value="Submit"> 
</form>
 
<?php
exit;
 }
 
  }
 
 else{

if (empty($_GET['csv'])) { 
?> 



<form action="" method="post" name="grade" id="grade">
      <table style="text-align: left;color:blue;">
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
          <td ><span style="font-weight: bold; color: #000000">SESSION:</span></td>
          <td ><select name="session">
          <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                    <?php echo include('includes/sessions.php');?>
			<option>2018/2019</option>
          </select>
         </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold; color: #000000">SEMESTER:</span></td>
          <td ><select name="semester">
            <option selected="selected"></option>
			<option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
			<option value="4">Fourth Semester</option>
            <option value="5">Fift Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
        </tr>
      </table>
      <input name="Submitf" value="Submit" type="submit" />
      <br />
    </form>

<?php

}
}
?>
<?php// require('includes/header.php');    ?>




<?php  
if(isset($_POST['Submit'])){



				$code = $_POST['ccodes'];
				$semst = $_POST['semester'];
				$sesn = $_POST['session'];
				$prgrm = $_POST['programme'];
				//$prgrm = mysql_escape_string($prgrm);
				
//get the course code Unit
			$unt = mysql_query("SELECT unit FROM `course`  WHERE 
	`code` = '$code' && `Programme`= '$prgrm' && `semester` = '$semst' && `sessions`= '$sesn'")or die(mysql_error());
				$unitss =mysql_fetch_array($unt);
				
				$cunits = $unitss['unit'];
	// check if recordsexist			
	$qqry = mysql_query("SELECT * FROM `entered` WHERE 
	`code` = '$code' && `programme`= '$prgrm' && `semester` = '$semst' && `session`= '$sesn'") or die(mysql_error());
    $nmrws = mysql_num_rows($qqry);
    
    
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
											
											$snms = mysql_query("SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'");
											$stdnmr = mysql_fetch_array($snms);
											$snames = $stdnmr['names'];
											
												//$snames = mysql_escape_string($snames);
												
											include("includes/scoregrade.php");
											
											//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
							
											$point = $n[$grade1];
											mysql_query("INSERT IGNORE INTO `consultdbsnw`.`results`  
											(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`programme`, `semester`, `session`) 
											VALUES( 
							                    '".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
							                    '".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
												'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
												'".addslashes($sesn)."'			
										
							                ) 
							            ") or die(mysql_error()); 
							            
				    					}
						
									fclose($handle);
									echo "Successfully imported";
									
							 $qry = mysql_query("INSERT INTO `consultdbsnw`.`entered` (`code`, `unit`, `programme`, `semester`, `session`)
				    	 	VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')") or die(mysql_error());
				   
				
							}
				
							else
							{
								echo "Invalid file";
							}
				
				

}// numrow----

else{

// Delete from table entered  and results to enable records overwrite

mysql_query("DELETE FROM `entered` WHERE
     `code`= '$code' && 
     `unit` = '$cunits' && 
     `programme` = '$prgrm' && 
     `semester` = '$semst' && 
     `session` = '$sesn' ") or die(mysql_error().'hhn');

mysql_query("DELETE FROM `results`  WHERE 
`code`= '$code' && 
`unit` = '$cunits' &&
`programme` = '$prgrm' &&
`semester` = '$semst' &&
 `session` = '$sesn'") or die (mysql_error().'hh');





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
											
											$snms = mysql_query("SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'");
											$stdnmr = mysql_fetch_array($snms);
											$snames = $stdnmr['names'];
											
												//$snames = mysql_escape_string($snames);
												
											include("includes/scoregrade.php");
											
											//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd
							
											$point = $n[$grade1];
											mysql_query("INSERT IGNORE INTO `consultdbsnw`.`results`  
											(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`programme`, `semester`, `session`) 
											VALUES( 
							                    '".addslashes($snames)."','".addslashes($data[0])."','".addslashes($code)."',
							                    '".addslashes($cunits)."','".addslashes($data[1])."','".addslashes($grade1)."',
												'".addslashes($point)."','".addslashes($prgrm)."','".addslashes($semst)."',	
												'".addslashes($sesn)."'			
										
							                ) 
							            ") or die(mysql_error()); 
							            
				    					}
						
									fclose($handle);
									echo "Successfully imported";
									
							 $qry = mysql_query("INSERT INTO `consultdbsnw`.`entered` (`code`, `unit`, `programme`, `semester`, `session`)
				    	 	VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')") or die(mysql_error());
				   
				
							}
				
							else
							{
								echo "Invalid file";
							}







}

    
}





//connect to the database 
$logsect = mysql_connect("localhost","root","");
mysql_select_db("consultdbsnw",$logsect); //select the table 
// 


if(isset($_POST['Submitf'])){

$programme=$_POST['programme'];
$programme = mysql_escape_string($programme);

//	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];

$crss = mysql_query("SELECT * FROM `course` WHERE 
`Programme` = '$programme' && `semester` = '$semester' && `sessions` = '$session' ") 
or die(mysql_error());
?>


<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table style="width: 100%">
		<tr>
			<td>Course Code:</td>
			<td>&nbsp;<select name="ccodes">
			<?php while($rows = mysql_fetch_array($crss)){?>
			
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
 
 
 
 

if (empty($_GET['csv'])) { 
?> 



<form action="" method="post" name="grade" id="grade">
      <table style="text-align: left;color:blue;">
        <tr>
          <td style="height: 30px" ><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
          <td style="height: 30px" ><select name="programme" id="programme">
         			<option selected="selected"></option>
         			
         			 <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
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

?>

<?php if (!empty($_GET['pass'])) { 
echo "<b>Your file has been imported.</b><br><br>"; 
} //generic success notice 
elseif (!empty($_GET['fail'])) {
echo "<b>This records cannot be enttered twice, please goto Edit Records.</b><br><br>"; 

$code = $_GET['code'];
$semst = $_GET['sem'];
$prgrm = $_GET['prog'];

$prgrm = mysql_escape_string($prgrm);

$sesn = $_GET['sessn'];
echo "<hr>";
echo "<p>Existing Records for ".$code." </p>";
echo "<hr>";
echo "<hr>";
echo "<br>";
$sql = mysql_query("SELECT * FROM `results` WHERE 
	`code` = '$code' && `programme`= '$prgrm' && `semester` = '$semst' && `session`= '$sesn' ") or die(mysql_error());
	
	echo "<table style='width: 100%'>";
	echo "<tr>		 <td>Name</td>		 <td>Matno</td>		 <td>Score</td>	 <td>Grade</td>		 <td>Points</td>	 </tr>";

while($rows = mysql_fetch_array($sql)){	 

echo "<tr><td>".$rows['name']."</td><td>".$rows['matric_no']."</td> <td>".$rows['score'];
echo "</td><td>".$rows['grade']."</td> <td>".$rows['points']."</td></tr>";
	 }
echo "</table>";

echo "<br>";
echo "<hr>";

}


?> 

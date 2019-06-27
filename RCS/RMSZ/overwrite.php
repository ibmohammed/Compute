<?php  
 require('includes/header.php');  
if(isset($_POST['Submit'])){

error_reporting(-1); 
ini_set('display_errors', true);
 require('includes/header.php');  



if ($_FILES['csv']['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
     
     			$code = $_POST['ccodes'];
				$semst = $_POST['semester'];
				$sesn = $_POST['session'];
				$prgrm = $_POST['programme'];
				$prgrm = mysqli_escape_string($conn,$prgrm);
				
//get the course code Unit
			$unt = mysqli_query($conn,"SELECT unit FROM `course`  
			WHERE `code` = '$code' && `Programme`= '$prgrm' && `semester` = '$semst' && `sessions`= '$sesn'")or die(mysqli_error());
				$unitss =mysqli_fetch_assoc($unt);
				
				$cunits = $unitss['unit'];
				
				
	// check if recordsexist			
	$qqry = mysqli_query($conn,"SELECT * FROM `entered` 
	WHERE `code` = '$code' && `programme`= '$prgrm' && `semester` = '$semst' && `session`= '$sesn'") or die(mysqli_error());
    $nmrws = mysqli_num_rows($qqry);



    
if($nmrws == 0){    


    //loop through the csv file and insert into database
    do { 
        if ($data[0]) { 
           
		    
			
				$score = $data[1];
				$smatno = $data[0];
				
		// get students names from table 
				
				$snms = mysqli_query($conn,"SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'");
				$stdnmr = mysqli_fetch_assoc($snms);
				$snames = $stdnmr['names'];
				
				$snames = mysqli_escape_string($conn,$snames);
				
				include("includes/scoregrade.php");
				
				//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd

				$point = $n[$grade1];
				mysqli_query($conn,"INSERT IGNORE INTO `results`  
				(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`programme`, `semester`, `session`) 
				VALUES( 
                    '".addslashes($snames)."',
                    '".addslashes($data[0])."',
                    '".addslashes($code)."',
                    '".addslashes($cunits)."',
                    '".addslashes($data[1])."',
					'".addslashes($grade1)."',
					'".addslashes($point)."',
					'".addslashes($prgrm)."',
					'".addslashes($semst)."',
					'".addslashes($sesn)."'

			
                ) 
            ") or die(mysqli_error()); 
            
          
// update or insert into resultbin


        
/*
-------------------------------This query will be useful in future   ---------------------------

  -------------------------------End of useful query --------------------------------
  */ 


 
        } 
        
        
    } while ($data = fgetcsv($handle,1000,",","'"));
    
    $qry = mysqli_query($conn,"INSERT INTO `entered` (`code`, `unit`, `programme`, `semester`, `session`)
        VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')") or die(mysqli_error());
    // 
  //echo $data[3];
    //redirect 
    
    
 echo $code."<b> has been imported.</b><br><br>"; 
// header('Location: index.php?csv'."&pass=1"); die;
 //echo "successful"; 

}else{

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




    //loop through the csv file and insert into database
    do { 
        if ($data[0]) { 
           
		    
			
				$score = $data[1];
				$smatno = $data[0];
				
		// get students names from table 
				
				$snms = mysqli_query($conn,"SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'");
				$stdnmr = mysqli_fetch_assoc($snms);
				$snames = $stdnmr['names'];
				
				$snames = mysqli_escape_string($conn,$snames);
				
				include("includes/scoregrade.php");
				
				//include("includes/scoregrade1.php"); THIS SCORE GRADE IS FOR pgd

				$point = $n[$grade1];
				mysqli_query($conn,"INSERT IGNORE INTO `results`  
				(`name`, `matric_no`, `code`, `unit`, `score`, `grade`, `points`,`programme`, `semester`, `session`) 
				VALUES( 
                    '".addslashes($snames)."',
                    '".addslashes($data[0])."',
                    '".addslashes($code)."',
                    '".addslashes($cunits)."',
                    '".addslashes($data[1])."',
					'".addslashes($grade1)."',
					'".addslashes($point)."',
					'".addslashes($prgrm)."',
					'".addslashes($semst)."',
					'".addslashes($sesn)."'

			
                ) 
            ") or die(mysqli_error()); 
            

 
        } 
        
        
    } while ($data = fgetcsv($handle,1000,",","'"));
    
    $qry = mysqli_query($conn,"INSERT INTO `entered` (`code`, `unit`, `programme`, `semester`, `session`)
        VALUES ('$code', '$cunits', '$prgrm', '$semst', '$sesn')") or die(mysqli_error());
    // 
  //echo $data[3];
    //redirect 
    
    
 echo $code. "<b> Updated.</b><br><br>"; 
// header('Location: index.php?csv'."&pass=1"); die;

} // end of loop 


// header('Location: index.php?csv'."&fail=1"."&code=".$code."&sem=".$semst."&prog=".$prgrm."&sessn=".$sesn); die; 


}
} 

//}


// ending ---------

//Begining --------

//connect to the database 

if(isset($_POST['Submitf'])){

$programme=$_POST['programme'];
$programme= mysqli_escape_string($conn,$programme);

//	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];

$crss = mysqli_query($conn,"SELECT * FROM `course` WHERE 
`Programme` = '$programme' && `semester` = '$semester' && `sessions` = '$session' ") 
or die(mysqli_error());
?>


<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table style="width: 100%">
		<tr>
			<td>Course Code:</td>
			<td>&nbsp;<select name="ccodes">
			<?php while($rows = mysqli_fetch_assoc($crss)){?>
			
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
      <table class="table table-bordered">
        <tr>
          <td>PROGRAMME:</span></td>
          <td>
                <select name="programme" class="form-control">
                <option selected="selected" value="">Select Programme</option>

                <?php include('dptcode.php');
                $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
                //	$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
                while($pcd = mysqli_fetch_assoc($queri)){
                ?>
                <option><?php echo $pcd['programme'];?></option>

                <?php }?>


                </select> 
          </td>
        </tr>
        <tr>
          <td><span style="font-weight: bold; color: #000000">SESSION:</span></td>
          <td>
            <select name="session"  class="form-control">
                <option selected="selected" value="">Select Session</option>
                <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                <?php echo include('includes/sessions.php');?>
            </select>
         </td>
        </tr>
        <tr>
          <td><span style="font-weight: bold; color: #000000">SEMESTER:</span></td>
          <td>
            <select name="semester"  class="form-control">
                <option selected="selected" value="">Select Semester</option>
                <option value="1">First Semester</option>
                <option value="2">Second Semester</option>
                <option value="3">Third Semester</option>
                <option value="4">Fourth Semester</option>
                <option value="5">Fift Semester</option>
                <option value="6">Sixth Semester</option>
            </select>

    </td>
        </tr>
      </table>
      <input name="Submitf" value="Submit" type="submit" class="btn btn-gradient-primary mr-2"/>
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

$prgrm = mysqli_escape_string($conn,$prgrm);

$sesn = $_GET['sessn'];
echo "<hr>";
echo "<p>Existing Records for ".$code." </p>";
echo "<hr>";
echo "<hr>";
echo "<br>";
$sql = mysqli_query($conn,"SELECT * FROM `results` 
WHERE `code` = '$code' && `programme`= '$prgrm' && `semester` = '$semst' && `session`= '$sesn' ") or die(mysqli_error());
	
	echo "<table style='width: 100%'>";
	echo "<tr>		 <td>Name</td>		 <td>Matno</td>		 <td>Score</td>	 <td>Grade</td>		 <td>Points</td>	 </tr>";

while($rows = mysqli_fetch_assoc($sql)){	 

echo "<tr><td>".$rows['name']."</td><td>".$rows['matric_no']."</td> <td>".$rows['score'];
echo "</td><td>".$rows['grade']."</td> <td>".$rows['points']."</td></tr>";
	 }
echo "</table>";

echo "<br>";
echo "<hr>";

}


?> 

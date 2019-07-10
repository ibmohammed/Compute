<?php
$conn =$logs;
if(isset($_POST['Submitf'])){

$programme=$_POST['programme'];

$programme = mysqli_escape_string($conn, $programme);


$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];

$crss = mysqli_query($conn, "SELECT * FROM `course` WHERE 
`prog_id` = '$programme' && `semester` = '$semester' && `sessions` = '$session' ") 
or die(mysqli_error($conn));
?>


<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table class="table table-bordered">
		<tr>
			<td>Course Code:</td>
			<td>
        <select name="code" class="form-control">
        <?php while($rows = mysqli_fetch_assoc($crss)){?>
        <option><?php echo $rows['code'];?></option>
			<?php }?>
			</select>
			<input name="semester" type="hidden" value="<?php echo $semester;?>">
			<input name="session" type="hidden" value="<?php echo $session;?>">
			<input name="programme" type="hidden" value="<?php echo $programme;?>">
			<input name="year" type="hidden" value="<?php echo $year;?>">

			</td>
      <td>
        <input name="Submit" type="submit" value="Delete" class="btn btn-gradient-primary mr-2"> 
      </td>
		</tr>
		</table>
</form>
 
<?php
exit;
 }
 


	if(isset($_POST['Submit'])){ 
	
	
$ccode=$_POST['code'];
$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$programme = mysqli_escape_string($conn, $programme);

$nsemester = ($semester - 1);

	echo "The scores for ". $ccode;
	echo " Semester: ".$semester.", <br/>" ;
	echo $session." Session, "."<br/>" ;
	echo "Class of ".$year.", <br/>" ;
	//echo $programme." programme"."<br/>" ;
	echo "  will be Deleted<br/>" ;?>
	
	<table class="table table-bordered" >
	<tr>
		<td>
			<?php echo "<a href = 'index.php?deleter' style='color:black; text-decoration:none;'><button class='btn btn-gradient-primary mr-2'>Cancel</button></a> ";?>
			
			<br/>
</td>
		<td>
		<form method="post" name="yes" id="yes" action="">
			<input name="semester" type="hidden" value="<?php echo $semester;?>">
			<input name="session" type="hidden" value="<?php echo $session;?>">
			<input name="programme" type="hidden" value="<?php echo $programme;?>">
			<input name="year" type="hidden" value="<?php echo $year;?>">
			<input name="code" type="hidden" value="<?php echo $ccode;?>">

			<br/>
			<input name="Submit2" value="Delete" type="submit" class="btn btn-gradient-primary mr-2"/>
		</form>
	 </td>
	</tr>
</table>


	
<?php 
exit();
}elseif(isset($_POST['Submit2']))
{ 
  $semester=$_POST['semester'];
  $session=$_POST['session'];
  $year=$_POST['year'];
  $programme=$_POST['programme'];

  $programme = mysqli_escape_string($conn, $programme);

  $nsemester = ($semester - 1);
  $ccode = $_POST['code'];
  $msql=mysqli_query($conn, "SELECT * FROM `studentsnm` WHERE 	
                    prog_id ='$programme' && year='$year'") 
                    or die(mysqli_error($conn));


  while ($col=mysqli_fetch_assoc($msql))
  {
    $matno = $col['matno'];

    $sqlsn= mysqli_query($conn, "SELECT sn  FROM `results` WHERE `matric_no` = '$matno'  && `code` ='$ccode' ") 
    or die ('Err'.mysqli_error($conn));
    
    $sqlsn = mysqli_fetch_assoc($sqlsn);
    $lastsn = $sqlsn['sn'];

    $sql= mysqli_query($conn, "DELETE FROM `results` WHERE `matric_no` = '$matno'  && `code` ='$ccode' ") 
    or die ('Err'.mysqli_error($conn));

    $sqls = mysqli_affected_rows($conn);
    
    if($sqls !== 0)
    {
      // Select Records entered to enable Delete 

      $qry = mysqli_query($conn, "SELECT * FROM `entered` WHERE 
                                  `code` = '$ccode' && `session` = '$session' && `semester` = '$semester'") 
                                  or die('selqry'.mysqli_error($conn));
      $fid = mysqli_fetch_assoc($qry);

      $eid = $fid['sn'];

      // Query to dalete Records Selected

      $delqry = mysqli_query($conn, "DELETE FROM `entered` WHERE `sn` = '$eid' LIMIT 1") or die('delqry'.mysqli_error($conn));

      echo "<div style='color:green; font-style:italic;'>";
      echo $matno." Scores Deleted Successfully<br/>";

      // Update Student Status 
      $query = mysqli_query($conn, "UPDATE  `studentsnm` SET status = '$nsemester' 
      WHERE matno='$matno'") 
      or die(mysqli_error($conn));

      if ($query)
      {
        echo $matno." Data Updated Successfully<br/>";
        echo "</div>";
      }

            // chronicle 
      $lids = $lastsn;
      $action = "DELETED";
      include("dchronicle_res.php");
      // End of chronicles 



    }else
    {
      echo "records not deleted for ". $matno."<br/>";
    }
  } 

}
?>

</p>


<form action="" method="post" name="grade" id="grade">
      <div class="auto-style1">
      <table class="table table-bordered">
        <tr>
          <td><strong>PROGRAMME:</strong></td>
          <td>
            <select name="programme" id="programme" class="form-control">
              <option selected="selected" value="">Select Programme</option>
              <?php include('dptcode.php') ;
              //$queri = mysql_query("SELECT * FROM `dept` WHERE 
              //prog = '$departmentcode'  && `dep` LIKE '%National Diploma%'") or die(mysqli_error($conn));
              $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
              //	$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
              while($pcd = mysqli_fetch_assoc($queri)){
              ?>
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>

              <?php }?>
            </select>
          
          </td>
        </tr>
        <tr>
          <td><strong>SEMESTER:</strong></td>
          <td>
          <select name="semester" class="form-control">
            <option selected="selected" value="">Select Semester</option>
            <option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
            <option value="4">Fourth Semester</option>
            <option value="5">Fifth Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
        </tr>
        <tr>
          <td ><strong>SESSION:</strong></td>
          <td>
          <select name="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
            <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
            <?php echo include('includes/sessions.php');?>
          </select>
            -
            <select name="year" id="year" class="form-control">
              <option selected="selected" value="">Select Year</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
              <option>13</option>
              <option>14</option>
              <option>15</option>
              <option>16</option> 
              <?php
              for($i = 17; $i<=20; $i++)
              {
                echo "<option>".$i."</option>";
              }
              ?>
            </select>
            <input  type="hidden" name="start" value="0" />
          <input type="hidden" name="list" value="20" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
          </table>
      <input name="Submitf" value="Submit" type="submit" class="btn btn-gradient-primary mr-2"/>

  </div>

  </form>

</body>

</html>
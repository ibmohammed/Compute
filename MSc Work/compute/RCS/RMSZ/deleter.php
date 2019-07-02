
<head>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
</style>
</head>

<?php include("includes/header.php"); ?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>

<p>
<center>

<?php

if(isset($_POST['Submitf'])){

$programme=$_POST['programme'];

$programme = mysql_escape_string($programme);


$year=$_POST['year'];
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
			<td>&nbsp;<select name="code">
			<?php while($rows = mysql_fetch_array($crss)){?>
			
			<option><?php echo $rows['code'];?></option>
			<?php }?>
			</select>
			<input name="semester" type="hidden" value="<?php echo $semester;?>">
			<input name="session" type="hidden" value="<?php echo $session;?>">
			<input name="programme" type="hidden" value="<?php echo $programme;?>">
			<input name="year" type="hidden" value="<?php echo $year;?>">

			</td>
		</tr>
		</table>

	<!--
	<input name="programme" value="<?php echo $programme;?>" type="hidden"/>
	<input name="session" value="<?php echo $session;?>" type="hidden"/>
	<input name="semester" value="<?php echo $semester;?>" type="hidden"/>
	<input name="year" value="<?php echo $year;?>" type="hidden"/>
	-->
	<input name="Submit" type="submit" value="Delete"> 
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
$programme = mysql_escape_string($programme);

$nsemester = ($semester - 1);

	echo $ccode;
	echo "Semester: ".$semester.", <br/>" ;
	echo $session." Session, "."<br/>" ;
	echo "Class of ".$year.", <br/>" ;
	echo $programme." programme"."<br/>" ;
	echo " Scores will be Deleted<br/>" ;?>
	
	<table style="width: " >
	<tr>
		<td>
			<?php echo "<a href = 'index.php?deleter' style='color:black; text-decoration:none;'><button >Cancel</button></a> ";?>
			
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
			<input name="Submit2" value="OK" type="submit" />
		</form>
	 </td>
	</tr>
</table>

</center>

	
<?php 
exit();
}elseif(isset($_POST['Submit2'])){ 

$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];

$programme = mysql_escape_string($programme);

$nsemester = ($semester - 1);
$ccode = $_POST['code'];




		$msql=mysql_query("SELECT * FROM `studentsnm` WHERE 	
		dept ='$programme' && year='$year'") 
		or die(mysql_error());


while ($col=mysql_fetch_array($msql)){


		$matno = $col['matno'];
		
		
		$sql= mysql_query("DELETE FROM `results` WHERE `matric_no` = '$matno'  && `code` ='$ccode' ") 
		or die ('Err'.mysql_error());


$sqls = mysql_affected_rows();
		

if($sqls !== 0){

// Select Records entered to enable Delete 

$qry = mysql_query("SELECT * FROM `entered` WHERE 
`code` = '$ccode' && `session` = '$session' && `semester` = '$semester'") 
or die('selqry'.mysql_error());

 
$fid = mysql_fetch_array($qry);

$eid = $fid['sn'];

// Query to dalete Records Selected

$delqry = mysql_query("DELETE FROM `entered` WHERE `sn` = '$eid' LIMIT 1") or die('delqry'.mysql_error());


echo "<div style='color:green; font-style:italic;'>";
echo $matno." Scores Deleted Successfully<br/>";

// Update Student Status 
$query = mysql_query("UPDATE  `studentsnm` SET status = '$nsemester' 
WHERE matno='$matno'") 
or die(mysql_error());

if ($query){
 
 echo $matno." Data Updated Successfully<br/>";
 echo "</div>";
 }


}else{

echo "records not deleted for ". $matno."<br/>";

}



} 



}
?>

</p>


<form action="" method="post" name="grade" id="grade">
      <div class="auto-style1">
      <table align="center">
        <tr>
          <td align="left"><strong>PROGRAMME:</strong></td>
          <td align="left"><select name="programme" id="programme">
            <option selected="selected"><?php // echo $_GET['depts'];?></option>
			
			
			
			 <?php include('dptcode.php') ;
            
            
            //$queri = mysql_query("SELECT * FROM `dept` WHERE 
            //prog = '$departmentcode'  && `dep` LIKE '%National Diploma%'") or die(mysql_error());
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE 
            prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
                        
          </select>
          
          </td>
        </tr>
        <tr>
          <td align="left"><strong>SEMESTER:</strong></td>
          <td align="left"><select name="semester">
            <option selected="selected"></option>
            <option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
            <option value="4">Fourth Semester</option>
            <option value="5">Fifth Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
        </tr>
        <tr>
          <td align="left"><strong>SESSION:</strong></td>
          <td align="left"><select name="session">
          <option selected="selected"></option>
          <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
                     <?php echo include('includes/sessions.php');?>

            </select>
            -
            <select name="year" id="year">
              <option selected="selected" ></option>
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
            </select>
            <input  type="hidden" name="start" value="0" />
          <input type="hidden" name="list" value="20" /></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
          </table>
      <input name="Submitf" value="Submit" type="submit" />

  </div>

  </form>

</body>

</html>
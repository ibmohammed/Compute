<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require("includes/header.php");?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 {color: #000000}
.style6 {color: #000000; font-weight: bold; }
.style8 {color: #FF0000}
.style9 {font-weight: bold}
.style10 {color: #000066;
	font-weight: bold;
	font-size: x-large;
}
.style19 {font-size: 10; font-weight: bold; }
.style21 {font-size: 12px;
	font-weight: bold;
}
.style22 {	color: #000066;
	font-weight: bold;
	font-size: 18px;
}
-->
</style>
</head>

<body>
<table width="70%" border="0" align="center"  background="images/bckscript1.png">
  <tr>
    <td>
	  <div align="center">
	    <?php if(isset($_POST['Submit2'])){
	$mat = $_POST['rmtn'];
	 $course = $_POST['courseid'];
?>
	    <?php
$mtr = mysqli_query($conn,"SELECT * FROM results WHERE matric_no LIKE '$mat'   AND semester = 1",$db);
$mn = mysqli_fetch_assoc($mtr);
?>
	    <table border="0" align="center">
          <tr>
            <td align="center"><img src="logo.gif" width="119" height="83" /></td>
            <td align="center"><span class="style10"> NIGER STATE POLYTECHNIC ZUNGERU </span><br />
              (Office of the Registrar) <br />
              <span class="style8">TRANSCRIPT OF ACADEMIC RECORDS </span></td>
          </tr>
        </table>
	    <table align="center">
          <tr align="left">
            <td id="page"><span style="color: #1F497D"><strong>Name of Students: </strong></span></td>
            <td id="page2"><span class="style19"><?php echo $mn['name'];?></span></td>
            <td id="page2">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" id="page"><span style="color: #1F497D"><strong>Registration Number :</strong></span> </td>
            <td align="left" id="page2"><span class="style19"><?php echo $mn['matric_no'] ;?></span></td>
            <td align="left" id="page2">&nbsp;</td>
          </tr>
          <tr align="left">
            <td id="page"><span style="color: #1F497D"><strong>Department:</strong></span></td>
            <td id="page2">&nbsp;</td>
            <td id="page2">&nbsp;</td>
          </tr>
          <tr align="left">
            <td id="page"><span style="color: #1F497D"><strong>Course of Study :</strong></span></td>
            <td id="page2"><span class="style19"><?php echo $mn['programme'];?></span></td>
            <td id="page2">&nbsp;</td>
          </tr>
          <tr align="left">
            <td id="page"><span style="color: #1F497D"><strong>Duration of Course:</strong></span></td>
            <td id="page2"><span class="style19">One (1) Year </span></td>
            <td id="page2"><span class="style21">DATE:<?php echo date('d/m/Y');?></span></td>
          </tr>
        </table>
<hr/>	   
	  <table align="center">
      <tr>
        <td align="left" class="style9" id="page2"><span class="style3"><strong>SEMESTER:</strong></span></td>
        <td align="left" class="style8" id="page1"><span style="color: #FF0000"><strong><?php echo "First"." "."Semester" ;?></strong></span></td>
        <td align="left" class="style9" id="page"><strong><span style="color: #000000">SESSION</span>: </strong></td>
        <td align="left" class="style9" id="page2"><span class="style6"><span style="color: #FF0000"><?php echo $mn['session'] ;?></span></td>
      </tr>
    </table>
    <span style="font-weight: bold; color: #FFFFFE; font-size: x-small">
    <table border="1" align="center" bordercolor="#1F497D" background="images/ZUNGERU LOGO.GIF">
      <tr>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Codes</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big> Course Names</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Units</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Marks</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Grageds</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Points</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Weighted Points</big> </strong></span></td>
      </tr>
      <?php
	 $msq = mysqli_query($conn,"SELECT *  FROM course WHERE programme LIKE '$course' AND semester = 1",$db);
	  $msql = mysqli_query($conn,"SELECT * FROM results WHERE matric_no LIKE '$mat'   AND semester = 1",$db);

	  while (($row= mysqli_fetch_assoc($msq)) && ($col= mysqli_fetch_assoc($msql))){?>
      <tr>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['code'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['title'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['unit'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['score']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['grade']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']*$col['unit']; ;?></strong></span></td>
      </tr>
      <?php }?>
    </table>
    <table border="1" align="center" bordercolor="#000000">
      <tr>
        <td id="page1"><span class="style6">T C U &nbsp;</span></td>
        <td id="page1"><span class="style6">T <strong>W P </strong></span></td>
        <td id="page1"><span class="style6">GPA</span></td>
        <td id="page1"><span class="style6">CGPA&nbsp;</span></td>
      </tr>
      <?php 
		$session = $mn['session'];
		$semester = 1;
		$sql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$course' && semester='1' && matric_no='$mat'");
		
	if(!$sql){
	die (mysqli_error());
	}
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sql)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		$gpa = number_format(($gp/$unit),2);
		include("includes/cpgpa.php");
		
		?>
      <tr>
        <td id="page2"><span class="style3"><?php echo $unit;?></span> </td>
        <td id="page2"><span class="style3"><?php echo $gp ;?></span></td>
        <td id="page2"><span class="style3"><?php echo $gpa ;?></span></td>
        <td id="page2"><span class="style3"><?php echo $ccgpa;?></span></td>
      </tr>
    </table>
<hr/>   

	<table align="center">
      <tr>     
	          <td align="left" class="style9" id="page2"><span class="style3"><strong>SEMESTER:</strong></span></td>
        <td align="left" class="style8" id="page1"><span style="color: #FF0000"><strong><?php echo "Second"." "."Semester" ;?></strong></span></td>
        <td align="left" class="style9" id="page"><strong><span style="color: #000000">SESSION</span>: </strong></td>
        <td align="left" class="style9" id="page2"><span class="style6"><span style="color: #FF0000"><?php echo $mn['session'] ;?></span></td>
      </tr>
    </table>
	<span style="font-weight: bold; color: #FFFFFE; font-size: x-small">
	<table border="1" align="center" bordercolor="#1F497D" background="images/ZUNGERU LOGO.GIF">
      <tr>
        <td height="21" id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Codes</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big> Course Names</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Units</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Marks</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Grageds</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Points</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Weighted Points</big> </strong></span></td>
      </tr>
      <?php
	 $msq = mysqli_query($conn,"SELECT *  FROM course WHERE programme LIKE '$course' AND semester = 2",$db);
	  $msql = mysqli_query($conn,"SELECT * FROM results WHERE matric_no LIKE '$mat'   AND semester = 2",$db);

	  while (($row= mysqli_fetch_assoc($msq)) && ($col= mysqli_fetch_assoc($msql))){?>
      <tr>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['code'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['title'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['unit'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['score']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['grade']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']*$col['unit']; ;?></strong></span></td>
      </tr>
      <?php }?>
    </table>
	<table border="1" align="center" bordercolor="#000000">
      <tr>
        <td id="page1"><span class="style6">T C U &nbsp;</span></td>
        <td id="page1"><span class="style6">T <strong>W P </strong></span></td>
        <td id="page1"><span class="style6">GPA</span></td>
        <td id="page1"><span class="style6">CGPA&nbsp;</span></td>
      </tr>
      <?php 
		$session = $mn['session'];
		$programme = $course;
		$semester = 2;
		$matno = $mat;
		$sql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$course' && semester='2' && matric_no='$mat'");
		
	if(!$sql){
	die (mysqli_error());
	}
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sql)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		$gpa = number_format(($gp/$unit),2);
		include("includes/cpgpa.php");
		
		?>
      <tr>
        <td id="page2"><span class="style3"><?php echo $unit;?></span> </td>
        <td id="page2"><span class="style3"><?php echo $gp ;?></span></td>
        <td id="page2"><span class="style3"><?php echo $gpa ;?></span></td>
        <td id="page2"><span class="style3"><?php echo $ccgpa;?></span></td>
      </tr>
    </table>
<hr/>  

    <table align="center">
      <tr>
        <td align="left" class="style9" id="page2"><span class="style3"><strong>SEMESTER:</strong></span></td>
        <td align="left" class="style8" id="page1"><span style="color: #FF0000"><strong><?php echo "Third"." "."Semester" ;?></strong></span></td>
        <td align="left" class="style9" id="page"><strong><span style="color: #000000">SESSION</span>: </strong></td>
        <td align="left" class="style9" id="page2"><span class="style6"><span style="color: #FF0000"><?php echo $mn['session'] ;?></span></td>
      </tr>
    </table>
    <span style="font-weight: bold; color: #FFFFFE; font-size: x-small">
    <table border="1" align="center" bordercolor="#1F497D" background="images/ZUNGERU LOGO.GIF">
      <tr>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Codes</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big> Coourse Names</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Units</big></strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Marks</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Grageds</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Points</big> </strong></span></td>
        <td id="page1"><span style="color: #000000; font-size: 10px"><strong><big>Weighted Points</big> </strong></span></td>
      </tr>
      <?php
	 $msq = mysqli_query($conn,"SELECT *  FROM course WHERE programme LIKE '$course' AND semester = 3",$db);
	  $msql = mysqli_query($conn,"SELECT * FROM results WHERE matric_no LIKE '$mat'   AND semester = 3",$db);

	  while (($row= mysqli_fetch_assoc($msq)) && ($col= mysqli_fetch_assoc($msql))){?>
      <tr>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['code'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><?php echo $row['title'];?></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['unit'];?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['score']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['grade']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']; ;?></strong></span></td>
        <td id="page2"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']*$col['unit']; ;?></strong></span></td>
      </tr>
      <?php }?>
    </table>
    <table border="1" align="center" bordercolor="#000000">
      <tr>
        <td id="page1"><span class="style6">T C U &nbsp;</span></td>
        <td id="page1"><span class="style6">T <strong>W P </strong></span></td>
        <td id="page1"><span class="style6">GPA</span></td>
        <td id="page1"><span class="style6">CGPA&nbsp;</span></td>
      </tr>
      <?php 
		$session = $mn['session'];
		$programme = $course;
		$semester = 3;
		$matno = $mat;
		$sql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$course' && semester='3' && matric_no='$mat'");
		
	if(!$sql){
	die (mysqli_error());
	}
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sql)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		$gpa = number_format(($gp/$unit),2);
		include("includes/cpgpa.php");
		
		?>
      <tr>
        <td id="page2"><span class="style3"><?php echo $unit;?></span> </td>
        <td id="page2"><span class="style3"><?php echo $gp ;?></span></td>
        <td id="page2"><span class="style3"><?php echo $gpa ;?></span></td>
        <td id="page2"><span class="style3"><?php echo $ccgpa;?></span></td>
      </tr>
    </table>
    <div align="right"><span class="style22">Final Remarks:
      <?php 
		$matno = $mat;
		$mysql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$programme' &&  matric_no='$matno'");
		
	if(!$mysql){
	die (mysqli_error());
	}
		//$unit=0;
		//$gp=0;
		$rem = 0;
		while ($result=mysqli_fetch_assoc($mysql)){ 
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")){
		$rem = $rem +1;
		}
		}
		  if ($semester <=2){
		if($rem>=1){
	echo "Yet To be cleared";
	}elseif($rem<1){
	echo "PASS";
	}
	
	}elseif($semester==3){
	
		if($rem>=1){
	echo "";
	}elseif($rem<1){
	include("includes/remks.php");
	echo $remarks;
	}
	
	} 

	?>
    </span> </div>
<hr/>  

    <table width="247" border="0" align="right" bgcolor="#FFFFFF">
      <tr>
        <td><div align="center">
            <p>&nbsp;</p>
          <p class="style3"><strong>&nbsp;.............................................<br />
            Academic Affairs Officer<br />
            &nbsp;For&nbsp;Registrar</strong></p>
        </div></td>
      </tr>
    </table>
    <?php
		exit;
		}elseif (isset($_POST['Submit'])){
$prog = $_POST['courseid'];
$sess = $_POST['year'];
//$progid = $_POST['code'];
$sql = mysqli_query($conn,"SELECT* FROM`studentsnm` WHERE `dept`='$prog' && year = '$sess'");
?></td>
</tr></table> 
<table width="80%" align="center">
	<tr><td>
<form action="transcripsphnd.php" method="POST" name="grade" id="grade" target="_blank">
      <h3 align="left">Print Transcript</h3>
    <table>
<tr>
<td align="left">PROGRAMME:</td>
<td align="left"><select name="courseid">
<option><?php echo $_POST['courseid'];?></option>
<?php include("includes/optionssp.php"); ?></select></td>  
</tr>


<tr>
<td align="left">MATRIC NUMBER</td>
<td align="left"><select name="rmtn" id="rmtn">
  <?php while ($row=mysqli_fetch_assoc($sql)){?>
  <option><?php echo $row['matno']; ?></option>
  <?php }?>
</select>
  <input name="textfield"  value="<?php 
  $sql = mysqli_query($conn,"SELECT* FROM`studentsnm` WHERE `dept`='$prog' && year = '$sess'");
  $row1 =mysqli_fetch_assoc($sql);
  echo $row1['matno']; ?>" size="3" maxlength="3"   type="hidden"/>
  </td>
</tr>
</table>

     <input name="Submit2" type="submit" id="Submit2" value="Submit">
</form><?php exit; 
	}?> </table>
	</td></tr>
	 <table width="80%" align="center">
	<tr><td>
	
	<table width="80%" border="0">
      <tr>
        <td><form action="" method="POST" name="grade1" id="grade">
          <h3 align="left">Print Transcript</h3>
          <table>
            <tr>
              <td align="left">PROGRAMME:</td>
              <td align="left"><select name="courseid">
                 <option selected="selected"></option>


 <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode' && `dep` LIKE '%Pre-HND%'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option ><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
                
              </select></td>
            </tr>
            <tr>
              <td align="left">SESSION:</td>
              <td align="left"><select name="year" id="year">
                <option>------</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>20</option>
              </select></td>
            </tr>
          </table>
          <input name="Submit" value="Submit" type="submit" />
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
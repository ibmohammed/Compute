<?php require('includes/header.php');    ?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	color: #0033FF;
}
a:hover {
	color: #0066FF;
}
.style5 {font-size: small}
.style6 {font-size: x-small; }
.style7 {color: #CCCCCC}
#page span {
	font-family: "Comic Sans MS", cursive;
}
-->
</style>
</head>

<body>

  <?php
  if(isset($_GET['Submit'])){ 

$smtr=$_GET['semester'];
$year=$_GET['year'];
$ses=$_GET['session'];
$programme = $_GET['courseid'];


$sqlm = mysql_query("SELECT * FROM `course` WHERE Programme = '$programme' and
semester = '$smtr' && sessions  = '$ses'") or die(mysql_error()); 
echo "<h2> Semester:  ".$smtr."</h2>";?>


  <table width="90%">
  <tr>
    <td>SN</td>
    <td>Corse Code</td>
    <td>Course Title</td>
  </tr>
  <?php $sn = 0; while($rowss = mysql_fetch_array($sqlm)){ $sn = $sn +1;?>
  <tr>
    <td><?php echo $sn;?></td>
    <td><a href="javascript:void(0);" name="Chind window" title="child title" onclick='window.open("attend.php?semester=<?php echo $smtr."& year=".$year."& session=".$ses."& courseid=".$programme."& ccode=".$rowss['code']."& ctitle=".$rowss['title'];?>","Rating","width = 1000, height = 600,0,status = 1,")';><?php echo $rowss['code'];?></a></td>
    <td><?php echo $rowss['title'];?></td>
  </tr><?php }?>
</table>

  
 <?php
 
 

// session


//$_SESSION['semester'] = $smtr;
//$_SESSION['year'] = $year;
//$_SESSION['session'] = $ses;
//$_SESSION['courseid'] = $cid;
//$_SESSION['ccode'] = $ccode;
//$_SESSION['ctitle'] = $ctitle;



  }?>
  <form action="scoresheet.php" method="get" name="grade" id="grade" target="_blank">
    <table width="70%" align="center">
      <tr>
        <td width="13%" bgcolor="#F0F0F0"><strong>PROGRAMME:</strong></td>
        <td width="87%" bgcolor="#F0F0F0"><select name="courseid">
            <option selected="selected">Select Programme</option>
             <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
          </select>        </td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0"><strong>SEMESTER:</strong></td>
        <td bgcolor="#F0F0F0"><select name="semester">
            <option>Select Semester</option>
            <option value="1">First Semester</option>
            <option value="2">Second semester</option>
            <option value="3">Third Semseter</option>
            <option value="4">Fourth Semeter</option>
			<option value="5">Fifth Semeter</option>
			<option value="6">Sixth Semeter</option>
            
        </select></td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0"><strong>SESSION:</strong></td>
        <td bgcolor="#F0F0F0">
          <select name="session" id="session">
           <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
                    <?php echo include('includes/sessions.php');?>
          </select>
          
          -
          <select name="year" id="year">
            <option>------</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            
          </select></td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0">&nbsp;</td>
        <td align="left" bgcolor="#F0F0F0"><input name="Submit" value="Submit" type="submit" /></td>
      </tr>
    </table>
</form>
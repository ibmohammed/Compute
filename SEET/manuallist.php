<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require('includes/header.php');    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="icon" href="images/nipoly2 (1).GIF" type="image/x-jpg"/>

<title>Manual List</title>
</head>

<body>

  <?php
  if(isset($_GET['Submit'])){
$smtr=$_GET['semester'];
$year=$_GET['year'];
$ses=$_GET['session'];
$cid=$_GET['courseid'];

$all= mysqli_query($conn,"SELECT * FROM studentsnm WHERE dept = '$cid' && year ='$year' ORDER BY matno ASC");
    if (!$all){
        die(mysqli_error()."Records not found");
        exit;
    }
  $header = mysqli_query($conn,"SELECT * FROM course WHERE programme = '$cid' && semester = '$smtr' && sessions = '$ses'");
      $head = mysqli_fetch_assoc($header);

    if (!$header){
        die("Query Selection failed");
        exit;
    }
    
    switch ( $head['semester']) {
        case "1":
            $first = "st";
            $s = "1";
            break;

        case "2":
            $first = "nd";
            $s = "2";
            break;

        case "3":
            $first = "rd";
            $s = "3";

            break;
			case "4":
            $first = "th";
            $s = "4";
            break;

        case "5":
            $first = "th";
            $s = "5";
            break;

        case "6":
            $first = "th";
            $s = "6";

            break;
    }
    ?>
  <table  align='center'>
    <tr>
      <td style="font-weight: bold; color: #000000">Score Sheet For <?php echo  $head['Programme'];?></td>
    </tr>
  </table>
  <table  align='center'>
    <tr >
      <td align="center" style="font-weight: bold; color: #000000"><?php echo $s.$first;?> 
	  SEMESTER <?php echo " ".$ses;?><br />
      </td>
    </tr>
  </table>
  <table border="1" align="center" cellpadding="1" cellspacing="1"  style="font-size:12px; width: auto; height:70px; border:thin; border-collapse:collapse">
    <tr >
      <td style="height: 17px" ><strong>S/N</strong></td>
      <td  style="widths: 150px; height: 17px;" ><strong>MATRIC No.</strong></td>
      <td width="250"  style="height: 17px" ><strong>NAMES</strong></td>
	  <?php 
	  $code = mysqli_query($conn,"SELECT * FROM `course` WHERE programme LIKE '$cid' AND semester = '$smtr' && sessions = '$ses'");
	  if(!$code){
	  die ("Query Selection failed".mysqli_error());
	  }
	 
	  ?>
    <?php while( $col = mysqli_fetch_assoc($code)){?>
	  <td style="height: 17px"><strong><?php echo $col['code']?>
	  </strong></td>
	  <?php }?>
    </tr>
    <?php  
	$n = 0;
	while ($res= mysqli_fetch_assoc($all)){
	$n= $n +1;
	?>
    <tr >
      <td ><span >
        <?php  echo $n;?>
      </span></td>
      <td ><span ><?php echo $res['matno'];?></span></td>
      <td width="250" ><span >
        <?php  echo $res['names'];?>
      </span></td>
      <?php 
	   $codes = mysqli_query($conn,"SELECT * FROM `course` WHERE programme = '$cid' AND semester = '$smtr' && sessions = '$ses'");
	  if(!$codes){
	  die ("Query Selection failed".mysqli_error());
	  }
	  while( $cols = mysqli_fetch_assoc($codes)){?><td ><span ></span> </td>
      <?php }?>
    </tr>
    <?php      }?>
</table>

  <?php
  exit; }?>
  <form action="manuallist.php" method="get" name="grade" id="grade" target="_blank">
    <table width="70%" align="center">
      <tr>
        <td width="13%" ><strong>PROGRAMME:</strong></td>
        <td width="87%" ><select name="courseid">
          <option selected="selected">Select Programme</option>
            
             <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
            
            
            <?php
			//include('prog1.php');
			//include('prog2.php');
			//include('prog3.php');
			 ?>
          </select>        </td>
      </tr>
      <tr>
        <td ><strong>SEMESTER:</strong></td>
        <td ><select name="semester">
            <option>Select Semester</option>
            <option value="1">First Semester</option>
            <option value="2">Second semester</option>
            <option value="3">Third Semseter</option>
            <option value="4">Fourth Semeter</option>
            <option value="5">Fifth Semester</option>
            <option value="6">Sixth Smester</option>
        </select></td>
      </tr>
      <tr>
        <td ><strong>SESSION:</strong></td>
        <td >
          <select name="session" id="session">
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
            <option>19</option>
            <option>20</option>
          </select></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td align="left" ><input name="Submit" value="Submit" type="submit" /></td>
      </tr>
    </table>
</form>
  


<head>
<style type="text/css">
.auto-style1 {
	direction: ltr;
}
</style>
</head>
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>        
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "logins.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="icon" href="images/nipoly2 (1).GIF" type="image/x-jpg"/>

<title>Result Sheet</title>
</head>

<body>

  <table width="80%" align="center" >
    <tr >
      <td valign="top"><?php if(isset($_POST['Submit'])){
	$programme=$_POST['programme'];
	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];
	
	$sql=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE dept='$programme'  && year = '$year' ORDER BY matno ASC");
	if(!$sql){
	die(mysqli_error());
	}
include('title2.php');?>
	<div style="text-transform:uppercase" >Graduate List</div>

	<hr>
	<table border='1'  cellpadding="1" cellspacing="0" style="font-size:11px; width: 100%; border:thin; border-collapse:collapse">
	<tr>
	<td style="height: 23px">S/N</td>
	<td style="height: 23px">Matric No.</td>
	<td style="height: 23px">Names</td><td style="height: 23px">Sex</td>
		<td style="height: 23px">1st GPA</td>
		<td style="height: 23px">2nd GPA</td>
		<td style="height: 23px">3rd GPA</td>
		<td style="height: 23px">4th GPA</td>
		<td style="height: 23px">5th GPA</td>
		<td style="height: 23px">6th GPA</td>
	<td style="height: 23px">CGPA</td>
	<td style="height: 23px">CLASS/GRAD</td></tr>
		<?php $d= 0;
		while($row=mysqli_fetch_assoc($sql)){
		
		$matricno=$row['matno'];
		
		$sql1=mysqli_query($conn,"SELECT *FROM `results`
		WHERE `matric_no` LIKE '$matricno'AND `programme` LIKE '$programme' ORDER BY matric_no ASC");
		if(!$sql1){ 
		die (mysqli_error());
		}
		$m=0;
		
while ($col =mysqli_fetch_assoc($sql1)){

if ($col['grade']=='F'||$col['grade']=='SICK'||$col['grade']=='ABS'||$col['grade']=='PEND'||$col['grade']=='---'||$col['grade']==''){
$m=$m+1;

}
}	

if ($m<1){
$d= $d+1;
?>
<tr><td bgcolor="#FFFFFF" style="height: 23px"><span class="style4"><?php echo $d;?></span></td>
    <td bgcolor="#FFFFFF" style="height: 23px"><span class="style4"><?php echo $row['matno'];?></span></td>
    <td bgcolor="#FFFFFF" style="height: 23px"><span class="style4"><?php echo $row['names'];?></span></td>
	<td bgcolor="#FFFFFF" style="height: 23px"><span class="style4"><?php echo $row['sex'];?></span></td>
	
	
	<td bgcolor="#FFFFFF" style="height: 23px">
<?php
 		$mat = $row['matno'];
				
		$sqls= mysqli_query($conn,"SELECT * FROM results WHERE semester='1' && matric_no='$mat'")or die (mysqli_error());
		
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sqls)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		if($unit == 0){
		//$gpa1 = number_format(($gp/$unit),2);
		echo "Result Not Entered";
		}else{
		$gpa1 = number_format(($gp/$unit),2);
		echo $gpa1;
		}

?>
	&nbsp;</td>
	
	<td bgcolor="#FFFFFF" style="height: 23px">
	<?php
 		$mat = $row['matno'];
				
		$sqls= mysqli_query($conn,"SELECT * FROM results WHERE semester='2' && matric_no='$mat'")or die (mysqli_error());
		
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sqls)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
			if($unit == 0){
		//$gpa1 = number_format(($gp/$unit),2);
		echo "Result Not Entered";
		}else{
		$gpa1 = number_format(($gp/$unit),2);
		echo $gpa1;
		}

?>

	&nbsp;</td>

	<td bgcolor="#FFFFFF" style="height: 23px">
	<?php
 		$mat = $row['matno'];
				
		$sqls= mysqli_query($conn,"SELECT * FROM results WHERE semester='3' && matric_no='$mat'")or die (mysqli_error());
		
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sqls)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
			if($unit == 0){
		//$gpa1 = number_format(($gp/$unit),2);
		echo "Result Not Entered";
		}else{
		$gpa1 = number_format(($gp/$unit),2);
		echo $gpa1;
		}
?>

	
	</td>
	<td bgcolor="#FFFFFF" style="height: 23px">
	<?php
 		$mat = $row['matno'];
				
		$sqls= mysqli_query($conn,"SELECT * FROM results WHERE semester='4' && matric_no='$mat'")or die (mysqli_error());
		
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sqls)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
			if($unit == 0){
		//$gpa1 = number_format(($gp/$unit),2);
		echo "Result Not Entered";
		}else{
		$gpa1 = number_format(($gp/$unit),2);
		echo $gpa1;
		}
?>

	&nbsp;</td>
	<td bgcolor="#FFFFFF" style="height: 23px">
	<?php
 		$mat = $row['matno'];
				
		$sqls= mysqli_query($conn,"SELECT * FROM results WHERE semester='5' && matric_no='$mat'")or die (mysqli_error());
		
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sqls)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
			if($unit == 0){
		//$gpa1 = number_format(($gp/$unit),2);
		echo "Result Not Entered";
		}else{
		$gpa1 = number_format(($gp/$unit),2);
		echo $gpa1;
		}

?>

	&nbsp;</td>
	<td bgcolor="#FFFFFF" style="height: 23px">
	<?php
 		$mat = $row['matno'];
				
		$sqls= mysqli_query($conn,"SELECT * FROM results WHERE semester='6' && matric_no='$mat'")or die (mysqli_error());
		
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sqls)){ 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
			if($unit == 0){
		//$gpa1 = number_format(($gp/$unit),2);
		echo "Result Not Entered";
		}else{
		$gpa1 = number_format(($gp/$unit),2);
		echo $gpa1;
		}
?>

	&nbsp;</td>
	<td bgcolor="#FFFFFF" style="height: 23px" class="auto-style1"><?php
	$matno = $row['matno'];
	 include("includes/cpgpa.php");
	 echo $ccgpa;?></td>
	<td bgcolor="#FFFFFF" style="height: 23px" class="auto-style1"><?php 
	
		include("includes/remks.php");
	echo $remarks;
		?></td>
  </tr>

<?php 
}
}	?>
<tr>
  <td colspan="12">&nbsp;</td>
</tr>
<?php 
exit; } ?>
  </td>
  
    </tr>
  </table>
  <table width="80%" align="center">
    <tr>
      <td align="center"><form action="" method="post" name="grade" id="grade">
          <strong>VIEW GRAD LIST </strong>
          <table style="text-align: left;color:blue;">
            <tr>
              <td ><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
              <td ><select name="programme" id="programme">
  <?php 
  /*
  $id = $_GET['id'];
  if ($id==3){
	include("includes/optionsc1.php");  
	include("includes/optionssp.php");
  }elseif ($id==6){
	  include("includes/optionsc.php");
  }
	*/ ?>
	
	 <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
            
                </select>
              <input name="semester" value="<?php echo $_GET['id'];?>" type="hidden" /></td>
			  
            </tr>
            <tr>
              <td><span style="font-weight: bold; color: #000000">SESSION:</span></td>
              <td><select name="session">
                          <?php echo include('includes/sessions.php');?>

                </select>
                -
                <select name="year" id="year">
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
          </table>
      <input name="Submit" value="Submit" type="submit" />
          <br />
      </form></td>
    </tr>
  </table>
  <?php //include("includes/footer.php");?>

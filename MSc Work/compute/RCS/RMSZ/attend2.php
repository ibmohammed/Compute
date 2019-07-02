<?php include("includes/header.php"); 
session_start();
?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
  
if(isset($_GET['courseid'])){


$smtr=$_GET['semester'];
$year=$_GET['year'];
$ses=$_GET['session'];
$cid=$_GET['courseid'];
$ccode=$_GET['ccode'];
$ctitle=$_GET['ctitle'];



// session 

/*
$smtr=$_SESSION['semester'];
$year=$_SESSION['year'];
$ses=$_SESSION['session'];
$cid=$_SESSION['courseid'];
$ccode=$_SESSION['ccode'];
$ctitle=$_SESSION['ctitle'];
*/

// chech for user authentication
//	$sec = $_POST['security'];
// $pass = mysql_query("SELECT progs, password FROM logintbl WHERE progs='$cid' AND password='$sec'");
// $res = mysql_fetch_assoc($pass);
// if ($res['progs']!==$cid && $res['password']!==$sec){
//  header('location:manuallist.php');
// }
	
	
$all= mysql_query("SELECT * FROM studentsnm WHERE dept LIKE '$cid' && year ='$year' ORDER BY length(matno),matno", $db);
    if (!$all){
        die(mysql_error()."Records not found");
        exit;
    }
  $header = mysql_query("SELECT * FROM course WHERE programme LIKE '$cid' AND semester = '$smtr'",$db);
      $head = mysql_fetch_array($header);

    if (!$header){
        die("Query Selection failed");
        exit;
    }
    
    switch ( $smtr) {
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
<div align="center" style="font-weight:bold; text-transform:uppercase; font-size:36px;"> Niger State Polytechnic, Zungeru</div>
<br />
<div align="center" style="font-weight:bold; text-transform:uppercase; font-size:large;">Centre For Continueing Education and Training</div>
<table  align='center'>
  <tr>
    <td style="font-weight: bold; color: #000000"><div align="center">MARK AND ATTENDANCE SHEET <br />
      <?php echo  $head[1];?></div></td>
  </tr>
</table>
<table  align='center'>
  <tr >
    <td align="center" style="font-weight: bold; color: #000000"><?php echo $s.$first;?> SEMESTER <?php echo " ".$ses;?><br /></td>
  </tr>
</table>
<p>&nbsp;</p>
<div align="left"><?php echo "Course Code: ".$ccode;?></div>
<div align="right"><?php echo "Course Title: ".$ctitle;?></div>
<table border="1" align="center" style="font-size:8px;">
  <tr >
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"><span style="color: #000000">S/N</span></div></td>
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"><span style="color: #000000">MATRIC No.</span></div></td>
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"><span style="color: #000000">NAMES</span></div></td>
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"> Sign In. </div></td>
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"> Sign Out. </div></td>
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold">BookletNo.</div></td>
    <?php 
	  $code = mysql_query("SELECT * FROM `course` WHERE programme LIKE '$cid' AND semester = '$smtr'");
	  if(!$code){
	  die ("Query Selection failed".mysql_error());
	  }
	 
	  ?>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">1</div></td>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">2</div></td>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">3</div></td>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">4</div></td>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">5</div></td>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">6</div></td>
    <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
      <div align="center" style="font-size: x-small; font-weight: bold">7</div></td>
    <td id = 'page' style="font-size:9px;"><div align="center" style="font-size: x-small; font-weight:lighter">EXAM</div></td>
    <td id = 'page' style="font-size:9px;"><strong>PRACT.</strong></td>
    <td rowspan="2" id = 'page'><p align="center" style="font-size: x-small; font-weight: bold">CA</p>
      <p align="center" style="font-size: x-small; font-weight: bold">20%</p></td>
    <td rowspan="2" id = 'page'><p align="center" style="font-size: x-small; font-weight: bold">TOTAL</p>
      <p align="center" style="font-size: x-small; font-weight: bold">100%</p></td>
    <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold">REMARKS</div></td>
  </tr>
  <tr  bgcolor = '' >
    <td id = 'page'><span style="font-size: x-small; font-weight: bold">60%</span></td>
    <td id = 'page'><span style="font-size: x-small; font-weight: bold">20%</span></td>
  </tr>
  <?php  
	$n = 0;
	while ($res= mysql_fetch_array($all)){
	$n= $n +1;
	?>
  <tr >
    <td bgcolor="#FFFFFF" id = 'page'><span style="font-size: small; font-weight: bold; color: #000000">
      <?php  echo $n;?>
    </span></td>
    <td bgcolor="#FFFFFF" id = 'page2'><span style="font-size: small; font-weight: bold; color: #000000"><?php echo $res[2];?></span></td>
    <td bgcolor="#FFFFFF" id = 'page2'><span style="font-size: small; font-weight: bold; color: #000000">
      <?php  echo $res[1];?>
    </span></td>
    <td id = 'page2'>&nbsp;</td>
    <td id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <?php 
	   $codes = mysql_query("SELECT * FROM `course` WHERE programme LIKE '$cid' AND semester = '$smtr'");
	  if(!$codes){
	  die ("Query Selection failed".mysql_error());
	  }
	//  while( $cols = mysql_fetch_array($codes)){?>
    <td bgcolor="#FFFFFF" id = 'page2'><span class="style5"></span></td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <td bgcolor="#FFFFFF" id = 'page2'>&nbsp;</td>
    <?php // }?>
  </tr>
  <?php      }?>
</table>
<table align="center">
  <tr>
    <td><p>&nbsp;</p>
      <p>Invigilator's Name:...........................................................................................Examiners Name:...................................................................................</p>
      <p>&nbsp;</p>
      <p>Signarure/Date:............................................................................................. Signature/Date........................................................................................ </p></td>
  </tr>
  <tr>
    <td><a href="index.php" class="style7">Home</a></td>
  </tr>
</table>
<?php
  exit; }?>
</body>
</html>
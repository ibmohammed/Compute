
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("header.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="RMSZ/images/nipoly2 (1).GIF" type="image/x-jpg"/>

<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	color: #0033FF;
}
a:hover {
	color: #0066FF;
}
.style3 {color: #000000}
-->
</style>
</head>

<body>
  <table  align="center">
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #000066}
.style7 {font-size: 18px}
.style8 {font-size: 16px}
.style9 {font-size: 16px; font-weight: bold; }
-->
</style>

         <tr>
    <td align="center" valign="top">

     <?php
//$mat = $_POST['matricno'];
//$sess = $_POST['session'];
//$sem = $_POST['semester'];
$qry = "SELECT * FROM  `studentsnm`";
$sqm=mysqli_query($conn,$qry) or die(mysqli_error());
$img = mysqli_fetch_array($sqm);

  $equry = "SELECT * FROM results WHERE matric_no LIKE '$mat'  AND session LIKE '$sess' AND semester = '$sem'";
  $mtr = mysqli_query($conn,$equry);

if (!$mtr){
 die("query failled".mysqli_error());
}
$mn = mysqli_fetch_array($mtr);
?>

      <?php

        if ($mat !== $mn['matric_no']) {
         die ("No Records found pls make sure The entries are correct");
        }
        ?>

	
      <table align="center" width="100%">
<!---
-->
        <table border="1" cellspacing="0" cellpadding="1" align="center">
          <tr>
            <td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Codes</big></strong></span></td>
            <td id="page3"><span style="color: #000000; font-size: 10px"><strong><big> Course Names</big></strong></span></td>
            <td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Unit</big></strong></span></td>
            <td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Mark</big></strong></span></td>
            <td id="page3"><span style="color: #000000; font-size: 10px"><big><strong>
			Grade</strong></big></span></td>
            <td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Points</big></strong></span></td>
            <td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Weighted Points</big></strong></span></td>
          </tr>
          <?php
//	 $msq = mysql_query("SELECT *  FROM course WHERE programme LIKE '$course' AND semester = $sem",$db);
$ssql = "SELECT *  FROM course WHERE	 `programme` LIKE '$course' AND
							 `semester` = $sem && `sessions` LIKE '$sess'";
        $msq = mysqli_query($conn,$ssql) or die(mysql_error());

	  $rsql = "SELECT * FROM results WHERE matric_no LIKE '$mat'   AND semester = $sem";
$msql = mysqli_query($conn,$rsql)  or die(mysql_error());;

	  while (($row= mysqli_fetch_assoc($msq)) && ($col= mysqli_fetch_assoc($msql))){?>
          <tr>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['code'];?></strong></span></td>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['title'];?></strong></span></td>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['unit'];?></strong></span></td>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['score']; ;?></strong></span></td>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['grade']; ;?></strong></span></td>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']; ;?></strong></span></td>
            <td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']*$col['unit']; ;?></strong></span></td>
          </tr>
          <?php }?>
        </table>
        <table border="1" align="center" cellpadding="1" cellspacing="0" >
          <tr>
            <td id="page1"><span class="style3 style6"><strong>T C U &nbsp;</strong></span></td>
            <td id="page1"><span class="style3 style6"><strong>T  P</strong></span></td>
            <td id="page1"><span class="style3 style6"><strong>GPA</strong></span></td>
            <td id="page1"><span class="style3 style6"><strong>CGPA&nbsp;</strong></span></td>
          </tr>
          <?php
		$session = $mn['session'];
		$semester = $sem;
		$programme = $course;
		$matno = $mat;

		$gqry_result = calculate_gp($conn, $course, $sem, $mat);
		//$sql= mysqli_query($conn,$gqry) or die (mysqli_error());

		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($gqry_result)){



		  if (($res['grade']=="SICK")||($res['grade']=="ABSE")||($res['grade']=="PEND")||($res['grade']=="---")||($res['grade']=="EM")){
			 $res['unit']=0;
			  }
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		if ($unit==0){
		$gpa= 0;
			}else{
		$gpa = number_format(($gp/$unit),2);
			}

		include("includes/cpgpa.php");

		?>
          <tr>
            <td id="page2"><span class="style3"><?php echo $unit;?></span> </td>
            <td id="page2"><span class="style3"><?php echo $gp ;?></span></td>
            <td id="page2"><span class="style3"><?php echo $gpa ;?></span></td>
            <td id="page2"><span class="style3"><?php echo $ccgpa;?></span></td>
          </tr>
        </table></td>
    </tr>
</table>
  <?php //exit; ?>

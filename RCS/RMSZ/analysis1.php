<?php include("includes/header.php"); ?>    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	font-size: small;
}
.auto-style2 {
	text-align: center;
}
.auto-style3 {
	text-align: left;
}
</style>
</head>

<body>


<table style="width: 90%" align="center">

<?php 

//if(isset($_POST['Submit'])){ 
$programme = $_POST['programme'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$session = $_POST['session'];



//		$query= mysqli_query($conn,"SELECT * FROM course 
//		WHERE prog_id='$programme' && semester	='$semester'&& sessions = '$session'") or  die (mysqli_error());
	
    switch ($semester) {
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
	
	$abs=0 ;
	$pnd =0 ;
		$emt =0;
		$atw = 0;
		$pass = 0;
		$pss = 0;
		$uc =0;
		$lc = 0;
		$dst = 0;
		// keep title here
	

?>

	<tr>
		<td><?php 	include('title1.php');
echo "Analyasis of Result";
?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>


<table border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:12px; width: 90%; border:thin; border-collapse:collapse">
	<tr>
		<td style="height: 23px" class="auto-style1"><strong>SN</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>COURSE</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>CODE</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>UNIT</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>A</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>AB</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>B</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>BC</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>C</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>CD</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>D</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>E</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>F</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>EM</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>AE</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>A</strong>W</td>
		<td style="height: 23px" class="auto-style1"><strong>PI</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>MS</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>NR</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>TOTAL</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>MEAN</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>STD DEV</strong></td>
		<td style="height: 23px" class="auto-style1"><strong>% PASS</strong></td>
	</tr>
	
	<?php 
	$cc = mysqli_query($conn,"SELECT *
FROM `course` WHERE prog_id = '$programme' && semester = '$semester' && sessions = '$session'") or die(mysqli_error($conn));
$n = 0;
$f = 0;
while($row = mysqli_fetch_assoc($cc)){
$n++;
	?>
	<tr>
		<td class="auto-style2" style="height: 17px">
		<?php echo $n;?>
		
		</td>
		
		<td class="auto-style3" style="height: 17px">
		<?php echo $row['title'];?>&nbsp;</td>
		
		<td class="auto-style3" style="height: 17px">
		<?php 
		echo $row['code'];
		$code = $row['code'];
		?></td>
		
		<td class="auto-style2" style="height: 17px">
		<?php 
		echo $row['unit'];
		//$code = $row['unit'];
		?></td>
		
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'A' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr; 
		$tt = $numr;
		$pw = (((75+100)/2)*((75+100)/2));
		$mbf = ($numr*((75+100)/2));
		$smbf = (0+$mbf);
		$mfp = ($numr*$pw);
		$smfp = (0+$mfp);
		$pass = $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'AB' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((70+74)/2)*((70+74)/2));
		$mbf = ($numr*((70+74)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'B' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((65+69)/2)*((65+69)/2));
		$mbf = ($numr*((65+69)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'BC' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((60+64)/2)*((60+64)/2));
		$mbf = ($numr*((60+64)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'C' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((55+59)/2)*((55+59)/2));
		$mbf = ($numr*((55+59)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'CD' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((50+54)/2)*((50+54)/2));
		$mbf = ($numr*((50+54)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'D' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((45+49)/2)*((45+49)/2));
		$mbf = ($numr*((45+49)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'E' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((40+44)/2)*((40+44)/2));
		$mbf = ($numr*((40+44)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
		$pass = ($numr + $pass);
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'F' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		$f = ((mysqli_num_rows($a))+($f));
		echo $numr;
		$tt = $tt + $numr;
		$pw = (((0+39)/2)*((0+39)/2));
		$mbf = ($numr*((0+39)/2));
		$smbf = (($smbf)+($mbf));
		$mfp = ($numr*$pw);
		$smfp = ($smfp+$mfp);
//		$pass = ($numr + $pass);
//		$ver = (($smfp - ($tt*($mean *$mean))/($tt - 1));
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'EM' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'AE' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'ABS' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'PI' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'MS' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php $a = mysqli_query($conn,"SELECT * FROM `results` WHERE grade = 'NR' && code = '$code' &&  prog_id='$programme' && semester = '$semester' && session = '$session' && stat = '0'");
		$numr = mysqli_num_rows($a);
		echo $numr;
		$tt = $tt + $numr;
		?></td>
		<td class="auto-style2" style="height: 17px"><?php echo $tt;?>&nbsp;</td>
		<td class="auto-style2" style="height: 17px"><?php 
		if($tt == 0){
		echo "Empty Records";
		}else{
		echo number_format(($smbf/$tt),2);
		}
		?></td>
		<td class="auto-style2" style="height: 17px"><?php 
		
		if($tt == 0){
		echo "Empty Records";
		}else{
		
$tt11 = ($tt - 1);

if($tt11 == 0){
echo 0;
}else{
		$mean  = number_format(($smbf/$tt),2);
		$ver = (($smfp - ($tt*($mean*$mean)))/($tt - 1));
		echo number_format((sqrt($ver)),2);
	}
	}	
		?> </td>
		<td  class="auto-style2" style="height: 17px">
		<?php 
		if($tt == 0){
		echo "Empty Records";
		}else{
	
		$ppass = (($pass/$tt)*100);
		echo number_format($ppass,2);
		}
		?></td>
	</tr>
	<?php }?>
</table>
<table border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:12px; width: 90%; border:thin; border-collapse:collapse">
<tr>
<td>*The Mean and standard Deviation are calculated for the Total Number of Students that scored actual marks in the Exams<br/>
*The total Number of Students is <?php echo @$tt;?>
<br><br>LEGEND</td>
</tr>
</table>
<table  align="center" style="font-size:12px; width: 90%; ">
	<tr>
		<td style="height: 18px">AE = ABSENT WITH EXCUSE</td>
		<td style="height: 18px">EM =&nbsp; EXAMINATION MALPRACTICE</td>
		<td style="height: 18px">PI = PROJECT INCOMPLETE</td>
	</tr>
	<tr>
		<td>MS = MISSING SCRIPT</td>
		<td>NR = NOT REGISTERED</td>
		<td>TOTAL = TOTAL NO. OF STUDENTS</td>
	</tr>
	<tr>
		<td>AW = ABSENT WITHOUT EXCUSE </td>
		<td>STD DEV = STANDARD DEVIATION</td>
		<td>MEAN = AVRERAGE </td>
	</tr>
</table>

<?php 
// exit;
// }?>

<!--   



-->
</body>

</html>

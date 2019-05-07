<?php include("includes/header.php"); ?>

<div align="left">
 
    <br>
 
 <table border="0" align="center">
    <tr>
      <td>
        <div align="center">
          <?php 
	if(isset($_POST['Submit'])){ ?>
<?php 
$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$start=$_POST['start'];
$list=$_POST['list'];
		if ((!$programme)){
	die("empty fields not allowed");
	}
		$query= mysqli_query($conn,"SELECT * FROM course WHERE programme='$programme' && semester	='$semester'");
	if(!$query){
	die (mysqli_error());
	}
	
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
	
	include('title.php');
	

	?>
      <br />RESULT ANALYSIS  
	      <?php $n = $start; 
  
$msql=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE dept ='$programme' && year='$year' && Withdrwan ='0' ORDER BY  `matno` ASC");
if(!$msql){
die(mysqli_error());
}

while ($col=mysqli_fetch_assoc($msql)){
$n= $n+1;
 ?>
	                  <?php 
		$matno = $col['matno'];
		$sql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$programme' && semester='$semester'  && matric_no='$matno'");
			if(!$sql){
	die (mysqli_error());
	}
		$unit=0;
		$gp=0;
		$rem = 0;
		while ($res=mysqli_fetch_assoc($sql)){?>
	       <?php //echo $res['grade'];?>
		  <?php 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		$gpa = number_format(($gp/$unit),2);
		include("includes/cpgpa.php");
		
		?>
	        
            <?php
		include("includes/co.php");
		 while($row=mysqli_fetch_assoc($sql)){
//echo $row['code'].",";
}
include("includes/ABS.php");
		while($row=mysqli_fetch_assoc($sqlm)){
//echo $row['code'].",";
}?>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style1">
          <?php
		include("includes/EM.php");
		 while($row=mysqli_fetch_assoc($sql)){
//echo $row['code'].",";
}?>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style1">
          <?php 
		include("includes/sitting.php");
		while($row=mysqli_fetch_assoc($sql)){
//echo $row['code'].",";
}
include("includes/sick.php");
		while($row=mysqli_fetch_assoc($query)){
//echo $row['code'].",";
}
?>
              <?php 
		$matno = $col['matno'];
		$mysql= mysqli_query($conn,"SELECT * FROM results WHERE programme='$programme' &&  matric_no='$matno'");
		
	if(!$mysql){
	die (mysqli_error());
	}
		//$unit=0;
		//$gp=0;
		//$pnd = 0;
		$an = 0;
		$rem = 0;
		$ttl =0;
//		$pass = 0;
		while ($result=mysqli_fetch_assoc($mysql)){ 
		$ttl =$ttl + 1;
		
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")||($result['grade'] =="ABSE")||($result['grade'] =="EM")||($result['grade'] =="AE")){
		$rem = $rem +1;
		//$all = $all +1; 
		$reslt = $result['grade'];
		}else{
			
				$reslt = $result['grade'];
	
			}
		
		}
		  if ($semester <=5){
if(($rem>=1 )&&($reslt=="AE") or ($reslt=="ABS")){
				// echo "PENDING"; 
				$abs = $abs + 1;
		}
		  }
		 
		  if ($semester <=5){
		if(($rem>=1 )&&($reslt=="PEND")){
				// echo "PENDING"; 
				$pnd = $pnd + 1;
		}elseif($rem>=1){
	if(($gpa<=1.5)&&($semester==1) ){
	echo "";
	$atw = $atw + 1;
	}elseif(($ccgpa<=1.5)&&($semester>1)){
	//echo "ATW";
	
	}else{
	echo "";
	$emt = $emt + 1;
	}
}elseif($rem<1){
	$pass = $pass + 1;
	//echo "PASS";
	}
		}elseif($semester==6){
	if(($rem>=1 )&&($reslt=="PEND")){
				// echo "PENDING"; 
		}elseif($rem>=1){
	echo "";
	}elseif($rem<1){
	include("includes/remks.php");
	if ($remarks =="PASS"){
		$pss = $pss +1;
		}elseif($remarks =="LOWER CREDIT"){
			$lc = $lc +1;
			}elseif($remarks =="UPPER CREDIT"){
				$uc = $uc +1;
				}elseif($remarks =="DISTINCTION"){
					$dst = $dst+1;
					}
	//echo $remarks;
	}
	
	} 

	?>
            </div></td>
          </tr><?php }?>
        </table>      </td>
    </tr>
  <table border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:12px; width: 600px; border:thin; border-collapse:collapse">
      <tr>
        <td valign="top"><?php 
		$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
		$qry = mysqli_query($conn,"SELECT * FROM course WHERE programme='$programme' && semester	='$semester' && sessions = '$session'") or die (mysqli_error());
				?>
          <table border="1"  style="font-size:12px; width: 600px; border:thin; border-collapse:collapse">
            <tr>
              <td style="height: 19px"><strong>S/N</strong></td>
              <td style="height: 19px"><strong>Title</strong></td>
              <td style="height: 19px"><strong>Code</strong></td>
              <td style="height: 19px"><strong>Unit</strong></td>
            </tr>
            <?php $j =0; 
  while($courses = mysqli_fetch_assoc($qry)){
	  $j = $j + 1;?>
            <tr>
              <td style="height: 25px"><?php echo $j;?></td>
              <td style="height: 25px"><?php echo $courses['title'];?></td>
              <td style="height: 25px"><?php echo $courses['code'];?></td>
              <td style="height: 25px"><?php echo $courses['unit'];?></td>
            </tr>
            <?php }?>
        </table></td>
      </tr>
      <tr>
        <td valign="top" style="height: 25px"></td>
      </tr>
      <tr>
        <td valign="top" style="height: 17px"><?php 
	
	
	
	echo " Toal No in Class: ".$n."<br> ";
	$co = ($n - $pass);
	$pass = ($pass-$atw-$pnd-$abs);
	echo " No of Pass: ".$pass."<br> ";
	$cal = ($n - $pass);
	
// include this for 6 or 3 semester programme

	if (($semester == 6) or ($semester == 3)){
	echo "No of Distinction: ".$dst."<br> ";
	echo "No of Uper Credit: ".$uc."<br> ";
	echo "No of Lower credit: ".$lc."<br> ";
	echo "No of Pass: ".$pss."<br> ";
	
	}
	// in %
	echo "No of C/O: ".$co."<br> ";
	echo "No of Absents:".$abs."<br>";
	echo "No of Pending: ".$pnd."<br> ";
	echo "No of ATW: ".$atw."<br> ";
	
	$pp = ($pass /$n) * 100;
	$pf = ($co /$n) * 100;
	$ppnd = ($pnd /$n) * 100;
	$ptw = ($atw/$n) * 100;
	$pabs = ($abs/$n) * 100;
	echo "%pass :".$pp ."<br> ";
	echo "%C/O :".$pf ."<br> ";
	echo "%Absent :".$pabs ."<br> "; 
	echo "%Pending :".$ppnd ."<br> "; 
	echo "%ATW :".$ptw ."<br> "; 
	// exit;
	 
	?></td>
      </tr>
  </table>

 <?php exit;}?>
</div>

<form action="analysis.php" method="post" name="grade" id="grade" target="_blank">
    <div align="left" style="height: 139px; width: 988px">
      <table width="50%">
        <tr>
          <td align="left" style="height: 26px"><strong>PROGRAMME:</strong></td>
          <td align="left" style="height: 26px"><select name="programme" id="programme">
		 
            
             <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
            
            <?php //include("includes/optionsc.php"); ?>
			<?php
			//include('prog1.php');
			//include('prog2.php');
			//include('prog3.php');
			 ?>
          </select></td>
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
           <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
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
          <input type="hidden" name="list" value="30" /></td>
        </tr>
          </table>
      <input name="Submit" value="Submit" type="submit" />
      </div>
  </form>
  

<?php inclue("includes/header.php");?>
 <table border="0" align="center">
    <tr>
      <td>
        <div align="center">
          <?php 
	if(isset($_POST['Submit'])){
	
$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$start=$_POST['start'];
$list=$_POST['list'];
		if ((!$programme)){
	die("empty fields not allowed");
	}
		$query= mysql_query("SELECT * FROM course WHERE programme='$programme' && semester	='$semester'");
	if(!$query){
	die (mysql_error());
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
	
	echo "<span style='font-size: small; font-weight: bold'><center>"."CENTER FOR CONTINUING EDUCATION AND TRAINING "."<BR>";
	echo "NIGER STATE POLYTECHNIC ZUNGERU"."</center></span>";
	
	
	echo $programme."<br>".$semester.$first." Semester ". $session. " Session";
	?>
        </div>
	    <table border="1" align="center" bgcolor="#000000">
	      <tr>
	        <td rowspan="2" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">S/N</div></td>
        <td rowspan="2" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Matric_No</div></td>
      <?php while($row=mysql_fetch_array($query)){  ?>  <td rowspan="2" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold"><?php echo $row['code']."<br>"."(".$row['unit'].")";?></div></td>
      <?php }?>
	        <td colspan="3" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Current_Semester </div></td>
        <td colspan="3" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Previous_Semester </div></td>
        <td colspan="3" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Current_Cumulative </div></td>
        <td colspan="4" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">REMARKS</div></td>
      </tr>
	      <tr>
	        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2 style2" style="font-weight: bold">co</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2 style2" style="font-weight: bold">Sit</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2 style2" style="font-weight: bold">Pend</div></td>
        <td bgcolor="#CCCCFF"><div align="center"><span class="style1"><span class="style1"><span class="style2"><span class="style2"></span></span></span></span></div></td>
      </tr>
	      <?php $n = $start; 
  
$msql=mysql_query("SELECT * FROM `studentsnm` WHERE dept ='$programme' && year='$year' && Withdrwan ='0' ORDER BY  `matno` ASC LIMIT $start,$list ");
if(!$msql){
die(mysql_error());
}

while ($col=mysql_fetch_array($msql)){
$n= $n+1;
 ?>
	      <tr>
	        <td bgcolor="#FFFFFF"><span class="style5 style2"><?php echo $n;?></span></td>
            <td bgcolor="#FFFFFF"><div class="style5 style2"><?php echo $col['matno'];?></div></td>
            <?php 
		$matno = $col['matno'];
		$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester='$semester'  && matric_no='$matno'");
			if(!$sql){
	die (mysql_error());
	}
		$unit=0;
		$gp=0;
		$rem = 0;
		while ($res=mysql_fetch_array($sql)){?>
	        <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $res['grade'];?></div></td>
		  <?php 
		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		$gpa = number_format(($gp/$unit),2);
		include("includes/cpgpa.php");
		
		?>
	        <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $unit;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $gp;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $gpa;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $pcu;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $pcgp;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $pcgpa;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $ccu;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $ccgp;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2"><?php echo $ccgpa;?></div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style2 style2">
              <?php
		include("includes/co.php");
		 while($row=mysql_fetch_array($sql)){
echo $row['code'].",";}?>
            </div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style2 style2">
              <?php 
		include("includes/sitting.php");
		while($row=mysql_fetch_array($sql)){
echo $row['code'].",";}
include("includes/sick.php");
		while($row=mysql_fetch_array($query)){
echo $row['code'].",";}
?>
            </div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style2 style2">
              <?php 
		include("includes/pend.php");
		while($row=mysql_fetch_array($sql)){
echo $row['code'].",";}?>
            </div></td>
            <td bgcolor="#FFFFFF"><div align="center" class="style5 style2">
              <?php 
		$matno = $col['matno'];
		$mysql= mysql_query("SELECT * FROM results WHERE programme='$programme' &&  matric_no='$matno'");
		
	if(!$mysql){
	die (mysql_error());
	}
		//$unit=0;
		//$gp=0;
		$rem = 0;
		while ($result=mysql_fetch_array($mysql)){ 
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")){
		$rem = $rem +1;
		}
		}
		  if ($semester <=5){
		if($rem>=1){
	if(($gpa<=1.5)&&($semester==1) ){
	echo "ATW";
	}elseif(($ccgpa<=1.5)&&($semester>1)){
	echo "ATW";
	}else{
	echo "";
	}
}elseif($rem<1){
	echo "PASS";
	}
		}elseif($semester==6){
	
		if($rem>=1){
	echo "";
	}elseif($rem<1){
	include("includes/remks.php");
	echo $remarks;
	}
	
	} 

	?>
            </div></td>
          </tr><?php }?>
        </table>      </td>
    </tr>
  </table>
 <?php } ?>
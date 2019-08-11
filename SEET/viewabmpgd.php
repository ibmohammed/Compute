<?php require("includes/header.php");?>
<head>
<style type="text/css">

.style2 {font-size: xx-small}
.smalll {
	font-size: small;
}
</style>
</head>



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
	// add sessions to column to this query below
		$query= mysql_query("SELECT * FROM course WHERE programme='$programme' && semester	='$semester' && sessions = '$session'");
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
	// keep title here
	
	include('title.php');
	
?>

<style type="text/css" media="print,screen" >
table td {
	border-bottom:1px solid gray;
}
th {
font-family:Arial;
color:black;
background-color:lightgrey;
}
thead {
	display:table-header-group;
}
tbody {
	display:table-row-group;
}
</style>



	<table id="t1" border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:11px; width: auto; border:thin; border-collapse:collapse">
 <thead>
  <tr>
    <td rowspan="2"><div align="center" class="style2" style="font-weight: bold">S/N</div></td>
    <td rowspan="2"><div align="center" class="style2" style="font-weight: bold">Matric_No</div></td>
    <td rowspan="2"><div align="center" class="style2">Names</div></td>
  <?php while($row=mysql_fetch_array($query)){  ?>  <td rowspan="2"><div align="center" class="style2" style="font-weight: bold"><?php echo $row['code']."<br>"."(".$row['unit'].")";?></div></td>
  <?php }?>
    <td colspan="3"><div align="center" class="style2" style="font-weight: bold">Current_Semester </div></td>
    <td colspan="3"><div align="center" class="style2" style="font-weight: bold">Previous_Semester </div></td>
    <td colspan="3"><div align="center" class="style2" style="font-weight: bold">Current_Cumulative </div></td>
    <td colspan="5"><div align="center" class="style2" style="font-weight: bold">REMARKS</div></td>
  </tr>
  <tr>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">co</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">EM</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">Sit</div></td>
    <td style="height: 25px"><div align="center" class="style2" style="font-weight: bold">Pend</div></td>
    <td style="height: 25px"><div align="center"><span class="style2"></span></div></td>
  </tr>
</thead>

<?php $n = $start; 
//$msql=mysql_query("SELECT * FROM `studentsnm` WHERE dept ='$programme' && year='$year'  && Withdrwan ='0' ORDER BY  `matno` ASC LIMIT $start,$list");
$msql=mysql_query("SELECT * FROM `studentsnm` 
WHERE dept ='$programme' && year='$year'  && Withdrwan ='0' ORDER BY  `matno` ASC ");
if(!$msql){
die(mysql_error());
}

while ($col=mysql_fetch_array($msql)){
$n= $n+1;
 ?>
<tbody>
      <tr class="smalll">
	    <td bgcolor="#FFFFFF"><span class="style2"><?php echo $n;?></span></td>
        <td align="left" bgcolor="#FFFFFF"><div align="justify" class="style"><?php echo $col['matno'];?></div></td>
        <td bgcolor="#FFFFFF"><div align="justify" class="style2"><?php echo $col['names'];?></div>
        <div align="center" class="style2"></div>
        <div align="justify" class="style2"></div></td>
        <?php 
		$matno = $col['matno'];
		$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester='$semester' && matric_no='$matno'");
		
	if(!$sql){
	die (mysql_error());
	}
		$unit=0;
		$gp=0;
		$rem = 0;
		while ($res=mysql_fetch_array($sql)){?><td bgcolor="#FFFFFF">
		
		<div align="center">
		
		
		<u> <?php echo $res['score'];?></u>
		  <br/>
		<!--  <hr style="width:8px; height:;"/>-->
		  <?php echo $res['grade'];?>

		
		</div>
		</td>
		<?php
				  // do not count the unit of unknown grades
		if (($res['grade']=="SICK")||($res['grade']=="ABSE")||($res['grade']=="PEND")||($res['grade']=="---")||($res['grade']=="EM")||($res['grade']=="AE")||($res['grade']=="PI")){
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
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $unit;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $gp;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $gpa;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $pcu;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $pcgp;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $pcgpa;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $ccu;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $ccgp;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2"><?php echo $ccgpa;?></div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style1">
         <?php include("rmk.php"); ?>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style2">
          <?php 
		$matno = $col['matno'];
		$mysql= mysql_query("SELECT * FROM results WHERE programme='$programme' &&  matric_no='$matno'");
		
	if(!$mysql){
	die (mysql_error());
	}
	
	  
		$qq= mysql_query("SELECT SUM(unit) AS vaule_sum FROM course 
		WHERE programme='$programme' && semester ='$semester' && sessions = '$session'");
		$uu = mysql_fetch_assoc($qq);
		$unn = $uu['vaule_sum'];
		
	//$unit=0;
		//$gp=0;
		$rem = 0;
		while ($result=mysql_fetch_array($mysql)){ 
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")||($result['grade'] =="ABSE")||($result['grade'] =="EM")||($result['grade']=="AE")||($result['grade']=="PI")){
		$rem = $rem +1;
		$reslt =$result['grade'];
			}
		}
	
  
	  if ($semester <=2){
		if($rem>=1){
	if(($gpa<=1.49)&&($semester==1) ){
	echo "ATW";
	}elseif(($gpa<=1.49)&&($semester>=1)){
//}elseif(($ccgpa<=1.5)&&($semester>1)){
	echo "ATW";
	}elseif($unit > $unn){
	echo "";
	}
	}elseif($rem<1){
	if(($unit == $unn)&&($gpa>=3.5)){
		echo "QR";
		}else
		if($gpa<=1.49 && ($unit < $unn)){
		echo "ATW";
		}elseif(($unit == $unn)&& ($gpa >=1.50)){
			echo "PASS";
		}
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
        </div></td>
      </tr><?php }?>
    </tbody>
    </table>
    
    <p style="page-break-after:always"></p>

<!--
<table align="center">
  <tr>
    <td style="width: 4px">&nbsp;</td>
    <td align="left" valign="bottom"><form id="form1" name="form1" method="post" action="">
      <input name="Submit" type="submit" id="Submit" value="&lt;&lt;&lt;" />
      <input name="semester" type="hidden" id="semester" value="<?php echo $semester;?>" />

      <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
      <input name="year" type="hidden" id="year"  value="<?php echo $year;?>"/>
      <input name="programme" type="hidden" id="programme"  value="<?php echo $programme;?>"/>
      <input name="start" type="hidden" id="start"  value="<?php echo $start-20;?>"/>
      <input name="list" type="hidden" id="list"  value="<?php echo $list;?>"/>
    </form></td>
    <td align="left" valign="bottom"><form id="form2" name="form2" method="post" action="">
      <input name="Submit" type="submit" id="Submit" value="&gt;&gt;&gt;" />
      <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
      <input name="year" type="hidden" id="year"  value="<?php echo $year;?>"/>
      <input name="programme" type="hidden" id="programme"  value="<?php echo $programme;?>"/>
      <input name="start" type="hidden" id="start"  value="<?php echo $start+20;?>"/>
      <input name="list" type="hidden" id="list"  value="<?php echo $list;?>"/>
      <input name="semester" type="hidden" id="semester" value="<?php echo $semester;?>" />
    </form></td>
  </tr>
</table>

-->
   <div id="analysis"> <?php 
    // dislay Analysis Page after the rsult 

     include('analysis1.php');
    include('analyz.php');
    ?></div>



<?php exit; }
	?>
	
<form action="viewabm.php" method="post" name="grade" id="grade" target="_blank">
 <div align="center"> <table align="center" style="width: 303px">
    <tr>
      <td align="left"><span style="font-weight: bold">PROGRAMME:</span></td>
      <td align="left" style="width: 154px"><select name="programme" id="programme">
<option selected="selected"> <?php // echo $_GET['depts'];?></option>

 <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode' ") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
                        
		<?php
			//include('prog1.php');
			//include('prog2.php');
			//include('prog3.php');
			 ?>
      </select></td>
    </tr>
    <tr>
      <td align="left"><span style="font-weight: bold">SEMESTER:</span></td>
      <td align="left" style="width: 154px"><select name="semester" id="semester">
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
      <td align="left"><span style="font-weight: bold">SESSION:</span></td>
      <td align="left" style="width: 154px"><select name="session" id="session">
      <option selected="selected"></option>
      <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
        <?php echo include('includes/sessions.php');?>
      </select>
        -
        <select name="year" id="select2">
          <option selected="selected"></option>
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
        <input name="start"  type="hidden" id="start" value="0" />
      <input name="list" type="hidden" id="list" value="20" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input name="Submit" type="submit" id="Submit" value="Submit" />
      </div></td>
    </tr>
  </table></div>
</form>

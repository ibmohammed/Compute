<?php require("includes/header.php");?>
<style type="text/css">
<!--
.style2 {font-size: xx-small}
-->
</style>

    

<div align="left">
  
      
      
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

	 include('title.php');
echo "CARRY OVER RESULTS";?>
        </div>
	    
	    
	    <table id="t1" border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:11px; width: auto; border:thin; border-collapse:collapse">
	      <tr>
	        <td rowspan="2" bgcolor="" style="width: 16px"><div align="center" class="style2" style="font-weight: bold">S/N</div></td>
        <td rowspan="2" bgcolor=""><div align="center" class="style2" style="font-weight: bold">Matric_No</div></td>
      <?php while($row=mysql_fetch_array($query)){  ?>  <td rowspan="2" bgcolor=""><div align="center" class="style2" style="font-weight: bold"><?php echo $row['code']."<br>"."(".$row['unit'].")";?></div></td>
      <?php }?>
	        <td colspan="3" bgcolor=""><div align="center" class="style2" style="font-weight: bold">Current_Semester </div></td>
        <td colspan="3" bgcolor=""><div align="center" class="style2" style="font-weight: bold">Previous_Semester </div></td>
        <td colspan="3" bgcolor=""><div align="center" class="style2" style="font-weight: bold">Current_Cumulative </div></td>
        <td colspan="5" bgcolor=""><div align="center" class="style2" style="font-weight: bold">REMARKS</div></td>
      </tr>
	      <tr>
	        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">co</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">EM</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">Sit</div></td>
        <td bgcolor="" style="height: 25px"><div align="center" class="style2" style="font-weight: bold">Pend</div></td>
        <td bgcolor="" style="height: 25px"><div align="center"><span class="style2"></span></div></td>
      </tr>
	      <?php $n = $start; 
$msql=mysql_query("SELECT * FROM `studentsnm` WHERE dept ='$programme' && year='$year' &&`stat`='2'  && Withdrwan ='0' ORDER BY  `matno` ASC LIMIT $start,$list");
if(!$msql){
die(mysql_error());
}

while ($col=mysql_fetch_array($msql)){
$n= $n+1;
 ?>
	      <tr>
	        <td bgcolor="#FFFFFF" style="font-size: small; width: 16px;"><span class="style2"><?php echo $n;?></span></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div class="style2"><?php echo $col['matno'];?></div></td>
            <?php 
		$matno = $col['matno'];
		$sql= mysql_query("SELECT * FROM results WHERE programme='$programme' && semester='$semester'  && matric_no='$matno'");
		
	if(!$sql){
	die (mysql_error());
	}
		$unit=0;
		$gp=0;
		$rem=0;
		while ($res=mysql_fetch_array($sql)){?><td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $res['grade'];?></div></td>
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
	        <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $unit;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $gp;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $gpa;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $pcu;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $pcgp;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $pcgpa;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $ccu;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $ccgp;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2"><?php echo $ccgpa;?></div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style1">
             <?php include("includes/rmk.php"); ?>
            </div></td>
            <td bgcolor="#FFFFFF" style="font-size: small"><div align="center" class="style2">
              <?php 
		$matno = $col['matno'];
		$mysql= mysql_query("SELECT * FROM results WHERE programme='$programme' &&  matric_no='$matno'");
		
	if(!$mysql){
	die (mysql_error());
	}
//		$unit=0;
	//	$gp=0;
		$rem = 0;
		while ($result=mysql_fetch_array($mysql)){ 
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")||($result['grade'] =="ABSE")||($result['grade'] =="EM")||($res['grade']=="AE")){
		$rem = $rem +1;
		}
		}
		  if ($semester <=2){
		if($rem>=1){
	if(($gpa<=1.49)&&($semester==1) ){
	echo "ATW";
	}elseif(($gpa<=1.49)&&($semester>=1)){
//}elseif(($ccgpa<=1.5)&&($semester>1)){
	echo "ATW";
	}else{
	echo "";
	}
	}elseif($rem<1){
	if($gpa>=3.5){
		echo "QR";
		}else
		if($gpa<=1.49){
		echo "ATW";
		}else{
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
        </table> 
        
        
        
  <table align="center">
    <tr>
      <td align="left"><form id="form1" name="form1" method="post" action="">
          
          <input name="semester" type="hidden" id="semester" value="<?php echo $semester;?>" />
          <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
          <input name="year" type="hidden" id="year"  value="<?php echo $year;?>"/>
          <input name="programme" type="hidden" id="programme"  value="<?php echo $programme;?>"/>
          <input name="start" type="hidden" id="start"  value="<?php echo $start-20;?>"/>
          <input name="list" type="hidden" id="list"  value="<?php echo $list;?>"/>
          <input type="submit" name="Submit" value="&lt;&lt;&lt;" />
      </form>      </td>
      <td align="left"><form id="form2" name="form2" method="post" action="">
          
          <input name="semester" type="hidden" id="semester" value="<?php echo $semester;?>" />
          
          <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
          <input name="year" type="hidden" id="year"  value="<?php echo $year;?>"/>
          <input name="programme" type="hidden" id="programme"  value="<?php echo $programme;?>"/>
          <input name="start" type="hidden" id="start"  value="<?php echo $start+20;?>"/>
          <input name="list" type="hidden" id="list"  value="<?php echo $list;?>"/>
          
          <input type="submit" name="Submit" value="&gt;&gt;&gt;" />
          
          </form>      </td>
    </tr>
  </table>
  <?php exit; }
	?>
    
  <table width="80%" border="0" align="center">
    <tr>
      <th align="left"><span style="font-weight: bold">VIEW CARRY OVER RESULTS SUMMARY </span> </th>
    </tr>
    </table>
</div>
<form action="viewspgdco.php" method="post" name="grade" id="grade" target="_blank">
    <div align="center">
      <table>
        <tr>
          <td align="left"><span style="font-weight: bold">PROGRAMME:</span></td>
          <td align="left"><select name="programme" id="programme">
            <option selected="selected">Select Programme</option>
            
             <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
                    </select></td>
        </tr>
        <tr>
          <td align="left"><span style="font-weight: bold">SEMESTER:</span></td>
          <td align="left"><select name="semester" id="semester">
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
          <td align="left"><select name="session">
          <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
                     <?php echo include('includes/sessions.php');?>

            </select>
            -
            <select name="year" id="year">
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
            <input  type="hidden" name="start" value="0" />
          <input type="hidden" name="list" value="20" /></td>
        </tr>
      </table>
      <input name="Submit" value="Submit" type="submit" />
          </div>
</form>
  

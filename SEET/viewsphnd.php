<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require("includes/header.php");?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="icon" href="images/nipoly2 (1).GIF" type="image/x-jpg"/>

<title>Result Sheet</title>
</head>

<body>

  
  
  <div align="center">
  

        <?php 
	if(isset($_POST['Submit'])){
	
$semester=$_POST['semester'];
$session=$_POST['session'];
//$ccode=$_POST['code'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$start=$_POST['start'];
$list=$_POST['list'];
		if ((!$programme)){
	die("empty fields not allowed");
	}
	
	// add sessions to the query to diferentiate the courses registered per session 
	 
		$query= mysqli_query($conn,"SELECT * FROM course 
    WHERE programme='$programme' && semester	='$semester' && sessions = '$session'") or die (mysqli_error());
	
	
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
        </div>
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


        
<table id="t1" border="1" align="center" cellpadding="0" cellspacing="1" style=" width: auto; border:thin; border-collapse:collapse">
<thead>
	      <tr>
	        <td rowspan="2" ><div align="center" class="style1" style="font-weight: bold">S/N</div></td>
        <td rowspan="2" ><div align="center" class="style1" style="font-weight: bold">Matric_No</div></td>
      <?php while($row=mysqli_fetch_assoc($query)){  ?>  <td rowspan="2" ><div align="center" class="style1" style="font-weight: bold"><?php echo $row['code']."<br>"."(".$row['unit'].")";?></div></td>
      <?php }?>
	        <td colspan="3" ><div align="center" class="style1" style="font-weight: bold">Current_Semester </div></td>
        <td colspan="3" ><div align="center" class="style1" style="font-weight: bold">Previous_Semester </div></td>
        <td colspan="3" ><div align="center" class="style1" style="font-weight: bold">Current_Cumulative </div></td>
        <td colspan="5" ><div align="center" class="style1" style="font-weight: bold">REMARKS</div></td>
      </tr>
	      <tr>
	        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">cr</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">gp</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">gpa</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">cr</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">gp</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">gpa</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">cr</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">gp</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">gpa</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">co</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">EM</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">Sit</div></td>
        <td style="height: 13px" ><div align="center" class="style1" style="font-weight: bold">Pend</div></td>
        <td style="height: 13px" ><div align="center"><span class="style1"></span></div></td>
            </tr>
	  
</thead>
    <?php $n = $start; 
$msql=mysqli_query($conn,"SELECT * FROM `studentsnm` 
WHERE dept ='$programme'&& year='$year' && Withdrwan ='0' ORDER BY  `matno` ASC") or die(mysqli_error());


while ($col=mysqli_fetch_assoc($msql)){
$n= $n+1;
 ?>
<tbody>

  <tr style="font-size:8pt;">
	        <td bgcolor="#FFFFFF" style=" height: 25px;"><span class="style1"><?php echo $n;?></span></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div class="style1"><?php echo $col['matno'];?></div></td>
            <?php 
		$matno = $col['matno'];
		$sql= mysqli_query($conn,"SELECT * FROM results 
    WHERE programme='$programme' && semester='$semester'  && matric_no='$matno'") or die (mysqli_error());

		$unit=0;
		$gp=0;
		$rem =0;
		while ($res=mysqli_fetch_assoc($sql)){?>
			  <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $res['grade'];?></div></td>
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
	        <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $unit;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $gp;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $gpa;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $pcu;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $pcgp;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $pcgpa;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $ccu;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $ccgp;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1"><?php echo $ccgpa;?></div></td>
            <td bgcolor="#FFFFFF" style=" height: 25px;"><div align="center" class="style1">
              <?php include("includes/rmk.php"); ?>
            </div>
            
            </td>
            <td bgcolor="#FFFFFF" style="font-size: xx-small; height: 25px;"><div align="center">
              <?php 
		$matno = $col['matno'];
		$mysql= mysqli_query($conn,"SELECT * FROM results 
    WHERE programme='$programme' &&  matric_no='$matno'") or die (mysqli_error());
		
		  
		$qq= mysqli_query($conn,"SELECT SUM(unit) AS vaule_sum FROM course 
		WHERE programme='$programme' && semester ='$semester' && sessions = '$session'");
		$uu = mysqli_fetch_assoc($qq);
		$unn = $uu['vaule_sum'];
		
	//$unit=0;
		//$gp=0;
		$rem = 0;
		while ($result=mysqli_fetch_assoc($mysql)){ 
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")||($result['grade'] =="ABSE")||($result['grade'] =="EM")||($result['grade']=="AE")||($result['grade']=="PI")){
		$rem = $rem +1;
		$reslt =$result['grade'];
			}
		}
	
  
	  if ($semester <=2){
if($rem>=1){

	if(($gpa<=1.49)&&($semester==1)&&($unit == 0) ){

	echo "";

	}elseif(($gpa<=1.49)&&($semester>=1)){

	echo "ATW";
	}elseif(($unit > $unn)){
	echo "";	}
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
        
  <form action="viewexport1.php" method="post" name="grade1" id="grade" target="_blank">
  <input type="hidden" name="programme" value="<?php echo $programme;?>" />
 <input type="hidden" name="semester" value="<?php echo $semester;?>" />
 <input type="hidden" name="session" value="<?php echo $session;?>" />
 <input type="hidden" name="year" value="<?php echo $year;?>" />
 <input name="Submit" type="submit" id="Submit" value="Export Result to Word" />
  </form>


  
  <?php exit; }
	?>
    

<form action="viewsphnd.php" method="post" name="grade" id="grade" target="_blank">
    <div align="center">
      <table>
        <tr>
          <td align="left"><span style="font-weight: bold">PROGRAMME:</span></td>
          <td align="left"><select name="programme" id="programme">
            <option selected="selected"><?php // echo $_GET['depts'];?></option>
			
			
			
			 <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode' ") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
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
          <td align="left" style="height: 30px"><span style="font-weight: bold">SESSION:</span></td>
          <td align="left" style="height: 30px"><select name="session">
          <option selected="selected"></option>
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
      <input name="Submit" value="Submit" type="submit"/>
          </div>
</form>
  

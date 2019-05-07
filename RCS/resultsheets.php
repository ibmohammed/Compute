
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
	 if(isset($_POST['Submit2'])){
 $course = $_POST['programme'];
 $sem = $_POST['semester'];
  //$pict =$_POST['pics'];
  $sess = $_POST['session'];

//   $sel = mysqli_query($conn,"SELECT *  FROM course WHERE programme LIKE '$course' && sessions = '$sess' && semester = $sem",$db) or die(mysql_error());
?>

     <?php
$mat = $_POST['matricno'];
//$sess = $_POST['session'];
$sem = $_POST['semester'];
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
		<div align="center">
		<div style="float:left;">
			<img alt="image" height="72" src="RMSZ/images/nipoly2%20(1).GIF" width="80"/></div>
		<div style="float:left;">
		<b style="font-size:large">NIGER STATE POLYTECHNIC, ZUNGERU</b>
		<br/>
		<b style=" font-size:small">CENTRE FOR CONTINUING EDUCATION TRAINING</b>
		</div>
		
		<br/>
		
      <strong style = "color: #000FFF; font-size: medium">
      <br/>Semester Report</strong>
      <table align="center" width="100%">
                <tr>
                  <td align="left" id="page" style="height: 24px"><b>MATRIC No.:</b> </td>
                  <td align="left" id="page2" style="height: 24px"><span style="font-size: 16px"><strong><?php echo $mn[2] ;?></strong></span></td>
        </tr>
                     <tr align="left">
                  <td id="page"><b><strong>NAME: </strong></b></td>
                  <td id="page2"><span style="font-size: 16px"><strong><?php echo $mn[1];?></strong></span></td>
				  </tr>
                     <tr>
                       <td colspan="2" align="center" id="page"><table>
                         <tr>
                           <?php
                        if ($mn['semester'] == "1"){
                            $first = "st";
                        }elseif ($mn['semester'] == "2"){
                            $first = "nd";
                        }
                        elseif ($mn['semester'] =="3"){
                            $first = "rd";
                        }
						 elseif ($mn['semester'] =="4"){
                            $first = "th";
                        }
						 elseif ($mn['semester'] =="5"){
                            $first="th";
                        }
						 elseif ($mn['semester'] =="6"){
                            $first = "th";
                        }
                        ?>
                           <td align="left" class="style9" id="page2"><strong>SEMESTER:</strong></td>
                           <td align="left" class="style8" id="page1"><span style="color: #FF0000"><strong><?php echo $mn['semester'].$first." "."Semester" ;?></strong></span></td>
                           <td align="left" class="style9" id="page"><strong><span style="color: #000000">SESSION</span>: </strong></td>
                           <td align="left" class="style9" id="page2" style="width: 10px"><span class="style6"><span style="color: #FF0000"><?php echo $mn['session'] ;?></span></td>
                         </tr>
                       </table>
                      
                       </td>
                     </tr>
      </table>
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
		
		$gqry = "SELECT * FROM results WHERE programme='$course' && semester='$sem' && matric_no='$mat'";
		$sql= mysqli_query($conn,$gqry) or die (mysqli_error());
	
		$unit=0;
		$gp=0;
		 while ($res=mysqli_fetch_assoc($sql)){ 
	
	
	
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
  <?php exit; }?>
  <table width="70%" border="0" align="center">
    <tr>
      <td><span style="font-weight: bold; color: #FFFFFE; font-size: x-small">
     
	
      <h3 align="left"> <font color="#000000">Print Result</font></h3>
      
<form action="resultsheets.php" method="POST" name="grade" id="grade" target="_blank">
     <table>
<tr>
<td align="left"><span class="style3"><strong>PROGRAMME:</strong></span></td>
<td align="left"><strong>
  <select name="programme" id="programme">
                
          
            
              <option selected="selected"><?php echo $prgs;?></option>
              
             
            </select>
</strong></td>
</tr>

<tr>
<td align="left"><span class="style3"><strong>MATRIC NO:</strong></span></td>
<td align="left"><strong>
  <input name="matricno" id="matricno"  value="<?php echo $_SESSION['matno'];?>" />
    </strong></td>
</tr>
<tr>
  <td align="left"><span class="style3"><strong>SEMESTER:</strong></span></td>
  <td align="left"><strong>
    <select name="semester" id="semester">
      <option>Select Semester</option>
      <option value="1">First Semester</option>
      <option value="2">Second Semester</option>
      <option value="3">Third Semester</option>
      <option value="4">Fouth Semester</option>
      <option value="5">Fifth Semester</option>
      <option value="6">Sixth Semester</option>
    </select>
      </strong></td>
</tr>
<tr>
  <td align="left"><span class="style3"><strong>SESSION:</strong></span></td>
  <td align="left"><strong>
    <select name="session">
    <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
              <?php echo include('includes/sessions.php');?>

    </select>
  </strong></td>
</tr>
</table>

     <input name="Submit2" type="submit" id="Submit2" value="Submit">
    </form>
</td>
    </tr>
</table>
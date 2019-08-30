
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php// include("header.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="RMSZ/images/nipoly2 (1).GIF" type="image/x-jpg"/>
<title>Untitled Document</title>
<?php
//$mat = $_POST['matricno'];
//$sess = $_POST['session'];
//$sem = $_POST['semester'];
$qry = "SELECT * FROM  `studentsnm`";
$sqm=mysqli_query($logs,$qry) or die(mysqli_error($logs));
$img = mysqli_fetch_array($sqm);
$equry = "SELECT * FROM results WHERE matric_no LIKE '$mat'  AND session LIKE '$sess' AND semester = '$sem'";
$mtr = mysqli_query($logs,$equry);
if (!$mtr){
 die("query failled".mysqli_error($logs));
}
$mn = mysqli_fetch_array($mtr);
?>
      <?php
        if ($mat !== $mn['matric_no']) {
         die ("No Records found pls make sure The entries are correct");
        }
        ?>
        <table class="table table-bordered" border="1" cellspacing="0" cellpadding="1" align="center">
        <thead>
         <tr>
            <th id="page3"><big>Codes</big></th>
            <th id="page3"><big> Course Names</big></th>
            <th id="page3"><big>Unit</big></th>
            <th id="page3"><big>Mark</big></th>
            <th id="page3"><big>Grade</big></th>
            <th id="page3"><big>Points</big></th>
            <th id="page3"><big>Weighted Points</big></th>
          </tr> 
          </thead>
          <tbody>
          <?php
//	 $msq = mysql_query("SELECT * FROM course WHERE dept_id LIKE '$course' AND semester = $sem",$db);
$ssql = "SELECT *  FROM course WHERE	 `prog_id` LIKE '$course' AND
							 `semester` = $sem && `sessions` LIKE '$sess'";
        $msq = mysqli_query($logs,$ssql) or die(mysqli_error($logs));

	  $rsql = "SELECT * FROM results WHERE matric_no LIKE '$mat'   AND semester = $sem";
$msql = mysqli_query($logs,$rsql)  or die(mysqli_error($logs));;

	  while (($row= mysqli_fetch_assoc($msq)) && ($col= mysqli_fetch_assoc($msql))){?>
          <tr>
            <td id="page4"><?php echo $row['code'];?></td>
            <td id="page4"><?php echo $row['title'];?></td>
            <td id="page4"><?php echo $col['unit'];?></td>
            <td id="page4"><?php echo $col['score']; ;?></td>
            <td id="page4"><?php echo $col['grade']; ;?></td>
            <td id="page4"><?php echo $col['points']; ;?></td>
            <td id="page4"><?php echo $col['points']*$col['unit']; ;?></td>
          </tr>
          <?php }?>
          </tbody>
        </table>
        <hr>
        <table class="table table-bordered" border="1" align="center" cellpadding="1" cellspacing="0" >
          <thead>
          <tr>
            <th id="page1">T C U &nbsp;</th>
            <th id="page1">T  P</th>
            <th id="page1">GPA</th>
            <th id="page1">CGPA&nbsp;</th>
          </tr>
          </thead>
        <tbody>
          <?php
          $session = $mn['session'];
          $semester = $sem;
          $programme = $course;
          $matno = $mat;
          $gqry_result = calculate_gp($logs, $course, $sem, $mat);
          //$sql= mysqli_query($logs,$gqry) or die (mysqli_error());
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
          <tbody>
        </table>
  <?php //exit; ?>
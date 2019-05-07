<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("header.php");?>

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

<!--
.style1 {color: #FF0000}
.style2 {color: #000066}
.style7 {font-size: 18px}
.style8 {font-size: 16px}
.style9 {font-size: 16px; font-weight: bold; }
-->
</style>


<?php
$session = $mn['session'];
$sem = '';
$semester = $sem;
$programme = $course;
$matno = $mat;

$gqry_result = calculate_gp_all($conn, $course, $mat);
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

require_once("includes/cpgpa.php");

?>

<?php //echo @$unit; @$gp  echo @$gpa ;
?>

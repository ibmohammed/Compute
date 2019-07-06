<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>

<p><a href="smanage.php?courser">Register Courses</a>
<br></p>
<?php 


if (isset($_POST['Submit2'])){
$count=$_POST['count'];
$count = preg_replace("/[^0-9]/", "", $count);
$count = $count-1;
$m=0;

while($m<=$count){

$m=$m+1;
$t="title".$m;
$c="code".$m;
$s="sn".$m;
$u="unit".$m;
$se ="ses".$m;
$sems = "sems".$m;
// New Values

$unit=$_POST[$u];
$title=$_POST[$t];
$code=$_POST[$c];
$sn=$_POST[$s];
$sessions=$_POST[$se];
$semesters =$_POST[$sems];
// old values

$t="titles".$m;
$c="codes".$m;
$u="units".$m;
$ss="sess".$m;
$units=$_POST[$u];
$titles=$_POST[$t];
$codes=$_POST[$c];
$sess = $_POST[$ss];

// Update result Table
//$updtres =mysqli_query($conn,"UPDATE `results` SET `unit` = '$unit', `code`='$code' WHERE `results`.`code` ='$codes'");
// Update Course Table;

$query= mysqli_query($conn,"UPDATE  `course` SET  `code` =  '$code',`title` =  '$title',`unit`='$unit',`sessions`='$sessions' 
WHERE  `course`.`sn` ='$sn'") or die(mysqli_error($conn));
//echo $sn;
	}
echo "<font color = 'red'>"."<i>"."Update Successful"."</i>"."</font>";


}elseif (isset($_POST['Submit3'])){

if (!isset($_SESSION)) {
  session_start();
}

$prog = $_SESSION['prog'];

$count=$_POST['count'];
$semester = $_SESSION['semester'];
//$_POST['programme']
$count = $count-1;
$m=0;
while($m<=$count){
$m=$m+1;
$t="title".$m;
$c="code".$m;
$s="sn".$m;
$u="unit".$m;
$se ="ses".$m;
$sems = "sems".$m;
// New Values

$unit=$_POST[$u];
$title=$_POST[$t];
$code=$_POST[$c];
$sn=$_POST[$s];
$sessions=$_POST[$se];
$semesters =$_POST[$sems];

// old values
$t="titles".$m;
$c="codes".$m;
$u="units".$m;
$ss="sess".$m;
$units=$_POST[$u];
$titles=$_POST[$t];
$codes=$_POST[$c];
$sess = $_POST[$ss];
// Insert into Table course
$updtres =mysqli_query($conn,"INSERT INTO `course` (`prog_id`, `unit`, `semester`, `code`, `title`, `sessions`) 
VALUES ('$prog', '$unit', '$semesters', '$code', '$title', '$sessions');");

// Update Course Table
//$query= mysqli_query($conn,"UPDATE  `course` SET  `code` =  '$code',`title` =  '$title',`unit`='$unit',`sessions`='$sessions'
 //WHERE  `course`.`sn` ='$sn'") or die(mysqli_error());

	}
echo "<font color = 'red'>"."<i>"."Successful"."</i>"."</font>";


}elseif(isset($_GET['id'])){
	
$ids = $_GET['id'];
$ids = preg_replace("/[^0-9]/", "", $ids);



if (!isset($_SESSION)) {
  session_start();
}

//$_SESSION['prog'];
//$_SESSION['semester'];
//$_SESSION['session'];


$qry = mysqli_query($conn,"DELETE FROM course WHERE `sn` = '$ids'") or die(mysqli_error());	
	echo "<font color = 'red'>"."<i>"."Update Successful"."</i>"."</font>";

echo '<div> <form action="" method="post"><input type = "hidden" name = "programe" value = "'.$_SESSION['prog'].'" >
<input type = "hidden" name = "semester" value = "'.$_SESSION['semester'].'" >
<input type = "hidden" name = "session" value = "'.$_SESSION['session'].'" >
<input type="submit" name="Submit" value=" OK " />	
</form>
 </div>' ;
	}

if (isset($_POST['Submit'])){

$prog=$_POST['programe'];
$prog = preg_replace("/[^0-9]/", "", $prog);
$semester=$_POST['semester'];
$semester = preg_replace("/[^0-9]/", "", $semester);
$session = $_POST['session'];
$session = preg_replace("/[^0-9\/]/", "", $session);

if (!isset($_SESSION)) {
  session_start();
}

$_SESSION['prog'] = $prog;
$_SESSION['semester'] = $semester;
$_SESSION['session'] = $session;


$sql = mysqli_query($conn,"SELECT * FROM  `course` WHERE prog_id='$prog' && semester ='$semester' && sessions = '$session'");
if(!$sql){
die(mysqli_error());
}?>


include("addviewedit_xtend.php");
?>
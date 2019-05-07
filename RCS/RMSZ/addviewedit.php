<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>
    
<style type="text/css">
<!--
.style1 {color: #FFBB55}
.style3 {color: #FFBB55; font-weight: bold; }
.auto-style1 {
	font-weight: bold;
}
-->
</style>

<p><a href="index.php?courser">Register Courses</a>
<br></p>
<?php 
if (isset($_POST['Submit2'])){
$count=$_POST['count'];
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
$updtres =mysqli_query($conn,"INSERT INTO `course` (`sn`, `Programme`, `unit`, `semester`, `code`, `title`, `sessions`) 
VALUES (NULL, '$prog', '$unit', '$semesters', '$code', '$title', '$sessions');");

// Update Course Table
//$query= mysqli_query($conn,"UPDATE  `course` SET  `code` =  '$code',`title` =  '$title',`unit`='$unit',`sessions`='$sessions'
 //WHERE  `course`.`sn` ='$sn'") or die(mysqli_error());

	}
echo "<font color = 'red'>"."<i>"."Successful"."</i>"."</font>";


}elseif(isset($_GET['id'])){
	
$ids = $_GET['id'];

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
$semester=$_POST['semester'];
$session = $_POST['session'];

if (!isset($_SESSION)) {
  session_start();
}

$_SESSION['prog'] = $prog;
$_SESSION['semester'] = $semester;
$_SESSION['session'] = $session;


$sql = mysqli_query($conn,"SELECT * FROM  `course` WHERE Programme='$prog' && semester ='$semester' && sessions = '$session'");
if(!$sql){
die(mysqli_error());
}?>


<form id="form2" name="form2" method="post" action="">
              <table border="1" style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1" >
                <tr>
                  <td style="height: 23px"><span style="font-weight: bold">S/N</span></td>
                  <td style="height: 23px"><span style="font-weight: bold">Course Title</span></td>
                  <td style="height: 23px; width: 89px;">
				  <span style="font-weight: bold">Course <br>Code </span></td>
                  <td style="height: 23px" class="auto-style1">Unit</td>
                  <td style="height: 23px; width: 80px;" class="auto-style1">Session</td>
                  <td style="height: 23px; width: 58px;" class="auto-style1">Semester</td>
                  <td style="height: 23px; width: 58px;" class="auto-style1">Delete</td>
                </tr>
                <?php 
		$n = 0;
		while ($row=mysqli_fetch_assoc($sql)){
		$n= $n+1;
		?>
                <tr>
                  <td ><?php echo $n;?>
                    <input name="<?php echo 'sn'.$n;?>" type="hidden"  value="<?php echo $row['sn'];?>"/></td>
                  <td ><input style="border:thin;" name="<?php echo 'title'.$n;?>" type="text"  value="<?php echo $row['title'];?>" size="50"/>
                  <input name="<?php echo 'titles'.$n;?>" type="hidden"  value="<?php echo $row['title'];?>" size="50"/></td>
                  <td  style="width: 89px"><input style="border:thin;" name="<?php echo 'code'.$n;?>" type="text" value="<?php echo $row['code'];?>" size="6" />
                  <input name="<?php echo 'codes'.$n;?>" type="hidden" value="<?php echo $row['code'];?>" /></td>
                  <td ><input style="border:thin;" name="<?php echo 'unit'.$n;?>" type="text" value="<?php echo $row['unit'];?>" size="4" />
                    <input name="<?php echo 'units'.$n;?>" type="hidden" value="<?php echo $row['unit'];?>" /></td>
                  <td bgcolor="#FFFFFF" style="width: 80px" >
				  <input style="border-style: none; border-color: inherit; border-width: thin; width: 83px;" name="<?php echo 'ses'.$n;?>" type="text" value="<?php echo $row['sessions'];?>" size="4" />
				  <input name="<?php echo 'sess'.$n;?>" type="hidden" value="<?php echo $row['sessions'];?>" /></td>
                  <td bgcolor="#FFFFFF" style="width: 58px" >
				  <input style="border:thin;" name="<?php echo 'sems'.$n;?>" type="text" value="<?php echo $semester;?>" size="4" /></td>
                  <td bgcolor="#FFFFFF" style="width: 58px" ><a href="index.php?id=<?php echo $row['sn'].'&updtcourse';?>">&nbsp;&nbsp;&nbsp;<img src="images/del.jpg" width="16" height="14" alt="del" /></a>
                  <input name="<?php echo 'sn'.$n;?>" type="hidden" value="<?php echo $row['sn'];?>" /></td>
                </tr>
                <?php }?>
              </table>
            <input name="count" type="hidden" value="<?php echo $n;?>" />
            <br>
              <input type="submit" name="Submit2" value="Edit Records" style="border:thin; color:navy;" />
              <input type="submit" name="Submit3" value="Add Records" style="border:thin; color:navy;" />
              
              </form>
      <p><br>
      </p>
      <?php
exit;
}
?>
      <form id="form1" name="form1" method="post" action="">
              <table border="0" style="border-collapse:collapse;">
                <tr>
                  <td ><span style="font-weight: bold">Programme:</span></td>
                  <td style="width: 130px" ><select name="programe" id="programe">

 <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
            

<?php
		//	include('prog1.php');
		//	include('prog2.php');
		//	include('prog3.php');
			 ?>                  </select></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Semester:</span></td>
                  <td style="width: 130px" ><select name="semester">
                      <option>Choose Semester</option>
                      <option value="1">First Semester</option>
                      <option value="2">Second Semester</option>
                      <option value="3">Third Semester</option>
                      <option value="4">Fourth Semester</option>
                      <option value="5">Fifth Semester</option>
                      <option value="6">Sixth Semester</option>
                  </select></td>
                </tr>
              	<tr>
                  <td  style="height: 26px">Session:</td>
                  <td  style="height: 26px; width: 130px;"><select name="session">
				  <option selected="selected"></option>
				  <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
				  <option>2017/2018</option>
				  <option>2018/2019</option>
				   </select></td>
                  </tr>
                <tr>
                  <td >&nbsp;</td>
                  <td style="width: 130px" >&nbsp;</td>
                </tr>
              </table>
            <input type="submit" name="Submit" value="Submit" />
              </form>

      

<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php //require("includes/header.php");?>    


<p><a href="index.php?courser">Register Courses</a>
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
// New Values
$unit=$_POST[$u];
$title=$_POST[$t];
$code=$_POST[$c];
$sn=$_POST[$s];
// old values
$t="titles".$m;
$c="codes".$m;
$u="units".$m;

$units=$_POST[$u];
$titles=$_POST[$t];
$codes=$_POST[$c];

// Update result Table
//$updtres =mysqli_query($logs,"UPDATE `results` SET `unit` = '$unit', `code`='$code' WHERE `results`.`code` ='$codes'");
// Update Course Table
$query= mysqli_query($logs,"UPDATE  `course` SET  `code` =  '$code',`title` =  '$title',`unit`='$unit' WHERE  `course`.`sn` ='$sn'")
or die(mysqli_error($logs));

// update result table heere

	}
echo "<font color = 'red'>"."<i>"."Update Successful"."</i>"."</font>";


}elseif(isset($_GET['id'])){
	
$ids = $_GET['id'];
$ids = preg_replace("/[^0-9]/", "", $ids);


if (!isset($_SESSION)) {
  session_start();
}

//$_SESSION['prog'];
//$_SESSION['semester'];
//$_SESSION['session'];


$qry = mysqli_query($logs,"DELETE FROM course WHERE `sn` = '$ids'") or die(mysqli_error($logs));	
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


$sql = mysqli_query($logs,"SELECT * FROM  `course` WHERE prog_id='$prog' && semester ='$semester' && sessions = '$session'");
if(!$sql){
die(mysqli_error($logs));
}?>
<hr>
&nbsp;
<hr>

<form id="form2" name="form2" method="post" action="">
              <table class="table table-bordered">
                <tr>
                  <td>S/N</td>
                  <td>Course Title</td>
                  <td>Course Code </td>
                  <td>Unit</td>
                  <td>Delete</td>
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
                  <input name="<?php echo 'titles'.$n;?>" type="hidden"  value="<?php echo $row['title'];?>" /></td>
                  <td  style="width: 89px"><input style="border:thin;" name="<?php echo 'code'.$n;?>" type="text" value="<?php echo $row['code'];?>" size="6" />
                  <input name="<?php echo 'codes'.$n;?>" type="hidden" value="<?php echo $row['code'];?>" /></td>
                  <td ><input style="border:thin;" name="<?php echo 'unit'.$n;?>" type="text" value="<?php echo $row['unit'];?>" size="2" />
                    <input name="<?php echo 'units'.$n;?>" type="hidden" value="<?php echo $row['unit'];?>" /></td>
                  <td><a href="index.php?id=<?php echo $row['sn'].'&updtcourse';?>">&nbsp;&nbsp;&nbsp;<img src="images/del.jpg" width="10" height="8" alt="del" /></a>
                  <input name="<?php echo 'sn'.$n;?>" type="hidden" value="<?php echo $row['sn'];?>" /></td>
                </tr>
                <?php }?>
              </table>
            <input name="count" type="hidden" value="<?php echo $n;?>" />
            <br>
              <input type="submit" name="Submit2" value="Edit Records" class="btn btn-gradient-primary mr-2" />
              </form>
      <p><br>
      </p>
      <hr>
&nbsp;
<hr>
      <?php
//exit;
}
?>
<hr>
      <form id="form1" name="form1" method="post" action="">
              <table class="table table-bordered">
                <tr>
                  <td ><span style="font-weight: bold">Programme:</span></td>
                  <td>
                  <select name="programe" id="programe" class="form-control">
                  <option selected="selected" value="">Select Proramme</option>
             <?php include('dptcode.php') ;
            
            
            //$queri = mysqli_query($logs,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            //$queri = mysqli_query($logs,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            //while($prgasc = mysqli_fetch_assoc($prgqry))
            $queri = prog_function($logs);
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
              
              <?php }?>
              
             
            
                 </select></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Semester:</span></td>
                  <td>
                  <select name="semester"  class="form-control">
                  <option selected="selected" value="">Choose Semester</option>
                      <option value="1">First Semester</option>
                      <option value="2">Second Semester</option>
                      <option value="3">Third Semester</option>
                      <option value="4">Fourth Semester</option>
                      <option value="5">Fifth Semester</option>
                      <option value="6">Sixth Semester</option>
                  </select></td>
                </tr>
              	<tr>
                  <td ><span style="font-weight: bold">Session:</span></td>
                  <td >
                    <select name="session" class="form-control">
                      <option selected="selected" value="">Select Session</option>
                      <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                      <option>2010/2011</option>
                      <option>2017/2018</option>
                      <option>2018/2019</option>
                    </select>
                  </td>
                  </tr>
                <tr>
                  <td >&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <br>
              <p><input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2" /></p>
              </form>
              <p></p>
              <hr>
&nbsp;
<hr>
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<?php //include("includes/header.php"); ?>    





<p><a href="index.php?addviewwdit">Edit Courses</a>
<br></p>
<?php 

if(isset($_POST['Submit'])){
$prog=$_POST['programe'];
$prog = preg_replace("/[^0-9]/", "", $prog);

$title=$_POST['title'];
$title = preg_replace("/[^a-zA-Z0-9\s]/", "", $title);

$code=$_POST['code'];
$code = preg_replace("/[^a-zA-Z0-9\s]/", "", $code);

$unit=$_POST['unit'];
$unit = preg_replace("/[^0-9]/", "", $unit);

$semester=$_POST['semester'];
$semester = preg_replace("/[^0-9]/", "", $semester);

$session = $_POST['session'];
$session = preg_replace("/[^0-9\/]/", "", $session);


if ($prog =="" || $title == "" || $session == "" || $semester == "" || $code == "" || $unit == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?courser");
    </script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
  }
  

$staffs_id = 0;

// Check if records exist in the data base

$msql=mysqli_query($logs,"SELECT * FROM `course` 
WHERE prog_id ='$prog' && 
semester='$semester' && 
code = '$code' && sessions = '$session'") or die(mysqli_error($logs));

$valid = mysqli_fetch_assoc($msql);
if ($code ==$valid['code']){
echo "<i><font color='red'>course cannot be registaerd twice</i></font>"; 
}else{

//insert records into the database

$query=mysqli_query($logs,"INSERT INTO `course` (`prog_id`, `unit`, `semester`, `code`, `title`,`sessions`, `staff_id`) 
VALUES ('$prog', '$unit', '$semester', '$code', '$title','$session', '$staffs_id')") or die(mysqli_error($logs));
}

?>
      <table class="table table-bordered" >
        <tr >
          <td style="height: 25px"><span style="font-weight: bold;">S/n</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Title</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Code</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Unit</span></td>
        </tr>
        <?php 
        
        $sql=mysqli_query($logs,"SELECT * FROM `course` 
            WHERE prog_id ='$prog' && 
            semester='$semester' && 
            sessions = '$session'") or die(mysqli_error($logs));

                  
            $n= 0 ;
            while($row=mysqli_fetch_assoc($sql)){
            $n = $n+1;
            ?>

        <tr >
          <td><span style="font-weight: bold;"><?php echo $n;?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['title'];?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['code'];?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['unit'];?></span></td>
        </tr>
        <?php }?>
      </table>
      <?php ?>
    
<!--
          <form action="" method="post" name="form2" id="form2" onSubmit="MM_validateForm('title','','R','code','','R','code','','R');return document.MM_returnValue" onfocus="MM_validateForm('0','','R','0','','R','1','','R','1','','R','0','','R','1','','R');return document.MM_returnValue">
              <table class="table table-bordered" >
                <tr>
                  <td><span style="color: #FFFFFF">Programme:</span></td>
                  <td><span style="color: #FFFFFF">
                    <label>
                    <input name="programe" type="hidden" id="programe" value="<?php //echo $prog;?>" class="form-control"/>
                    </label>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Title: </span></td>
                  <td ><input name="title" class="form-control" value="" type="text" id="title" size="50"  placeholder="Course Title"/></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Code: </span></td>
                  <td ><span style="vertical-align: top;">
                    <input name="code" class="form-control" id="code" value="" maxlength="9" placeholder="Course Code"/>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Unit:</span></td>
                  <td >
                    <select name="unit" id="select2" class="form-control">
                    <option selected="selected" value="">Choose Unit</option>
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                  </select></td>
                </tr>
                <tr>
                  <td><span style="color: #FFFFFF">Semester:</span></td>
                  <td><span style="color: #FFFFFF">
                    <label>
                    <input name="semester" type="hidden" id="semester"  value="<?php //echo $semester;?>"/>
                     <input name="session" type="hidden" id="session"  value="<?php //echo $session;?>"/>
                    </label>
                  </span></td>
                </tr>
              </table>
            <label>
              <input class="btn btn-gradient-primary mr-2" name="Submit" type="submit" id="Submit" value="Add Course" />
              </label>
          </form>
-->
<?php 
//exit(); 

}
?>
<br>
<p></p>
<hr>
          
          <form action="" method="post" name="form1" id="form1" onSubmit="MM_validateForm('0','','R','0','','R','1','','R','1','','R','0','','R','1','','R');MM_validateForm('title','','R','code','','R','title','','R','code','','R','code','','R','code','','R');return document.MM_returnValue">

              <table class="table table-bordered" >
                <tr>
                  <td ><span style="font-weight: bold">Programme:</span></td>
                          <td ><span style="font-weight: bold">
                  <select name="programe" id="programe"  class="form-control" >
                      <option value="">Select programme</option>
                      <option value="">Select programme</option>
                      <?php include('dptcode.php') ;
                
            
                      // $queri = mysqli_query($logs,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
                       //while($prgasc = mysqli_fetch_assoc($prgqry))
                       $queri = prog_function($logs);
                      while($pcd = mysqli_fetch_assoc($queri)){
                         ?>
                        <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
                        <?php }?> 
                   </select>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Title: </span></td>
                  <td ><input name="title" type="text" class="form-control" id="title" value="" size="50"  placeholder="Course Title"/></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Code: </span></td>
                  <td ><span style="vertical-align: top;; font-weight: bold">
                    <input name="code" class="form-control" id="code" value="" maxlength="9" placeholder="Course Code"/>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Unit:</span></td>
                  <td ><span style="font-weight: bold">
                    <select name="unit" id="unit" class="form-control">
                    <option selected="selected" value="">Choose Unit</option>
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                    </select>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Semester:</span></td>
                  <td ><span style="font-weight: bold">
                    <select name="semester" class="form-control">
                    <option selected="selected" value="">Choose Semester</option>
                      <option value="1">First Semester</option>
                      <option value="2">Second Semester</option>
                      <option value="3">Third Semester</option>
                      <option value="4">Fourth Semester</option>
                      <option value="5">Fifth Semester</option>
                      <option value="6">Sixth Semester</option>
                    </select>
                  </span></td>
                </tr>
                <tr>
                  <td ><strong>Session:</strong></td>
                  <td >
                    <select name="session" class="form-control">
                    <option selected="selected" value="">Select Session</option>    
				  <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
          <option>2010/2011</option>
          <option>2017/2018</option>
				    <option>2018/2019</option>
				     <option>2019/2020</option>
				      <option>2020/2021</option>
				   </select></td>
                </tr>
              </table>
              <br>
            <label>
              <p><input class="btn btn-gradient-primary mr-2" name="Submit" type="submit" id="Submit" value="Add Course" /></p>
              </label><br>
          </form>

          
<br>
<p></p>
<hr>
        
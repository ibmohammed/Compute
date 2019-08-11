<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    


<?php 
if(isset($_POST['Submit2']))
{	
  $name = $_POST['names'];
  $name =  preg_replace("/[^a-zA-Z\s]/", "", $name);
  $matno=$_POST['mat'];
  $matno =  preg_replace("/[^a-zA-Z0-9\s\/]/", "", $matno);
  $sex=$_POST['sex'];
  $sex =  preg_replace("/[^a-zA-Z\s]/", "", $sex);
  $matno2=$_POST['mat2'];
  $matno2 =  preg_replace("/[^a-zA-Z0-9\s\/]/", "", $matno2);
  $id = $_POST['id'];
  $id =  preg_replace("/[^0-9\s]/", "", $id);
  $atw = $_POST['atw'];
  $atw =  preg_replace("/[^0-9\s]/", "", $atw);
  $session = $_POST['session'];
  $session =  preg_replace("/[^0-9\s\/]/", "", $session);
  $year = $_POST['year'];
  $year =  preg_replace("/[^0-9\s]/", "", $year);
  $progr = $_POST['prg'];
  $progr =  preg_replace("/[^a-zA-Z\s]/", "", $progr);
  $progr2 = $_POST['dept'];
  $progr2 =  preg_replace("/[^a-zA-Z\s]/", "", $progr2);


  $sql=mysqli_query($conn,"UPDATE `studentsnm` SET `names` = '$name',`matno` = '$matno',
  `Withdrwan`='$atw',`sex`='$sex', `session` = '$session', `year` = '$year' 
  WHERE `studentsnm`.`sn` ='$id' ") or die (mysqli_error());

  if($atw==0)
  {
    $msql=mysqli_query($conn,"UPDATE `results` SET `name` = '$name',
    `matric_no` = '$matno'  
    WHERE `results`.`matric_no` ='$matno2'") or die (mysqli_error());
  }
  else
  {
    $msql=mysqli_query($conn,"UPDATE `results` SET `name` = '$name',
    `matric_no` = '$matno', stat = '$atw' 
    WHERE `results`.`matric_no` ='$matno2'") or die (mysqli_error());
  }

  echo "<font color = 'red'><i>"."Successful!!"."</i></font>";
  echo '<h5 style="font-style:italic; color:green" >Department of '.$_POST['dept'].', class of '.$_POST['year'].' records</h5>';

  ?>
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Matric Number.." class="form-control">
  <table  class="table table-bordered" id="myTable" >
    <tr>
      <th><span style ="color:black;">Id</span></th>
      <th><span style ="color:black;">Name</span></th>
      <th><span style ="color:black;">MatricNo</span></th>
      <th><span style ="color:black;">Session</span></th>
      <th><span style ="color:black;">Year</span></th>
      <th><span style ="color:black;">STATUS</span></th>
      <th><span style ="color:black;">EDIT</span></th>
      <th><span style ="color:black;">DELETE</span></th>
    </tr>
  <?php
  $dept = $_POST['dept'];
  $year=$_POST['year'];
  $session=$_POST['session'];
  //	$sql=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE prog_id = '$dept' && year ='$year' ORDER BY `matno` ASC");
  $n=0;
  $edit_student = edit_students($conn, $dept, $year);
  while($row = mysqli_fetch_array($edit_student, MYSQLI_ASSOC))
  {
    // while ($row=mysqli_fetch_assoc($sql)){
    $n=$n+1;
    ?>
      <tr>
        <td style="height: 16px" ><span class="style4"><?php echo $n;?></span></td>
        <td style="height: 16px" ><span class="style4"><?php echo $row['names'];?></span></td>
        <td style="height: 16px" ><span class="style4"><?php echo $row['matno'];?></span></td>
        <td style="height: 16px" ><span class="style4"><?php echo $row['session'];?></span></td>
        <td style="height: 16px" ><span class="style4"><?php echo $row['year'];?></span></td>
        <td style="height: 16px" ><span class="style1">
        <?php
        $status=$row['Withdrwan']; 
        if($status==0)
        {
          echo "<font color='#000000'>Active</font>";
        }
        elseif($status==1)
        {
          echo "<font color='#FF0000'>In_Active</font>";
        }?>
        </span></td>
        <td style="height: 16px" >
          <a href="index.php?edits= &id=<?php echo $row['sn']."&"."Edit="."edit"."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style4">EDIT</a>
        </td>
        <td style="height: 16px" >
          <a href="index.php?id=<?php echo $row['sn']."&"."deletes="."del"."&"."matno=".$row['matno']."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style4">DELETE</a>
        </td>
      </tr><?php  
  }?>
  </table>
  <br/>

  <?php // exit; 
}
elseif(isset($_GET['deletes']))
{
  $id = $_GET['id'];
  $matno = $_GET['matno'];

  $query=mysqli_query($conn,"DELETE FROM `studentsnm` WHERE sn = '$id'") or die (mysqli_error());

  $query=mysqli_query($conn,"DELETE FROM `results` WHERE matric_no = '$matno'") or die (mysqli_error());

  echo "<font color = 'red'><i>"."Deleted"."</i></font>";
}
elseif (isset($_GET['Edit']))
{
  $id = $_GET['id'];
  $id =  preg_replace("/[^a-zA-Z0-9\s]/", "", $id);
  $query=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE sn = '$id'") or die (mysqli_error());
  $row=mysqli_fetch_assoc($query);

  $pg = proggpid_function($logs, $row['prog_id']);
  $rows= mysqli_fetch_assoc($pg);
  echo $row['prog_id'];
  ?>
  <form id="form1" name="form1" method="post" action="">
    <table  class="table table-bordered" >
      <tr>
        <td style="height: 29px" ><strong>PROGRAMME:</strong></td>
        <td style="height: 29px" >
        <input style="height:auto;" name="dept" type="hidden" id="dept"  value="<?php echo $row['prog_id'];?>" size="50" readonly="1"/>
        <select name="prg" id="prg" class="form-control">
        <?php include('dptcode.php') ;
        $queri = proggpid_function($logs, $row['prog_id']);
        // $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE dep = '$departmentcode'") or die(mysqli_error());
        while($pcd = mysqli_fetch_assoc($queri))
        {
          ?>
          <option selected="selected">	<?php echo $pcd['programme'];?>
          </option>
          <option><?php echo $pcd['programme'];?></option>
          <?php 
        }?>
        </select>
        <input name="id" type="hidden" id="id" value="<?php echo $row['sn'];?>" />              
        </td>
      </tr>
      <tr>
        <td style="height: 29px" ><strong>NAME:</strong></td>
        <td style="height: 29px" ><input name="names" style="height:auto;" type="text" id="names"  value="<?php echo $row['names'];?>" size="30" class="form-control"/>              </td>
      </tr>
      <tr>
        <td ><strong>GENDER:</strong></td>
        <td ><input name="sex" style="height:auto;" id="sex" value="<?php echo $row['sex'];?>" size= "15" class="form-control"/></td>
      </tr>
      <tr>
        <td ><strong>MATRIC NO: </strong></td>
        <td ><input name="mat" style="height:auto;" id="mat" value="<?php echo $row['matno'];?>" size= "15" class="form-control"/>
        <input name="mat2" id="mat2" value="<?php echo $row['matno'];?>" size= "15" type="hidden" />
        <input name="year"  type="hidden"id="year" value="<?php echo $row['year'];?>" size= "8" />
        <span class="style3">*</span></td>
      </tr>
      <tr>
        <td ><strong>SESSION:</strong></td>
        <td >
          <select name="session" class="form-control" id="session">
            <option selected="selected"><?php echo $row['session'];?></option>
            <?php echo include('includes/sessions.php');?>
          </select>
          - 
          <select name="year" class="form-control" id="year">
            <option selected="selected"><?php echo $row['year'];?></option>
            <?php 
              for($i = 10; $i<=25; $i++)
              {
                echo "<option>".$i."</option>";
              }
              //include('includes/sessions.php');
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><strong>STATUS:</strong> </td>
        <td>
          <select name="atw" class="form-control" id="atw">
            <option value="0" selected="selected">Active</option>
            <option value="1">InActive</option>
          </select>               
        </td>
      </tr>
    </table>
    <input type="submit" name="Submit2" value="Update" class="btn btn-gradient-primary mr-2"/>
  </form>
  <?php //exit;  
}
elseif (isset($_POST['Submit']))
{
  echo '<h5 style="font-style:italic; color:green" >Department of '.$_POST['dept'].', class of '.$_POST['year'].' records</h5>';
  ?>
  <table class="table table-bordered">
    <tr>
    <td>

      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Matric Number.." class="form-control">
      <table  class="table table-bordered" id="myTable">
        <tr>
          <td><span style ="color:black;">Id</span></td>
          <td><span style ="color:black;">Name</span></td>
          <td><span style ="color:black;">MatricNo</span></td>
          <td><span style ="color:black;">Session</span></td>
          <td><span style ="color:black;">Year</span></td>
          <td><span style ="color:black;">STATUS</span></td>
          <td><span style ="color:black;">EDIT</span></td>
          <td><span style ="color:black;">DELETE</span></td>
        </tr>
      <?php
      $dept = $_POST['dept'];
      $year=$_POST['year'];
      $session=$_POST['session'];
      if ($dept == "" || $year == "") 
      {
        echo '<script type="text/javascript">
        alert("Empty fields not allowed!!!");
        location.replace("index.php?edits");
        </script>';
      }
      //  $sql=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE prog_id = '$dept' && year ='$year'  ORDER BY `matno` ASC");
      $n=0;
      $edit_student = edit_students($conn, $dept, $year);
      while($row = mysqli_fetch_array($edit_student, MYSQLI_ASSOC))
      {
        $n=$n+1;
        ?>
        <tr>
          <td ><span class="style1"><?php echo $n;?></span></td>
          <td ><span class="style1"><?php echo $row['names'];?></span></td>
          <td ><span class="style1"><?php echo $row['matno'];?></span></td>
          <td ><span class="style1"><?php echo $row['session'];?></span></td>
          <td  style="width: 32px"><span class="style1"><?php echo $row['year'];?></span></td>
          <td ><span class="style1">
          <?php
            $status=$row['Withdrwan']; 
            if($status==0)
            {
              echo "Active";
            }
            elseif($status==1)
            {
              echo "<font color='#FF0000'>In_Active</font>";
            }
          ?>
          </span></td>
          <td>
            <a href="index.php?edits= &id=<?php echo $row['sn']."&"."Edit="."edit"."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style1">EDIT</a>
          </td>
          <td>
            <a href="index.php?id=<?php echo $row['sn']."&"."deletes="."del"."&"."matno=".$row['matno']."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style1">DELETE</a>
          </td>
        </tr>
        <?php  
      }?>
    </table>
  </td>
</tr>
</table>
  <?php //exit; 
}
?>
<br>
<hr>
<form id="form2" name="form2" method="post" action="">
  <table  class="table table-bordered" >
    <tr>
      <td ><strong>PROGRAMME:</strong></td>
      <td>
        <select name="dept" id="dept" class="form-control">
        <option selected="selected" value="">Select Programme</option>
        <?php include('dptcode.php') ;
        //$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
        //while($prgasc = mysqli_fetch_assoc($prgqry))
        $prgqry = prog_function($logs);
        while($pcd = mysqli_fetch_assoc($prgqry))
        {
          ?>
          <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
          <?php 
        }?>
        </select>
      </td>
    </tr>
    <tr>
      <td ><strong>YEAR:</strong></td>
      <td>
        <select name="year" id="year" class="form-control">
        <option selected="selected" value="">Year</option>
        <?php
        for($i = 10; $i<=22; $i++)
        {
          echo "<option>".$i."</option>";
        }
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td ><strong>SESSION:</strong></td>
      <td>
        <select name="session" id="session" class="form-control">
        <option selected="selected" value="">Sessions</option>
        <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
        <option>2010/2011</option>
        <option>2012/2013</option>
        <option>2013/2014</option>
        <option>2014/2015</option>
        <option>2015/2016</option>
        <option>2016/2017</option>                  
        <option>2017/2018</option>
      </select>
      </td>
    </tr>
  </table>
  <br>
  <p>   
    <input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2" />
  </p>
</form>
<br> 
<p> 
  <a href="index.php?regs">Register Student</a>
</p>
<br>
<hr>
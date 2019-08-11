
<?php 
if (isset($_POST['Submit2']))
{
  $count=$_POST['count'];
  $count = preg_replace("/[^0-9]/", "", $count);
  $count = $count-1;
  $m=0;

  while($m<=$count)
  {
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


}
elseif (isset($_POST['Submit3']))
{

  if (!isset($_SESSION)) {
    session_start();
  }

  $prog = $_SESSION['prog'];

  $count=$_POST['count'];
  $semester = $_SESSION['semester'];
  //$_POST['programme']
  $count = $count-1;
  $m=0;
  while($m<=$count)
  {
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

}
elseif(isset($_GET['id']))
{
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

if (isset($_POST['Submit']))
{

  $prog=$_POST['programe'];
  $prog = preg_replace("/[^0-9]/", "", $prog);
  $semester=$_POST['semester'];
  $semester = preg_replace("/[^0-9]/", "", $semester);
  $session = $_POST['session'];
  $session = preg_replace("/[^0-9\/]/", "", $session);

  if (!isset($_SESSION)) 
  {
    session_start();
  }

  $_SESSION['prog'] = $prog;
  $_SESSION['semester'] = $semester;
  $_SESSION['session'] = $session;


  $sql = mysqli_query($conn,"SELECT * FROM  `course` WHERE prog_id='$prog' && semester ='$semester' && sessions = '$session'");
  if(!$sql)
  {
    die(mysqli_error());
  }?>


  <br>
  <hr>
  <i style="color:green">
  <?php echo $session. " Semester: ".$semester." for ".$prog; ?>
  </i>
  <hr>
 
  <form id="form2" name="form2" method="post" action="">
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Course Code.." class="form-control">
      <table  class="table table-bordered" id="myTable">
        <tr>

          <th>S/N</th>
          <th onclick="sortTable(1)">Course Title</th>
          <th onclick="sortTable(2)">Course Code </th>
          <th>Unit</th>
          <th>Session</th>
          <th>Semester</th>
          <th>Delete</th>

        </tr>
                  <?php 
          $n = 0;
          
          if ($form == 1)
          {
            if(mysqli_num_rows($sql)==0)
            {
              echo "<i style='color:red'> No records records found!!!</i>";
            }
              while ($row=mysqli_fetch_assoc($sql)){
               
              $n= $n+1;
              ?>
                      <tr>
                      <td>
                        <?php echo $n;?>
                        <input name="<?php echo 'sn'.$n;?>" type="hidden"  value="<?php echo $row['sn'];?>" />
                      </td>
                      <td>
                        <input style="border:thin;" name="<?php echo 'title'.$n;?>" type="text"  value="<?php echo $row['title'];?>" size="50" class="form-control"/>
                        <input name="<?php echo 'titles'.$n;?>" type="hidden"  value="<?php echo $row['title'];?>" size="50"/></td>
                        <td style="width: 170px"><input style="border:thin;" name="<?php echo 'code'.$n;?>" type="text" value="<?php echo $row['code'];?>" size="6" class="form-control"/>
                        <input name="<?php echo 'codes'.$n;?>" type="hidden" value="<?php echo $row['code'];?>" />
                        <span style="color:white"><?php echo $row['code'];?></span>
                      </td>
                      <td>
                        <input style="border:thin;" name="<?php echo 'unit'.$n;?>" type="text" value="<?php echo $row['unit'];?>" size="4" class="form-control"/>
                        <input name="<?php echo 'units'.$n;?>" type="hidden" value="<?php echo $row['unit'];?>" />
                      </td>
                      <td>
                              <input style="border:thin;" class="form-control" name="<?php echo 'ses'.$n;?>" type="text" value="<?php echo $row['sessions'];?>" size="4" />
                              <input name="<?php echo 'sess'.$n;?>" type="hidden" value="<?php echo $row['sessions'];?>" /></td>
                      <td>
                                  <input style="border:thin;" class="form-control" name="<?php echo 'sems'.$n;?>" type="text" value="<?php echo $semester;?>" size="4" /></td>
                      <td><a href="index.php?id=<?php echo $row['sn'].'&updtcourse';?>">&nbsp;&nbsp;&nbsp;<img src="images/del.jpg" width="16" height="14" alt="del" /></a>
                      <input name="<?php echo 'sn'.$n;?>" type="hidden" value="<?php echo $row['sn'];?>" /></td>
                      </tr>
                      <?php }?>
                  </table>
                  <input name="count" type="hidden" value="<?php echo $n;?>" />
                  <br>
                  <input type="submit" name="Submit2" value="Edit Records" style="border:thin; color:navy;" class="btn btn-gradient-primary mr-2" />
                  <input type="submit" name="Submit3" value="Add Records" style="border:thin; color:navy;" class="btn btn-gradient-primary mr-2" />
                  
                  </form>
              <p><br>
              </p>
              <?php
          }
          else
          {
            if(mysqli_num_rows($sql)==0)
            {
              echo "<i style='color:red'> No records records found!!!</i>";
            }
              while ($row=mysqli_fetch_assoc($sql)){
                  $n= $n+1;
                  ?>
                          <tr>
                          <td>
                            <?php echo $n;?>
                            <input name="<?php echo 'sn'.$n;?>" type="hidden"  value="<?php echo $row['sn'];?>" /></td>
                          <td>
                            <input style="border:thin;" name="<?php echo 'title'.$n;?>" type="text"  value="<?php echo $row['title'];?>" size="50" class="form-control"/>
                            <input name="<?php echo 'titles'.$n;?>" type="hidden"  value="<?php echo $row['title'];?>" size="50"/>
                          </td>
                          <td style="width: 170px">
                            <input style="border:thin;" name="<?php echo 'code'.$n;?>" type="text" value="<?php echo $row['code'];?>" size="6" class="form-control"/>
                            <input name="<?php echo 'codes'.$n;?>" type="hidden" value="<?php echo $row['code'];?>" />
                            <span style="color:white"><?php echo $row['code'];?></span>
                          </td>
                          <td>
                            <input style="border:thin;" name="<?php echo 'unit'.$n;?>" type="text" value="<?php echo $row['unit'];?>" size="4" class="form-control"/>
                            <input name="<?php echo 'units'.$n;?>" type="hidden" value="<?php echo $row['unit'];?>" />
                          </td>
                          <td>
                            <input style="border:thin;" class="form-control" name="<?php echo 'ses'.$n;?>" type="text" value="<?php echo $row['sessions'];?>" size="4" />
                            <input name="<?php echo 'sess'.$n;?>" type="hidden" value="<?php echo $row['sessions'];?>" />
                          </td>
                          <td>
                            <input style="border:thin;" class="form-control" name="<?php echo 'sems'.$n;?>" type="text" value="<?php echo $semester;?>" size="4" /></td>
                          <td>
          <!--  <a href="index.php?id=<?php echo $row['sn'].'&updtcourse';?>">&nbsp;&nbsp;&nbsp;<img src="images/del.jpg" width="16" height="14" alt="del" /></a>-->

                          <input name="<?php echo 'sn'.$n;?>" type="hidden" value="<?php echo $row['sn'];?>" /></td>
                          </tr>
                          <?php }?>
                      </table>
                    
                      </form>
                  <?php
          }
  //exit;
  }
?>
      
<br>
<hr>
&nbsp;
<hr>
<br>
<i style="color:green">Select Programme, Semester, and session to view courses</i>
<hr>
      <form id="form1" name="form1" method="post" action="">
              <table  class="table table-bordered" >
                <tr>
                  <td ><span style="font-weight: bold">Programme:</span></td>
                  <td>
                  <select name="programe" id="programe" class="form-control">
                  <option selected="selected" value="">Select Programme</option>
                    <?php include('dptcode.php') ;
            
            
                    //$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
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
                  <td><select name="semester" class="form-control">
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
                  <td><span style="font-weight: bold">Session:</span></td>
                  <td>
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
           <p> <input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2" /></p>
              </form>

      <br>
<hr>
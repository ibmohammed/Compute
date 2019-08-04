<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    
	<?php




if(isset($_POST['Submit2']))
{
    
  $programme=$_POST['programme'];
  $year=$_POST['year'];
  $session=$_POST['session'];
  $semester=$_POST['semester'];
  $name= $_POST['name'];
  $matno= $_POST['matno'];
  $count = $_POST['count'];

  $name = mysqli_escape_string($conn,$name);

  $programme = mysqli_escape_string($conn,$programme);

  $count=$count-1;
  $m=0;
  while($m<=$count)
  {
    $m=$m+1;
    $scr= "score".$m;
    $score = $_POST[$scr];
    $s = "sn".$m;
    $sn = $_POST[$s];
    include("includes/scoregrade.php");
    $point = $n[$grade1];
    $un="unit".$m;
    $unit=$_POST[$un];
    $cod="code".$m;
    $code = $_POST[$cod];


    $query=mysqli_query($conn,"UPDATE `results` 
    SET  `code`='$code',`unit`='$unit',`score` =  '$score',`grade` =  '$grade1',`points`='$point' 
    WHERE  `results`.`sn` ='$sn'");

					// save Carry Over scores
					
        if ($score>=0 and $score <=39)
        {
          $co_spill = "co";
          $resultssn = update_prev_result($conn, $score,$grade1,$point,$co_spill,$matno,$code);
          mysqli_stmt_execute($resultssn);
				}

	// chronicle 
  $action = "UPDATED";
  $lids = $sn;
  include("dchronicle_res.php");
  // End of chronicles  


    }
  echo "<script language = 'javascript'>"."alert('Records updated')"."</script>";
  echo "<font color = 'red'><i>"."Records Updated"."</i></font>";

  // Display Student List ?>

  <table class="table table-bordered">
    <tr >
      <td ><strong>Id</strong></td>
      <td ><strong>Name</strong></td>
      <td ><strong>MatricNo</strong></td>
      <td ><strong>Year</strong></td>
      <td ><strong>STATUS</strong></td>
      <td ><strong>EDIT</strong></td>
    </tr>

  <?php
  //$programme=$_POST['programme'];
  $dept = $_POST['programme'];
  //$year=$_POST['year'];
  //$session=$_POST['session'];

  $dept = mysqli_escape_string($conn,$dept);
  $sql=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE prog_id = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC");
  $n=0;
  while ($row=mysqli_fetch_assoc($sql))
  {
    $n=$n+1;
    ?>

      <tr>
        <td ><span class="style1"><?php echo $n;?></span></td>
        <td ><span class="style1"><?php echo $row['names'];?></span></td>
        <td ><span class="style1"><?php echo $row['matno'];?></span></td>
        <td ><span class="style1"><?php echo $row['year'];?></span></td>
        <td >
          <span class="style1">
            <?php
            $status=$row['Withdrwan']; 
            if($status==0)
            {
              echo "Active";
            }
            elseif($status==1)
            {
              echo "<font color='#FF0000'>In_Active</font>";
            }?>
          </span>
        </td>
        <td>
        <form name="form<?php echo $n;?>" method="post" action="">  
            <input name="id" value="<?php echo $row['sn'] ;?>" type="hidden">
            <input name="semester" value="<?php echo $semester;?>" type="hidden">
            <input name="programme" value="<?php echo $dept;?>" type="hidden">
            <input name="year" value="<?php echo $year;?>" type="hidden">
            <input name="session" value="<?php echo $session;?>" type="hidden">
            <input name="matno" value="<?php echo $row['matno'];?>" type="hidden">
            <input type="Submit" name="Submit" value="EDIT" class="btn btn-gradient-primary mr-2">
            <!--
          <a href="index.php?editres&id=<?php //echo $row['sn']."&"."semester=".$semester."&"."programme="."$dept"."&"."year="."$year"."&"."session="."$session"."& Submit="."Submit". "& matno=".$row['matno'];?>" class="style1">
            EDIT
          </a>--></form>
        </td>
      </tr>
      <?php  
  }?>
  </table>

  <?php 
}?>
	
<?php
if(isset($_POST['button']))
{
  // show all pages
  $programme=$_POST['programme'];
  $session=$_POST['session'];
  $year=$_POST['year'];
  $semester=$_POST['semester'];

  if ($programme =="" || $year == "" || $session == "" || $semester == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?editres");
    	</script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
  }
    
  $programme = mysqli_escape_string($conn,$programme);
  //add session 
  $_SESSION['programme'] = $programme;
  $_SESSION['session'] = $session;
  $_SESSION['year'] = $year;
  $_SESSION['semester'] = $semester;
  // show students data?>
  <table class="table table-bordered">
    <tr >
      <td ><strong>Id</strong></td>
      <td ><strong>Name</strong></td>
      <td ><strong>Matric Number</strong></td>
      <td ><strong>Year</strong></td>
      <td ><strong>Status</strong></td>
      <td ><strong>EDIT</strong></td>
    </tr>
      <?php
      $dept = $_POST['programme'];
      $year=$_POST['year'];
      $session=$_POST['session'];
      
      $dept = mysqli_escape_string($conn,$dept);
      
      $sql=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE prog_id = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC");
      $n=0;
        while ($row=mysqli_fetch_assoc($sql))
        {
          $n=$n+1;
          ?>
          <tr>
            <td ><span class="style1"><?php echo $n;?></span></td>
            <td ><span class="style1"><?php echo $row['names'];?></span></td>
            <td ><span class="style1"><?php echo $row['matno'];?></span></td>
            <td ><span class="style1"><?php echo $row['year'];?></span></td>
            <td>
              <span class="style1">
                <?php
                $status=$row['Withdrwan']; 
                if($status==0)
                {
                  echo "Active";
                }elseif($status==1)
                {
                  echo "<font color='#FF0000'>In_Active</font>";
                }?>
              </span>
            </td>
            <td>
            <form name="form<?php echo $n;?>" method="post" action="">  
            <input name="id" value="<?php echo $row['sn'] ;?>" type="hidden">
            <input name="semester" value="<?php echo $semester;?>" type="hidden">
            <input name="programme" value="<?php echo $dept;?>" type="hidden">
            <input name="year" value="<?php echo $year;?>" type="hidden">
            <input name="session" value="<?php echo $session;?>" type="hidden">
            <input name="matno" value="<?php echo $row['matno'];?>" type="hidden">
            <input type="Submit" name="Submit" value="EDIT" class="btn btn-gradient-primary mr-2">
            <!--  <a href="index.php?editres&id=<?php //echo $row['sn']."&"."semester=".$semester."&"."programme="."$dept"."&"."year="."$year"."&"."session="."$session"."& Submit="."Submit". "& matno=".$row['matno'];?>" class="style1">
                EDIT
              </a>-->
              </form>
            </td>
          </tr>
          <?php  
  
        }?>
  </table>
  <?php
}
elseif(isset($_POST['Submit']))
{
	$programme=$_POST['programme'];
	$session=$_POST['session'];
	$year=$_POST['year'];
	$semester=$_POST['semester'];
	$matno=$_POST['matno'];
	$programme= mysqli_escape_string($conn,$programme);
	$query=mysqli_query($conn,"SELECT * FROM `course` WHERE prog_id ='$programme' && semester = '$semester' && sessions = '$session'");
	$sql=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE matno='$matno'");
	$row=mysqli_fetch_assoc($sql);
	?>
	<form id="form1" name="form1" method="post" action="">
      <table class="table table-bordered">
        <tr>
          <td ><span style="font-weight: bold">Name:</span></td>
          <td ><input name="name" type="text" id="name" value="<?php echo $row['names'];?>" size="40" />
          </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">MatricNo:</span></td>
          <td ><input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>"/>
          </td>
        </tr>
      </table>
      
        <table class="table table-bordered">
          <tr>
            <?php 
            $msql=mysqli_query($conn,"SELECT * FROM  `results` WHERE matric_no='$matno' && semester='$semester'");
            if(!$msql){
            die(mysqli_error($conn));}
      			$n=0; 
            while (($col= mysqli_fetch_assoc($query)) && ($rows = mysqli_fetch_assoc($msql)))
            {
              $n=$n+1;
              ?>
              <td style="width: 32px">
                <span style="color: #000000; font-weight: bold">
                  <?php echo $col['code']."<br>";?>
                  <input name="<?php echo'sn'.$n;?>" type="hidden" id="sn" value="<?php echo $rows['sn'];?>" />
                  <input name="<?php echo'score'.$n;?>" type="text" value="<?php echo $rows['score'];?>" size="4"/>
                  <input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>" size="4"/>
                  <input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>" size="4"/>
                </span>
              </td>
              <?php 
            }?>
          </tr>
        </table>
        <input name="count" type="hidden" id="count" value="<?php echo $n;?>" />
        <input type="submit" name="Submit2" value="Submit" class="btn btn-gradient-primary mr-2"/>
        <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
        <input type="hidden" name="session"  value="<?php echo $session;?>"/>
        <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
        <input type="hidden" name="year"  value="<?php echo $year;?>"/>
    </form>
	<?php 
	exit;
}
	
	?>
	
	<!--
        -->
		<br>
    <hr>
    <br>
<form id="form2" name="forms2" method="post" action="">
  
  <table class="table table-bordered">
    <tr>
      <td ><span style="font-weight: bold">PROGRAMME:</span></td>
      <td >
        <span style="font-weight: bold">
          <select name="programme" id="programme2" class="form-control">
            <option selected="selected" value="">Select Programme</option>
            <?php include('dptcode.php') ;
            $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
        //	$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error($conn));
            while($pcd = mysqli_fetch_assoc($queri))
            {
              ?>
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
              <?php 
            }?>
          </select>
        </span>
      </td>
    </tr>
    <tr>
      <td ><span style="font-weight: bold">SESSION:</span></td>
      <td>
        <span style="font-weight: bold">
          <select name="session" id="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
            <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
            <?php echo include('includes/sessions.php');?>
          </select>
          -
          <select name="year" id="year2" class="form-control">
            <option selected="selected" value="">Select Year</option>
            
            <?php
              for($i = 10; $i<=22; $i++)
              {
                echo "<option>".$i."</option>";
              }
              ?>
          </select>
        </span>
      </td>
    </tr>
    <tr>
      <td ><span style="font-weight: bold">SEMESTER:</span></td>
      <td>
        <span style="font-weight: bold">
          <select name="semester" id="semester" class="form-control">
            <option selected="selected" value="">Select Semester</option>
            <option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
            <option value="4">Fourth Semester</option>
            <option value="5">Fifth Semester</option>
            <option value="6">Sixth Semester</option>
          </select>
        </span>
      </td>
    </tr>
  </table>
  <input type="submit" name="button" id="button" value="Submit" class="btn btn-gradient-primary mr-2"/>
  </form>    
<p>&nbsp;</p>


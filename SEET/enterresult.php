<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Results Management System</title>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php //include("includes/header.php"); ?>        



   	<?php
if(isset($_POST['Submit2']))
{
  $programme=$_POST['programme'];
  $programme = mysqli_escape_string($logs, $programme);
  $year=$_POST['year'];
  $session=$_POST['session'];
  $semester=$_POST['semester'];
  $name= $_POST['name'];
  $name = mysqli_escape_string($logs, $name);
  $matno= $_POST['matno'];
  $count = $_POST['count'];
  $session = $_POST['session'];


  // check if result already exist

  $matricno=$_POST['matno'];


  $sql1=mysqli_query($logs,"SELECT * FROM `results`
  WHERE `matric_no` = '$matricno'AND 
  `prog_id` = '$programme' AND 
  `semester`='$semester'") or die (mysqli_error($logs));
    
  if (!$name && !$matno)
  {
    die( 'No more records and Empty fields cannot be added');
  }
    

  $col = mysqli_fetch_assoc($sql1);

    if (!empty($_POST['score_list']))
    {
      foreach($_POST['score_list'] as $score) 
      {
        foreach($_POST['code_list'] as $code)   
        {
          foreach( $_POST['unit_list'] as $unit)
          {

            include("includes/scoregrade.php");
            $point = $n[$grade1];
            // insert results
            $query=mysqli_query($logs,"INSERT IGNORE INTO `results` 
            (`sn`, `name`, `matric_no`, `code`,`unit`,`score`, `grade`,`points`,
            `prog_id`, `semester`, `session`) VALUES (NULL, '$name', '$matno',
            '$code','$unit', '$score', '$grade1','$point', '$programme', '$semester',
            '$session')");
            	 
            	// chronicle 
				$action = "INSERTED";
				$lids = mysqli_insert_id($logs);
				include("dchronicle_res.php");
				// End of chronicles  

          } 
        }
      }
    }


    // update status
    $updt = mysqli_query($logs,"UPDATE `studentsnm` 
    SET `status` = '$semester' WHERE `studentsnm`.`matno` ='$matno'");

    $query = mysqli_query($logs,"SELECT * FROM `course` 
    WHERE prog_id ='$programme' && semester = '$semester' && sessions = '$session'");

    $sql = mysqli_query($logs,"SELECT * FROM `studentsnm` 
    WHERE prog_id='$programme' && year = '$year' && status < '$semester' ORDER BY `studentsnm`.`matno` ASC");
    $row = mysqli_fetch_assoc($sql);
    
    $exixtin = mysqli_num_rows($sql);



    if($exixtin==0){
      echo "No Student left";
    }
    else
    {
      ?>

      <form action="" method="post" name="form2" id="form2">
        <table class="table table-bordered">
          <tr>
            <td><span style="font-weight: bold">Name:</span></td>
            <td>
              <input name="name" type="text" id="name" value="<?php echo $row['names'];?>"  readonly="1"/>
              <input name="name" type="hidden" id="name" value="<?php echo $row['names'];?>" size="40" />
            </td>
          </tr>
          <tr>
            <td ><span style="font-weight: bold">MatricNo:</span></td>
            <td >
              <input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>" readonly="1"/>
              <input name="matno" type="hidden" id="matno"  value="<?php echo $row['matno'];?>" />
            </td>
          </tr>
        </table>
      
        <table class="table table-bordered">
          <tr>
            <?php 
            $n=0; 
            while ($col= mysqli_fetch_assoc($query))
            {
              $n=$n+1;

              // check if there are existing records and the records are not complete

              $cscode =  $col['code'];
              $csunit =  $col['unit'];
              $smatno = $row['matno'];

              //echo "<input type='text' value='".$matno."'>";

              $sqry = mysqli_query($logs,"SELECT * FROM `results` 
              WHERE  matric_no = '$smatno' && code = '$cscode' && unit = '$csunit'"
              )or die('sqry'.mysqli_error($logs));			
              $nmrws = mysqli_num_rows($sqry);
              if($nmrws ==0)
              {
                ?>

              <td >
                <span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
                  <input name="unit_list[]" type="hidden" value="<?php echo $col['unit'];?>" size="4" />
                  <input name="code_list[]" type="hidden" value="<?php echo $col['code'];?>" size="4" />
                  <select name="score_list[]">
                    <option value="0">---</option>
                    <?php include("includes/scoreopt.php");?>
                  </select>
                </span>
              </td>
              <?php 
              }  // end of checking
            }?>
          </tr>
        </table>
        <input name="count" type="hidden" id="count" value="<?php echo $n;?>" />
        <input type="submit" name="Submit2" value="Submit"  class="btn btn-gradient-primary mr-2"/>
        <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
        <input type="hidden" name="session"  value="<?php echo $session;?>"/>
        <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
        <input type="hidden" name="year"  value="<?php echo $year;?>"/>
      </form>
      
      
      
      <?php 
    }?>
    <?php exit;
}	?>
  <?php 
if(isset($_POST['Submit']))
{
  $programme=$_POST['programme'];

  $programme = mysqli_escape_string($logs,$programme);

  $year=$_POST['year'];
  $session=$_POST['session'];
  $semester=$_POST['semester'];

  if ($programme =="" || $year == "" || $session == "" || $semester == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?entres");
    	</script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
	}

  $query=mysqli_query($logs,"SELECT * FROM `course` 
  WHERE prog_id ='$programme' && semester = '$semester'  && sessions = '$session'") or die(mysqli_error($logs));

  $sql=mysqli_query($logs,"SELECT * FROM `studentsnm` 
  WHERE prog_id='$programme'  && year = '$year' && 
  status <'$semester' && Withdrwan ='0' ORDER BY `studentsnm`.`matno` ASC") or die(mysqli_error($logs));
  $row=mysqli_fetch_assoc($sql);

  $matricno=$row['matno'];

  $sql1=mysqli_query($logs,"SELECT *FROM `results`
  WHERE `matric_no` LIKE '$matricno'AND `prog_id` = '$programme'") or die (mysqli_error($logs));
  $col =mysqli_fetch_assoc($sql1);

  if (($matricno==$col['matric_no'])&&($programme==$col['code'])&&($programme==$col['semester']))
  {
    echo "<script language = 'javascript'>"."alert('record already Exist')"."</script>";
    exit;
  }

  $exixtin = mysqli_num_rows($sql);

  if($exixtin==0)
  {
    echo "No Student left";
  }
  else
  {	
    ?>

    <!--<form action="" method="post" name="form1" id="form1" onsubmit="MM_validateForm('name','','R','matno','','R');return document.MM_returnValue">-->
    <form action="" method="post" name="form1" id="form1">
      <table class="table table-bordered">
        <tr>
          <td ><span style="font-weight: bold">Name:</span></td>
          <td >
            <input name="name" type="text" id="name" value="<?php echo $row['names'];?>" size="40" readonly="1"  />
            <input name="name" type="hidden" id="name" value="<?php echo $row['names'];?>" size="40" />
          </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">Matric Number:</span></td>
          <td >
            <input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>" readonly="1"/>
            <input name="matno" type="hidden" id="matno"  value="<?php echo $row['matno'];?>" />
          </td>
        </tr>
      </table>

      <table class="table table-bordered">
        <tr>
          <?php $n=0; 
          while ($col= mysqli_fetch_assoc($query))
          {
            $n=$n+1;
            // check if there are existing records and the records are not complete
            $cscode =  $col['code'];
            $csunit =  $col['unit'];
            $smatno = $row['matno'];

            //echo "<input type='text' value='".$matno."'>";

            $sqry = mysqli_query($logs,"SELECT * FROM `results` 
            WHERE  matric_no = '$smatno' && code = '$cscode' && unit = '$csunit'")or die('sqry'.mysqli_error($logs));			
            $nmrws = mysqli_num_rows($sqry);
            if($nmrws ==0)
            {
              ?>
              <td >
                <span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
                  <input name="unit_list[]" type="hidden" value="<?php echo $col['unit'];?>" size="4" />
                  <input name="code_list[]" type="hidden" value="<?php echo $col['code'];?>" size="4" />
                  <select name="score_list[]" >
                  <option value="0">---</option>
                  <?php include("includes/scoreopt.php");?>
                  </select>
                </span>
              </td>
              <?php
            }
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
  }
  exit;
}
	
?>
	
	
<form action="" method="post" name="grade" id="grade">
     <p> <strong >INPUT RESULTS</strong></p>
      <table class="table table-bordered">
        <tr>
          <td>PROGRAMME:</td>
          <td>
            <select name="programme" id="programme" class="form-control">
            <option selected="selected" value="">Select Programme</option>
              <?php include('dptcode.php');
              $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
              //	$queri = mysqli_query($logs,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error($logs));
              while($pcd = mysqli_fetch_assoc($queri)){
              ?>
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
              <?php }?>
            </select>         
          </td>
        </tr>
        <tr>
          <td >SESSION:</td>
          <td >
            <select name="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
              <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
              <?php echo include('includes/sessions.php');?>
            </select>
          -
          <select name="year" id="year" class="form-control">
            <option selected="selected" value="">Select Year</option>
			     
	         <?php 
            for($i = 10; $i<=22; $i++)
            {
              echo "<option>".$i."</option>";
            }?>
          </select>
          </td>
        </tr>
        <tr>
          <td>SEMESTER:</td>
          <td>
            <select name="semester" class="form-control">
            <option selected="selected" value="">Select Semester</option>
              <option value="1">First Semester</option>
              <option value="2">Second Semester</option>
              <option value="3">Third Semester</option>
              <option value="4">Fourth Semester</option>
              <option value="5">Fift Semester</option>
              <option value="6">Sixth Semester</option>
            </select>
          </td>
        </tr>
      </table>
      <br>
      <p></p>
      <p><input name="Submit" value="Submit" type="submit" class="btn btn-gradient-primary mr-2"/></p>
      <br />
    </form>
    <hr>

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

<?php include("includes/header.php"); ?>    

	<?php
if(isset($_POST['Submit2'])){
	$programme=$_POST['programme'];
		$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];
	$name= $_POST['name'];
	$matno= $_POST['matno'];
	$count = $_POST['count'];
	$ccode = $_POST['ccode'];
	$session = $_POST['session'];
// check if result already exist

		$matricno=$_POST['matno'];
		
		$sql1=mysql_query("SELECT *FROM `results` WHERE
		`matric_no` = '$matricno' && `programme` = '$programme' && code = '$ccode' && `semester`='$semester'") OR 
		die (mysql_error());
$col_num_row = mysql_num_rows($sql1);		
// $col = mysql_fetch_array($sql1);

if ($col_num_row >=1){
//if (($matricno==$col['matric_no'])&&($programme==$col['programme'])&&($semester==$col['semester'])){
    echo "<script language = 'javascript'>"."alert('record already Exist')"."</script>";
	
}else{
	
	
	if (!$name && !$matno){
	die( 'No more records and Empty fields cannot be added');
	}
	$count = $count-1;
	$m=0;
	while($m<=$count){
						$m=$m+1;
						$scr= "score".$m;
						$score = $_POST[$scr];
						include("includes/scoregrade.php");
						$point = $n[$grade1];
						$un="unit".$m;
						$unit=$_POST[$un];
						$cod="code".$m;
						$code = $_POST[$cod];

						// validate to know if the record already exist


								$sql1=mysql_query("SELECT *FROM `results` WHERE
								`matric_no` = '$matricno' && `programme` = '$programme' && code = '$ccode' && `semester`='$semester'") OR 
								die (mysql_error());
						$col_num_row = mysql_num_rows($sql1);




						// insert results
						$query=mysql_query("INSERT IGNORE INTO `consultdbsnw`.`results` 
						(`sn`, `name`, `matric_no`, `code`,`unit`,`score`, `grade`,`points`,
						 `programme`, `semester`, `session`) VALUES (NULL, '$name', '$matno',
						 '$code','$unit', '$score', '$grade1','$point', '$programme', '$semester', '$session')");
					}
// update status
$updt=mysql_query("UPDATE `consultdbsnw`.`studentsnm` SET `status` = '$semester' WHERE `studentsnm`.`matno` ='$matno'");
	
	
	
	$query=mysql_query("SELECT * FROM `course` WHERE programme ='$programme' && semester = '$semester' && code = '$ccode'  && sessions = '$session'");
	
	$sql=mysql_query("SELECT * FROM `studentsnm` WHERE dept='$programme' && year = '$year' && status < '$semester' ORDER BY `studentsnm`.`matno` ASC");
	$row=mysql_fetch_array($sql);
	

	
	?>
	


    <form action="" method="post" name="form2" id="form2" onsubmit="MM_validateForm('name','','R','matno','','R');return document.MM_returnValue">
  
	  <table border="0">
        <tr>
          <td ><span style="font-weight: bold">Name:</span></td>
          <td ><input name="name" type="text" id="name" value="<?php echo $row['names'];?>" size="40"  readonly="1"/>
          </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">MatricNo:</span></td>
          <td ><input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>" readonly="1"/>
          </td>
        </tr>
      </table>


        <table border="0">
          <tr>
		  
            <?php 
			
			$n=0; 
			while ($col= mysql_fetch_array($query)){
			 $n=$n+1;
			 ?><td ><span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
			   <input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>" size="4">
				<input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>" size="4"/>
			  
			    <select name="<?php echo'score'.$n;?>" >
                  <option >---</option>
                  <?php include("includes/scoreopt.php");?>
                </select>
                
                <input name="ccode" type="hidden" value="<?php echo $ccode;?>"/>
			 </span></td>
            <?php }?>
          </tr>
        </table>
        <input name="count" type="hidden" id="cou&& code = '$ccode'nt" value="<?php echo $n;?>" />
        <input type="submit" name="Submit2" value="Submit" />
        <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
        <input type="hidden" name="session"  value="<?php echo $session;?>"/>
        <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
        <input type="hidden" name="year"  value="<?php echo $year;?>"/>
        </form>


<?php }?>


	<?php exit;
}	?>
	<?php if(isset($_POST['Submit'])){
	$programme=$_POST['programme'];
	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];
	$ccode = $_POST['ccode'];
	$query=mysql_query("SELECT * FROM `course` WHERE programme ='$programme' && semester = '$semester' && code = '$ccode'  && sessions = '$session'");
	if(!$query){
	die(mysql_error());
	}
	$sql=mysql_query("SELECT * FROM `studentsnm` WHERE dept='$programme'  && year = '$year' && status <'$semester' && Withdrwan ='0' ORDER BY `studentsnm`.`matno` ASC");
	if(!$sql){
	die(mysql_error());
	}
		$row=mysql_fetch_array($sql);
		
		$matricno=$row['matno'];
		
		$sql1=mysql_query("SELECT *FROM `results`WHERE `matric_no` LIKE '$matricno'AND `programme` LIKE '$programme'");
		if(!$sql1){ die (mysql_error());}
$col =mysql_fetch_array($sql1);
if (($matricno==$col[2])&&($programme==$col[3])&&($programme==$col['semester'])){
    echo "<script language = 'javascript'>"."alert('record already Exist')"."</script>";
	exit;
}
	
	?>
	


	<form action="" method="post" name="form1" id="form1" onsubmit="MM_validateForm('name','','R','matno','','R');return document.MM_returnValue">
      <table border="0">
        <tr>
          <td ><span style="font-weight: bold">Name:</span></td>
          <td ><input name="name" type="text" id="name" value="<?php echo $row['names'];?>" size="40" readonly="1"  />
          </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold">MatricNo:</span></td>
          <td ><input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>" readonly="1"/>
          </td>
        </tr>
      </table>
        <table border="0">
          <tr>
            <?php $n=0; 
			while ($col= mysql_fetch_array($query)){
			 $n=$n+1;
			 ?><td ><span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
			    <input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>" size="4">
				<input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>" size="4" />
			 
			    <select name="<?php echo'score'.$n;?>" >
                  <option >---</option>
                  <?php include("includes/scoreopt.php");?>
                </select>
			 <input name="ccode" type="hidden" value="<?php echo $ccode;?>" />
			 </span></td>
            <?php }?>
          </tr>
        </table>
        <input name="count" type="hidden" id="count" value="<?php echo $n;?>" />
        <input type="submit" name="Submit2" value="Submit" />
        <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
        <input type="hidden" name="session"  value="<?php echo $session;?>"/>
        <input type="hidden" name="semester"  value="<?php echo $semester;?>"/>
        <input type="hidden" name="year"  value="<?php echo $year;?>"/>
    </form>


	

	<?php 
	exit;
	}
	
	?>
	



<form action="" method="post" name="grade" id="grade">
      <strong>INPUT RESULTS</strong>
      <table style="text-align: left;color:blue;">
        <tr>
          <td ><span style="font-weight: bold; color: #000000">
		  PROGRAMME:</span></td>
          <td ><select name="programme" id="programme">
         			<option selected="selected"></option>
         			
         			 <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
            
  <?php
			//include('prog1.php');
			//include('prog2.php');
			//include('prog3.php');
			 ?>
		    <?php //include("includes/optionsc.php"); ?>
          </select>          </td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold; color: #000000">
		  SESSION:</span></td>
          <td ><select name="session">
          <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                    <?php echo include('includes/sessions.php');?>

          </select>
          -
          <select name="year" id="year">
            <option selected="selected"></option>
			<option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
          </select></td>
        </tr>
        <tr>
          <td ><span style="font-weight: bold; color: #000000">
		  SEMESTER:</span></td>
          <td ><select name="semester">
            <option selected="selected"></option>
			<option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
			<option value="4">Fourth Semester</option>
            <option value="5">Fift Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td ><select name="ccode">
          
		  <?php 
		  
		  $ccodes = mysql_query("SELECT * FROM `course`") or die(mysql_error());
		  while($cc = mysql_fetch_array($ccodes)){
		  ?>
		  <option><?php echo $cc['code'];?></option><?php } ?>
		  </select>&nbsp;</td>
        </tr>
      </table>
      <input name="Submit" value="Submit" type="submit" />
      <br />
    </form>

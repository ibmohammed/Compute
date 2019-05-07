<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require('includes/header.php');    ?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	color: #0033FF;
}
a:hover {
	color: #0066FF;
}
.style3 {color: #FF0000}
.uu {
	color: #000;
}
-->
</style>

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

<body>
   
  <div style="float:left; width:600px;">
<?php 	if (isset($_POST['Submit'])){
$image=$_FILES["file"]["name"];
$sname=$_POST['sname'];

$sname = mysqli_escape_string($conn,$sname);

$sex=$_POST['sex'];
$cid=$_POST['programme'];
$cid = mysqli_escape_string($conn,$cid);

$mat=$_POST['mat'];
$ric=$_POST['ric'];
$no=$_POST['no'];
$sess=$_POST['session'];

$matricno = $mat."/".$ric."/".$no;?>
      <?php
// check if record exist
$sql=mysqli_query($conn,"SELECT *FROM `studentsnm`WHERE `matno` LIKE '$matricno'AND `dept` LIKE '$cid'");
if(!$sql){
die(mysql_error());
}
$col =mysqli_fetch_assoc($sql);
if (($matricno==$col['matno'])&&($cid==$col['dept'])){
    echo "<script language = 'javascript'>"."alert('record already Exist')"."</script>";
	
}else{
$stdnm=mysqli_query($conn,"INSERT INTO studentsnm (sn,names ,matno ,dept,year,images,session,Withdrwan,sex) 
VALUES (NULL , '$sname', '$matricno', '$cid', '$ric','$image','$sess','0','$sex')");
}
 echo "<script language = 'javascript'>"."alert('Successful')"."</script>";
?>

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="MM_validateForm('sname','','R','mat','','R','ric','','R','no','','R','mat','','R','ric','','R','no','','R');return document.MM_returnValue">
      <div align="center"><strong>STUDENTS RECORD FORM </strong></div>
      <table width="100%" align="center">
        <tr>
          <td align="left" ><strong>LOAD IMAGE: </strong></td>
          <td align="left" ><input name="file" type="file" id="file" />
            <span class="style3">*</span></td>
        </tr>
        <tr>
          <td align="left" ><strong>PROGRAMME:</strong></td>
          <td align="left" ><span style="font-weight: bold">
            <select name="programme" id="programme">
            
            <?php include('dptcode.php') ;
            
            
           // $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
           // while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $cid;?></option>
              
              <?php // }?>
            </select>
          </span><span class="style3">*</span></td>
        </tr>
        <tr>
          <td align="left" ><strong>STUDENT NAME:</strong></td>
          <td align="left" ><input name="sname" type ="text" id="sname" size = "30" />
            <span class="style3">*</span></td>
        </tr>
        <tr>
          <td align="left" ><strong>GENDER:</strong></td>
          <td align="left" ><select name="sex" id="sex">
            <option selected="selected"></option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
            <span class="style3">*</span></td>
        </tr>
        <tr>
          <td align="left" ><p><strong>MATRIC NO.:</strong></p></td>
          <td align="left" ><input name="mat" id="mat" value="<?php echo $mat;?>"  />
            /
            <input name="ric" id="ric" value="<?php echo $ric;?>"  />
             / 
            <input name="no" id="no" value="" style="width: 57px"  />
            <span class="style3">*(eg. NDCS/010/098)</span></td>
        </tr>
        <tr>
          <td height="24" align="left" ><strong>SESSION:</strong></td>
          <td align="left" >
          <select name="session" id="session">
              <option selected="selected"><?php echo $sess;?></option>
			          <?php echo include('includes/sessions.php');?>

          </select>
            <span class="style3">*</span></td>
        </tr>
      </table>
      <div align="center">
	          <input name="Submit" type="submit" id="Submit" value="Submit" />
        </div>
</form>
		  
	<?php exit; }?>
	<form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="MM_validateForm('mat','','R','ric','','R','no','','R');MM_validateForm('sname','','R','mat','','R','ric','','R','no','','R','mat','','R','ric','','R','no','','R');return document.MM_returnValue">
      <div align="center"><strong>STUDENTS RECORD FORM </strong></div>
	  <table width="100%" align="center">
        <tr>
          <td width="12%" align="left" ><strong> LOAD IMAGE:</strong></td>
          <td width="88%" align="left" ><input name="file" type="file" id="file" /></td>
        </tr>
        <tr>
          <td align="left" ><strong>PROGRAMME:</strong></td>
          <td align="left" ><span style="font-weight: bold">
            <select name="programme" id="programme">
              
              <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
             <?php
			//include('prog1.php');
			//include('prog2.php');
			//include('prog3.php');
			 ?>
            </select>
          </span></td>
        </tr>
        <tr>
          <td align="left" ><strong>STUDENTNAME:</strong></td>
          <td align="left" ><input name="sname" type ="text" id="sname" size = "30" /></td>
        </tr>
        <tr>
          <td align="left" ><span style="font-weight: bold">GENDER:</span></td>
          <td align="left" ><select name="sex" id="sex">
            <option selected="selected"></option>
			<option value="M">Male</option>
            <option value="F">Female</option>
                    </select>
            <span class="style3">*</span></td>
        </tr>
        <tr>
          <td align="left" ><p><strong>MATRIC NO.:</strong></p></td>
          <td align="left" ><input name="mat" id="mat" value="" size= "15" />
            /
            <input name="ric" id="ric" value="" size= "8" />
            / 
            <input name="no" id="no" value="" size= "8" />
            (eg. NDCS/010/098)</td>
        </tr>
        <tr>
          <td height="24" align="left" ><strong>SESSION:</strong></td>
          <td align="left" >
          		<select name="session" id="session">
          		<option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                      <?php echo include('includes/sessions.php');?>

          </select></td>
        </tr>
      </table>
	  <div align="center">
        <input name="Submit" value="Submit" type="submit" />
        
      </div>
    </form>

<a href="index.php?edits">Edit Students Records</a>

    </div>


<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<?php include("includes/header.php"); ?>    
<style type="text/css">
<!--
.style1 {color: #FF0000}
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


<div style="width:650px;">
<p><a href="index.php?addviewwdit">Edit Courses</a>
<br></p>
<?php 

if(isset($_POST['Submit'])){
$prog=$_POST['programe'];
$title=$_POST['title'];
$code=$_POST['code'];
$unit=$_POST['unit'];
$semester=$_POST['semester'];
$session = $_POST['session'];

// Check if records exist in the data base

$msql=mysqli_query($conn,"SELECT * FROM `course` 
WHERE Programme ='$prog' && 
semester='$semester' && 
code = '$code' && sessions = '$session'") or die(mysqli_error());

$valid = mysqli_fetch_assoc($msql);
if ($code ==$valid['code']){
echo "<i><font color='red'>This caourse cannot be registaerd twice</i></font>"; 
}else{


//insert records into the database

$query=mysqli_query($conn,"INSERT INTO `course` (`Programme`, `unit`, `semester`, `code`, `title`,`sessions`) 
VALUES ('$prog', '$unit', '$semester', '$code', '$title','$session')") or die(mysqli_error());
}


?>
      <table border="1" style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1" >
        <tr bgcolor="">
          <td style="height: 25px"><span style="font-weight: bold;">S/n</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Title</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Code</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Unit</span></td>
        </tr>
        <?php 
        
        $sql=mysqli_query($conn,"SELECT * FROM `course` 
WHERE Programme ='$prog' && 
semester='$semester' && 
sessions = '$session'") or die(mysqli_error());

        
  $n= 0 ;
  while($row=mysqli_fetch_assoc($sql)){
  $n = $n+1;
  ?>
        <tr bgcolor="">
          <td><span style="font-weight: bold;"><?php echo $n;?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['title'];?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['code'];?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['unit'];?></span></td>
        </tr>
        <?php }?>
      </table>
      <?php ?>
      <table border="0">
        <tr>
          <td>
          
          <form action="" method="post" name="form2" id="form2" onSubmit="MM_validateForm('title','','R','code','','R','code','','R');return document.MM_returnValue" onfocus="MM_validateForm('0','','R','0','','R','1','','R','1','','R','0','','R','1','','R');return document.MM_returnValue">
              <table border="0">
                <tr>
                  <td><span style="color: #FFFFFF">Programme:</span></td>
                  <td><span style="color: #FFFFFF">
                    <label>
                    <input name="programe" type="hidden" id="programe" value="<?php echo $prog;?>" />
                    </label>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Title: </span></td>
                  <td ><input name="title" value="" type="text" id="title" size="50"  placeholder="Course Title"/></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Code: </span></td>
                  <td ><span style="vertical-align: top;">
                    <input name="code" id="code" value="" maxlength="9" placeholder="Course Code"/>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Unit:</span></td>
                  <td ><select name="unit" id="select2">
                      <option>Choose Unit</option>
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
                    <input name="semester" type="hidden" id="semester"  value="<?php echo $semester;?>"/>
                     <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
                    </label>
                  </span></td>
                </tr>
              </table>
            <label>
              <input name="Submit" type="submit" id="Submit" value="Add Course" />
              </label>
          </form></td>
        </tr>
      </table>
      <?php 


exit(); 
}
?>
      <table border="0">
        <tr>
          <td><form action="" method="post" name="form1" id="form1" onSubmit="MM_validateForm('0','','R','0','','R','1','','R','1','','R','0','','R','1','','R');MM_validateForm('title','','R','code','','R','title','','R','code','','R','code','','R','code','','R');return document.MM_returnValue">
              <table border="0">
                <tr>
                  <td ><span style="font-weight: bold">Programme:</span></td>
                  <td ><span style="font-weight: bold">
          <select name="programe" id="programe">
 <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
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
                  <td ><span style="font-weight: bold">Course Title: </span></td>
                  <td ><input name="title" type="text" id="title" value="" size="50"  placeholder="Course Title"/></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Code: </span></td>
                  <td ><span style="vertical-align: top;; font-weight: bold">
                    <input name="code" id="code" value="" maxlength="9" placeholder="Course Code"/>
                  </span></td>
                </tr>
                <tr>
                  <td ><span style="font-weight: bold">Course Unit:</span></td>
                  <td ><span style="font-weight: bold">
                    <select name="unit" id="unit">
                      <option>Choose Unit</option>
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
                    <select name="semester">
                      <option>Choose Semester</option>
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
                  <td ><select name="session">
                 
				  <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
				   <option>2017/2018</option>
				    <option>2018/2019</option>
				     <option>2019/2020</option>
				      <option>2020/2021</option>
				   </select></td>
                </tr>
              </table>
            <label>
              <input name="Submit" type="submit" id="Submit" value="Add Course" />
              </label>
          </form></td>
        </tr>
      </table>



      </div>

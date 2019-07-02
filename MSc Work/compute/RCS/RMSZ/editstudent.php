<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    
    
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
.style1 {color: #000000}
.style3 {color: #FF0000}
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
.style4 {color: #000033}
.style7 {color: #FFF; font-weight: bold; }
.style8 {color: #FFF}
.auto-style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: small;
}
-->
</style>
</head>

<body>
  <div style="float:left; width:600px;">
	<?php 
if(isset($_POST['Submit2'])){	
$name = $_POST['names'];
$matno=$_POST['mat'];
$sex=$_POST['sex'];
$matno2=$_POST['mat2'];
$id = $_POST['id'];
$atw = $_POST['atw'];
$session = $_POST['session'];
$year = $_POST['year'];
$progr = $_POST['prg'];
$progr2 = $_POST['dept'];


$sql=mysqli_query($conn,"UPDATE `studentsnm` SET `names` = '$name',`matno` = '$matno',
`Withdrwan`='$atw',`sex`='$sex', `session` = '$session', `year` = '$year', `dept` = '$progr' 
WHERE `studentsnm`.`sn` ='$id' ") or die (mysqli_error());

if($atw==0){
$msql=mysqli_query($conn,"UPDATE `results` SET `name` = '$name',
`matric_no` = '$matno', `programme` = '$progr', `session` = '$session'  
WHERE `results`.`matric_no` ='$matno2'") or die (mysqli_error());
}else{
$msql=mysqli_query($conn,"UPDATE `results` SET `name` = '$name',
`matric_no` = '$matno', `programme` = '$progr', `session` = '$session', stat = '$atw' 
WHERE `results`.`matric_no` ='$matno2'") or die (mysqli_error());

}

echo "<font color = 'red'><i>"."Successful!!"."</i></font>";
echo '<h3>'.$_POST['dept'].'<h3>';

?>
<table border="1" style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1">
            <tr bgcolor=""  >
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
			$sql=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE dept = '$dept' && year ='$year' ORDER BY `matno` ASC");
			$n=0;
			 while ($row=mysqli_fetch_assoc($sql)){
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
			  if($status==0){
				  echo "<font color='#000000'>Active</font>";
			  }elseif($status==1){
					  echo "<font color='#FF0000'>In_Active</font>";
				  }?>
              </span></td>
              <td style="height: 16px" >
<a href="index.php?edits= &id=<?php echo $row['sn']."&"."Edit="."edit"."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style4">EDIT</a></td>
              <td style="height: 16px" ><a href="index.php?id=<?php echo $row['sn']."&"."deletes="."del"."&"."matno=".$row['matno']."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style4">DELETE</a></td>
            </tr><?php  }?>
      </table>
	  <br/>
	
	<?php exit; }	?>
	
	<?php if (isset($_GET['deletes'])){
	$id = $_GET['id'];
$matno = $_GET['matno'];

	$query=mysqli_query($conn,"DELETE FROM `studentsnm` WHERE sn = '$id'") or die (mysqli_error());
	
	$query=mysqli_query($conn,"DELETE FROM `results` WHERE matric_no = '$matno'") or die (mysqli_error());
	
	echo "<font color = 'red'><i>"."Deleted"."</i></font>";
	}
	
	?>
	
	
	<?php if (isset($_GET['Edit'])){
	$id = $_GET['id'];
	$query=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE sn = '$id'") or die (mysqli_error());
	$row=mysqli_fetch_assoc($query);
	?>
	
        
        <form id="form1" name="form1" method="post" action="">
          <table border="" style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1">
            <tr>
              <td style="height: 29px" ><strong>PROGRAMME:</strong></td>
              

              <td style="height: 29px" >
              
              <input style="height:auto;" name="dept" type="hidden" id="dept"  value="<?php echo $row['dept'];?>" size="50" readonly="1"/>
              <select name="prg" id="prg">
                <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
             <option selected="selected">	<?php echo $row['dept'];?>
             </otion>
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
                           
    			  
                </select>
              
              <input name="id" type="hidden" id="id" value="<?php echo $row['sn'];?>" />              </td>
            </tr>
            <tr>
              <td style="height: 29px" ><strong>NAME:</strong></td>
              <td style="height: 29px" ><input name="names" style="height:auto;" type="text" id="names"  value="<?php echo $row['names'];?>" size="30"/>              </td>
            </tr>
            <tr>
              <td ><strong>GENDER:</strong></td>
              <td ><input name="sex" style="height:auto;" id="sex" value="<?php echo $row['sex'];?>" size= "15" /></td>
            </tr>
            <tr>
              <td ><strong>MATRIC NO: </strong></td>
              <td ><input name="mat" style="height:auto;" id="mat" value="<?php echo $row['matno'];?>" size= "15" />
                <input name="mat2" id="mat2" value="<?php echo $row['matno'];?>" size= "15" type="hidden" />
                                 <input name="year"  type="hidden"id="year" value="<?php echo $row['year'];?>" size= "8" />
                  <span class="style3">*</span></td>
            </tr>
            <tr>
              <td ><strong>SESSION:</strong></td>
              <td ><select name="session" style="height:auto;" id="session">
                  <option selected="selected"><?php echo $row['session'];?></option>
                         <?php echo include('includes/sessions.php');?>

              </select> - 
			  <select name="year" style="height:auto;" id="year">
                  <option selected="selected"><?php echo $row['year'];?></option>
                         <?php 
                         for($i = 14; $i<=25; $i++){
                         
                         echo "<option>".$i."</option>";
                         }
                         //include('includes/sessions.php');?>

              </select>
              </td>
            </tr>
            <tr>
              <td ><strong>STATUS:</strong> </td>
              <td ><select name="atw" style="height:auto;" id="atw">
                <option value="0" selected="selected">Active</option>
                <option value="1">InActive</option>
              </select>               </td>
            </tr>
          </table>
                <input type="submit" name="Submit2" value="Update" />
                </form>
                
                
        	<?php exit;  }
        	
//        	
        	
        	
        	
        	

	if (isset($_POST['Submit'])){
	echo '<h3>'.$_POST['dept'].'</h3>';
	?>
	<table border="0">
      <tr>
        <td>
          <table border="1" style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1" >
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
			$sql=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE dept = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC");
			$n=0;
			 while ($row=mysqli_fetch_assoc($sql)){
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
			  if($status==0){
				  echo "Active";
			  }elseif($status==1){
					  echo "<font color='#FF0000'>In_Active</font>";
				  }?>
              </span></td>
              <td ><a href="index.php?edits= &id=<?php echo $row['sn']."&"."Edit="."edit"."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style1">EDIT</a></td>
              <td ><a href="index.php?id=<?php echo $row['sn']."&"."deletes="."del"."&"."matno=".$row['matno']."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style1">DELETE</a></td>
            </tr><?php  }?>
          </table>
            
        </td>
      </tr>
    </table><?php exit; }?>
    
    
    <form id="form2" name="form2" method="post" action="">
          <table border="0">
            <tr>
              <td style="height: 30px" ><strong>PROGRAMME:</strong></td>
              <td style="height: 30px; width: 86px">
                <select name="dept" id="dept">
                <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
    			  
                </select>
              </td>
            </tr>
            <tr>
              <td ><strong>YEAR:</strong></td>
              <td style="width: 86px" >
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
                </select>
             </td>
            </tr>
            <tr>
              <td ><strong>SESSION:</strong></td>
              <td style="width: 86px" >
                <select name="session" id="session">
                  <option selected="selected"></option>
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
                    <input type="submit" name="Submit" value="Submit" />
                          </form>
                          
                          <a href="index.php?regs">Register Student</a>
         </div>

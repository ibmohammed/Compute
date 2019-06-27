<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>RMS GROUP PROGRAMMES </title>
</head>

<body>

<?php
if(isset($_POST['Submit'])){
if (!empty($_POST['Check_list'])){

$pass = $_POST['pass']; 
$dep = $_POST['deptcode']; 
$college = $_POST['college'];
$collegecode =$_POST['collegecode'];
$school  = $_POST['school'];
$schoolcode  =$_POST['schoolcode'];

$qry = mysqli_query($conn,"SELECT * FROM `logintbl` WHERE password ='$pass'") or die(mysqli_error()); 
$numrow = mysqli_num_rows($qry);

if($numrow >= 1 ){

$updts = mysqli_query($conn,"UPDATE `logintbl` 
SET `progs` = '$dep' WHERE `logintbl`.`password` = '$pass'") 
or die(mysqli_error($conn));


foreach($_POST['Check_list'] as $selected){
$dep = $_POST['deptcode']; 
//echo $selected."<br>45";
$sql = mysqli_query($conn,"UPDATE `dept` SET 
`prog` = '$dep',
`college`='$college', 
`collegecode`='$collegecode',
`school`='$school',
`schoolcode`='$schoolcode'
 WHERE `dept`.`id` ='$selected';")or die(mysqli_error($conn));
echo $selected;
}

}else{

echo "<script language='javascript'>alert('password in correct');</script>";
}

}
}
?>

<div>
	<form action="" method="post">
		<table  border="1" cellpadding="1" cellspacing="0" style="width: 100%; height: 33px; border-collapse: collapse">
			<tr>
          <td colspan="2"><strong>COLLEGE:</strong><select name="college">
		  <option>COLLEGE OF SCIENCE AND TECHNOLOGY</option>
		   <option>COLLEGE OF ADMINISTRATIVE AND BUSINESS STUDIES</option>
		  </select></td>
            </tr>
			<tr>
          <td colspan="2"><strong>COLLEGECODE:</strong>&nbsp;&nbsp;<select name="collegecode">
		  <option>CST</option>
		   <option>CABS</option>
		  </select></td>
            </tr>
			<tr>
          <td colspan="2"><strong>SCHOOL:</strong><input name="school" type="text" style="width: 383px"/></td>
            </tr>
			<tr>
          <td colspan="2"><strong>SCHOOL CODE:</strong><input name="schoolcode" type="text" style="width: 76px"/></td>
            </tr>
			<tr>
          <td colspan="2"><strong>DEPT CODE: <input name="deptcode" type="text"/></strong></td>
            </tr>
			<tr>
          <td colspan="2"><strong>PASSWORD: <input name="pass" type="password"/>
				</strong></td>
            </tr>
			<tr>
				
				<td style="height: 23px; width: 355px" colspan="4">
				&nbsp;</td>
				
			</tr>
			<tr>
				<td style="height: 23px; width: 67px">SN</td>
				<td style="height: 23px; width: 768px">Programme</td>
				<td style="height: 23px">Select</td>
				<td style="height: 23px">Code</td>
			</tr>
			<?php
			include('dptcode.php') ;
			
$query = mysqli_query($conn,"SELECT * FROM `dept`") or die(mysqli_error());	

//$query = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());	

$n = 0;	
while($row = mysqli_fetch_assoc($query)){
$n++;
 ?>
			<tr>
				<td style="width: 67px"><?php echo "$n";?>&nbsp;</td>
				<td style="width: 768px"><?php echo $row['dep'];?>&nbsp;</td>
				<td>&nbsp;<input name="Check_list[]" type="checkbox" value="<?php echo $row['id'];?>" /></td>
				<td><?php echo $row['prog'];?>&nbsp;</td>
			</tr><?php }?>
			<tr>
				<td style="width: 67px">&nbsp;</td>
				<td style="width: 768px">&nbsp;</td>
				<td><input name="Submit" type="submit" value="submit" />&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</form>
</div>

</body>

</html>

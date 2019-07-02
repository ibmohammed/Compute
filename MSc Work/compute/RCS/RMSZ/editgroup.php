<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); 

if (!isset($_SESSION)) {
  session_start();
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>

<!-- query Execution -->



<!-- Records table -->
<?php
$departmentcode = $_SESSION['deptcode'];
$deptcd = $departmentcode;

$sqlm = mysqli_query($conn,"SELECT * 
FROM `dept` WHERE prog = '$deptcd'") or die(mysql_error());

 ?>

<table style="width: 75%">
	<tr>
		<td>SN</td>
		<td>Programmes</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	<?php 
	$n = 0;
	while ($rows = mysqli_fetch_assoc($sqlm)){
	$n++;
	?>
	<tr>
		<td><?php echo $n;?></td>
		<td><?php echo $rows['dep'];?></td>
		<td><a href="index.php?id=<?php echo $rows['id']."&ed=0";?>">Delete</a></td>
		<td><a href="index.php?id=<?php echo $rows['id']."&ed=1";?>">Edit</a></td>
	</tr><?php }?>
</table>




</body>

</html>

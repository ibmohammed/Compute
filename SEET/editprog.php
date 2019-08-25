<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); 

if (!isset($_SESSION)) {
  session_start();
}

?>

<!-- query Execution -->

<!-- Records table -->
<?php
$departmentcode = $_SESSION['deptcode'];
$deptcd = $departmentcode;

$sqlm = prog_function($logs);

 ?>

<table class="table table-bordered">
	<tr>
		<td>SN</td>
		<td>Departments</td>
		<td>Delete</td>
		<td>Edit</td>
	</tr>
	<?php 
	$n = 0;
	while ($rows = mysqli_fetch_assoc($sqlm)){
	$n++;
	?>
	<tr>
		<td><?php echo $n;?></td>
		<td><?php echo $rows['programme'];?></td>
		<td><a href="index.php?id=<?php echo $rows['prog_id']."&edpr=0";?>">Delete</a></td>
		<td><a href="index.php?id=<?php echo $rows['prog_id']."&edpr=1";?>">Edit</a></td>
	</tr><?php }?>
</table>
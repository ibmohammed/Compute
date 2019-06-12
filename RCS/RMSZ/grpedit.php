<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<?php 
include("includes/header.php"); 

if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
if(isset($_POST['editbtn'])){

$ndept = $_POST['ndept'];
$odept = $_POST['odept'];
//$dept = $_GET['dept'];
//$college = $_GET['college'];
$ndcode  = $_POST['ndcode'];
$odcode  = $_POST['odcode'];
//$school = $_GET['school'];
//$scode = $_GET['scode'];
$id = $_POST['dept_id'];

$sqls = mysqli_query($conn,"UPDATE `departments` SET 
`name` = '$ndept',
`code` = '$ndcode'
 WHERE `dept_id` ='$id'") or die(mysqli_error($conn));

 //$msqls = mysqli_query($conn, "") or die (mysqli_error($conn));


//$resu = mysqli_query($conn,"UPDATE `results` SET 
//`programme` = '$ndept' WHERE `programme` ='$odept'") or die(mysqli_error($conn));



echo "Successful!";

}elseif(isset($_GET['ed'])){

$id = $_GET['id'];

if($_GET['ed'] == 1){
echo "<p><h2>Edit Department</h2></p>";
$sql = mysqli_query($conn,"SELECT * FROM `departments` WHERE `dept_id` = '$id'") or die(mysqli_error($conn));
$col = mysqli_fetch_assoc($sql);?>


<form action="" method="POST">

		<table class="table table-bordered">
			
			<tr>
				<td>Department:</td>
				<td>
				<input name="ndept" type="text" value="<?php echo $col['name'];?>" placeholder = "<?php echo $col['name'];?>" class="form-control"/></td>
				<input name="odept" type="hidden" value="<?php echo $col['name'];?>" placeholder = "<?php echo $col['name'];?>" class="form-control"/>
			</tr>
			<tr>
				<td>Dept Code:</td>
				<td>
				<input name="ndcode" type="text"  value="<?php echo $col['code'];?>" placeholder = "<?php echo $col['code'];?>" class="form-control"/></td>
				<input name="odcode" type="hidden"  value="<?php echo $col['code'];?>" placeholder = "<?php echo $col['code'];?>" class="form-control"/>
			</tr>
			
		</table>
		<br>
		<input name="dept_id" type="hidden"  value="<?php echo $col['dept_id'];?>" placeholder = "<?php echo $col['code'];?>" class="form-control"/>
			<p><input name="editbtn" type="submit" value="Edit Department"  class="btn btn-gradient-primary mr-2"/> </p>
			<br>
</form>

<hr>
<?php }else{
echo "Delete Records";

$sql = mysqli_query($conn,"DELETE FROM `dept` WHERE `dept`.`id` = '$id'") or die(mysqli_error());
}
}
 ?>

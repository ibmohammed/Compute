<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<?php 
//include("includes/header.php"); 

if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
if(isset($_POST['editbtnp'])){

$ndept = $_POST['ndept'];
$odept = $_POST['odept'];

$id = $_POST['prog_id'];

$sqls = mysqli_query($logs,"UPDATE `programmes` SET 
`programme` = '$ndept'
 WHERE `prog_id` ='$id'") or die(mysqli_error($logs));


echo "Successful!";

}elseif(isset($_GET['edpr'])){

$id = $_GET['id'];

if($_GET['edpr'] == 1){
echo "<p><h2>Edit Programme</h2></p>";
$sql = mysqli_query($logs,"SELECT * FROM `programmes` WHERE `prog_id` = '$id'") or die(mysqli_error($logs));
$col = mysqli_fetch_assoc($sql);?>


<form action="" method="POST">

		<table class="table table-bordered">
			
			<tr>
				<td>Programme:</td>
				<td>
				<input name="ndept" type="text" value="<?php echo $col['programme'];?>" placeholder = "<?php echo $col['programme'];?>" class="form-control"/></td>
				<input name="odept" type="hidden" value="<?php echo $col['programme'];?>" placeholder = "<?php echo $col['programme'];?>" class="form-control"/>
			</tr>
			
			
		</table>
		<br>
		<input name="prog_id" type="hidden"  value="<?php echo $col['prog_id'];?>" class="form-control"/>
			<p><input name="editbtnp" type="submit" value="Edit Department"  class="btn btn-gradient-primary mr-2"/> </p>
			<br>
</form>

<hr>
<?php }else{
echo "Delete Records";

$sql = mysqli_query($logs,"DELETE FROM `dept` WHERE `dept`.`id` = '$id'") or die(mysqli_error());
}
}
 ?>

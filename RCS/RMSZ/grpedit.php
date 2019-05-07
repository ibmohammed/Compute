<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<?php 
include("includes/header.php"); 

if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
if(isset($_GET['editbtn'])){

$prg = $_GET['dept'];
$oprg = $_GET['odept'];
$college = $_GET['college'];
$ccode  = $_GET['ccode'];
$school = $_GET['school'];
$scode = $_GET['scode'];
$id = $_GET['id'];

$sqls = mysqli_query($conn,"UPDATE `dept` SET 
`dep` = '$prg',
`college` = '$college',
`collegecode` = '$ccode',
`school` = '$school',
`schoolcode` = '$scode' WHERE `dept`.`id` ='$id'") or die(mysqli_error());


$resu = mysqli_query($conn,"UPDATE `results` SET 
`programme` = '$prg' WHERE `programme` ='$oprg'") or die(mysqli_error());



echo "Successful!";

}elseif(isset($_GET['ed'])){

$id = $_GET['id'];

if($_GET['ed'] == 1){
echo "Edit Records";
$sql = mysqli_query($conn,"SELECT * FROM `dept` WHERE `dept`.`id` = '$id'") or die(mysqli_error());
$col = mysqli_fetch_assoc($sql);?>


	<form action="" method="get">

<table style="width: 100%">
	<tr>
		<td>Programme: <input name="id" type="hidden"  value="<?php echo $col[0];?>"/> </td>
		<td><input name="dept" type="text" value="<?php echo $col['dep'];?>" />&nbsp;<input name="odept" type="hidden" value="<?php echo $col['dep'];?>" /></td>
	</tr>
	<tr>
		<td>College:</td>
		<td>
		<input name="college" type="text" value="<?php echo $col['college'];?>" style="width: 488px" /></td>
	</tr>
	<tr>
		<td>College Code:</td>
		<td><input name="ccode" type="text"  value="<?php echo $col['collegecode'];?>" /></td>
	</tr>
	<tr>
		<td>School:</td>
		<td>
		<input name="school" type="text" value="<?php echo $col['school'];?>" style="width: 487px" /></td>
	</tr>
	<tr>
		<td>School Code:</td>
		<td><input name="scode" type="text" value="<?php echo $col['schoolcode'];?>" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input name="editbtn" type="submit" value="Edit Record" />&nbsp;</td>
	</tr>
</table>
</form>


<?php }else{
echo "Delete Records";

$sql = mysqli_query($conn,"DELETE FROM `dept` WHERE `dept`.`id` = '$id'") or die(mysqli_error());
}
}
 ?>

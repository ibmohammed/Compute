<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php //include("includes/header.php"); ?>    

<?php
if (isset($_POST['Submit'])){
$uname = $_POST['username'];
$pwd = $_POST['password'];
$uname2 = $_POST['username2'];
$pwd2 = $_POST['password2'];
$pgs = $_POST['dptcode'];

?>
<?php
$logintbl="UPDATE logintbl SET username = '$uname2',
password = '$pwd2', progs = '$pgs'  WHERE logintbl.password = '$pwd' AND logintbl.username = '$uname'";
//$logintbl="INSERT INTO logintbl ( username, password
//)VALUES ('$uname','$pwd')";
  
    if (mysqli_query($logs,$logintbl)){
echo "<script language = 'javascript'>alert('Succesful!')</script>";        }else{
        echo"request failed .";
        echo mysqli_error();
       }
    }
	?>
<div align="center">

<form id="form1" name="form1" method="POST" action="">
          <div align="left" class="style1">
    </div>
    <table border="1" align="center" cellpadding="1" cellspacing="1" style="width:300px; border-collapse:collapse;">
      <tr>
        <th align="left" style="height: 30px" >User Name : </th>
        <th align="left" style="width: 134px; height: 30px;" > <input name="username" type="text" value="Coordinator" />          </th>
      </tr>
      <tr>
        <th align="left" >Password : </th>
        <th align="left" style="width: 134px" ><input type="text" name="password" /></th>
      </tr>
      <tr>
        <th align="left" >New User Name:</th>
        <th align="left" style="width: 134px" ><input name="username2" type="text" value="Coordinator" />   </th>
      </tr>
      <tr>
        <th align="left" >New Password : </th>
        <th align="left" style="width: 134px" ><input type="text" name="password2" /></th>
      </tr>
      <tr>
        <th align="left" >Dept Code:</th>
        <th align="left" style="width: 134px" >
		<input name="dptcode" type="text" value="<?php echo $_SESSION['deptcode'];?>"></th>
      </tr>
      </table>
      <input type="submit" name="Submit" value="Submit" />
          </form>
     

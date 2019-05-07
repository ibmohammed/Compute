<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once('connection.php');


if(isset($_POST['submit']))
{
  if(empty($_POST['username'])||empty($_POST['password']))
  {
    header("location:login.php?empty=Please Fill in the Blank");
    // this send to the URL the message to be displayed if the fields are empty
  }
  else
  {
    //query
    $query = "";
    $result = mysqli_query($conn, $query);

    if(mysqli_fetch_assoc($result))
    {
      $_SESSION['username'] = $_POST['username'];
      header("location:page.php");
    }
    else
    {
      // code...
      header("location:login.php?Invalid=Please Enter Correct Username and Password");
    }

    // code..
  }

}
else
{
  echo "Not working now";
  // code...
}
?>











<?php
// Use the below code to display the message on the required pages
if(@$_GET['empty']==True)
{
  ?>
  <div><?php echo $_GET['empty'];?></div>
  <?php
}
if(@$_GET['Invalid']==True)
{
  ?>
  <div><?php echo $_GET['Invalid'];?></div>
  <?php
}
?>




<?php
// Redirect page if not login
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_SESSION['username']))
{
// view the page
}
else
{
  // code...
  header("location:login.php");
}
?>

<?php
//Logut and destroy session
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_GET['logout']))
{
  session_destroy();
  header("location:login.php");
}
?>

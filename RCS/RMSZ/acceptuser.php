<?php require("includes/header.php");?>
<?php
$uname = $_POST['username'];
$pwd = $_POST['password'];
$dptdcode = $_POST['dptdcode'];

?>
<?php
$logintbl="INSERT INTO logintbl ( username, password,progs
)VALUES ('$uname','$pwd','$dptdcode')";
  
    if (mysqli_query($conn,$logintbl)){
        header("location:adduser.php");
       }else{
        echo"request failed .";
        echo mysqli_error();
       }
    ?>
<?php require("includes/footer.php");?>
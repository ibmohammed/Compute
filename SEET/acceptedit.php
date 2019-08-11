<?php require("includes/header.php");?>
<?php
$uname = $_POST['username'];
$pwd = $_POST['password'];
$uname2 = $_POST['username2'];
$pwd2 = $_POST['password2'];

?>
<?php
$logintbl="UPDATE logintbl SET username = '$uname2',
password = '$pwd2' WHERE logintbl.password = '$pwd' AND logintbl.username = '$uname'";

  
    if (mysqli_query($conn,$logintbl)){
        header("location:editstrec.php");
       }else{
        echo"request failed .";
        echo mysqli_error();
       }
    ?>
    <?php require("includes/footer.php");?>
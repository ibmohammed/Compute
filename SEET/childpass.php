<?php
if (!isset($_SESSION))
{
  session_start();
  require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');
}


$MM_restrictGoTo = "logins.php";

if (!((isset($_SESSION['comfirmstaff']))))
{
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
    if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
    $MM_referrer .= "?" . $QUERY_STRING;
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: ". $MM_restrictGoTo);
    exit;
}

  if(isset($_POST['submit']))
  {
    $userid = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password !== $cpassword)
    {
      header("location:childpass.php?Invalid=Password entries are incorrect");
      echo $password;
    }

    $stmt = make_change_spass($_SESSION['stid'], $_POST['password'], $logs);

    if(mysqli_affected_rows($logs) !== 0)
    {
      echo "password changed<br>";
      unset($_SESSION['comfirmstaff']);
      unset($_SESSION['stid']);
    }

    ?>
continue
    <?php

    // destroy session
    //session_destroy();


    //header("location:login.php");


  }
?>

<!DOCTYPE html>
<html>
<title>NSPZ Student Profile</title>
<meta charset="UTF-8">
<link rel="icon" href="../.../images/img2A.jpg" type="image/x-jpg">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../.../w3/w3.css">
<link rel="stylesheet" href="../.../w3/w3-theme-blue-grey.css">
<link rel='stylesheet' href='../.../w3/family.css'>
<link rel="stylesheet" href="../.../w3/font-awesome.min.css">
<meta http-equiv="refresh" content="8; url='childpass.php'" />
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>


<body class="w3-theme-l5">
  <!--<body onfocusout="javascript:window.opener='x';window.close();">-->
  <?php
  if(@$_GET['Invalid']==True)
  {
    ?>
    <div style="color:#f4021a; font-style:italic; text-align:center; font-family:courier">
      <?php echo $_GET['Invalid'];?>
    </div>
    <?php
  }
  ?>
<br>
<div align="center">
  <?php echo @$_SESSION['comfirmstaff']. @$_SESSION['stid'];?>
  <form class="login100-form validate-form p-b-33 p-t-5" name="form1" action="" method="post">
<br>
    <div class="wrap-input100 validate-input" data-validate = "Enter username">
      <input class="input100" type="hidden" name="username" placeholder="User name" value="<?php echo @$_SESSION['comfirmstaff'];?>" >
      <span class="focus-input100" data-placeholder="&#xe82a;"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Enter password">
      <input class="input100" type="password" name="password" placeholder="Enter new password">
      <span class="focus-input100" data-placeholder="&#xe80f;"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Enter password">
      <input class="input100" type="password" name="cpassword" placeholder="Comfirm Password">
      <span class="focus-input100" data-placeholder="&#xe80f;"></span>
    </div>

    <div class="container-login100-form-btn m-t-32">
      <button class="login100-form-btn" name="submit">
        Change password
      </button>

    </div>

  </form>

</div>

</body>
</html>

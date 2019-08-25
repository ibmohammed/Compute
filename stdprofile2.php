<?php
if (!isset($_SESSION))
{
  session_start();
  require_once('functions/queries.php');
  require_once('connections/connection.php');
}


$MM_restrictGoTo = "Login_v3/index.php";

if (!((isset($_SESSION['comfirmuser']))))
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


?>
<!DOCTYPE html>
<html>
<title>NSPZ Student Profile</title>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html;" />
<meta http-equiv="refresh" content="4; url='stdprofile2.php?Ok'" />
<link rel="icon" href="images/img2A.jpg" type="image/x-jpg">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>

<body class="w3-theme-l5">
<div align=center>
<!-- Navbar -->
<a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">
<img src="images/img2A.jpg" width="150px" heigth="150px">
<br>
Niger State Polytechnic, Zungeru
</a>

</div>
      <?php
      if(isset($_GET['Cancel']))
      {
        echo "The Matric Number you entered is incorrect, please Check for the correct matric number and try again ";
        echo "<a href='Login_v3/index.php'> Back</a>";
        exit();
      }
      ?>
      <?php
        $return_result = students_data($_SESSION['comfirmuser'],$logs);
        $data = mysqli_fetch_assoc($return_result);

        ?>

   
    <h1>My Identity Comfirmation</h1>
    <hr>
    
<div style="color:Black; border-radius:5px; border:solid; width:100%; border-color:Gold; text-align:center">
<h2>Note: Carefully Comfirm The Name, Matric Number and Department Below</h2>
</div>  
<div style="color:Blue; font-size:18pt;">
    <?php echo $data['names'];
    $_SESSION['MM_Username'] = $data['matno'];

    $retnt = programmes($data['prog_id'], $logs);
    $prgid = mysqli_fetch_assoc($retnt);
    ?>
    
    <p><?php echo $data['matno'];?></p>
    <p><?php echo $prgid['programme'];?></p>
    <p><?php echo $data['session'];?></p>
    </div>
<hr>
<div style="color:Black; border-radius:5px; border:solid; width:100%; border-color:Gold; text-align:center">
      <?php
      if(isset($_GET['Ok']))
      {
        
        echo "<p><button style='height:100px;'>
        <a href='SEET/index.php' style='color:red'>Click here </a> 
        if the information above is not correct about you please verify your matric number and try login again
        </button></p><br>";

            echo "<p><button style='height:100px;'>
            Change your passowrd to enable you have full access to your profile <br>" ;
             //echo "<a href=''></a>";
             echo '<a  style="color:red" href="javascript:void(0);"
                  NAME="My Window Name"  title=" Change Password "
                  onClick=window.open("childpass.php","Ratting","width=550,height=170,0,status=0,");>
                  Click here to change your password</a>
                  </button></p>
                  ';



      //  exit();
      }
    ?>


</div>

<br>
<hr>
</body>
</html>

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
<link rel="stylesheet" href="w3/w3.css">
<link rel="stylesheet" href="w3/w3-theme-blue-grey.css">
<link rel='stylesheet' href='w3/family.css'>
<link rel="stylesheet" href="w3/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><img src="images/img2A.jpg"></a>
Niger State Polytechnic, Zungeru
  <div class="w3-dropdown-hover w3-hide-small">


  </div>

  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="w3images/user.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
<?php
if(@$_SESSION['comfirmuser'] == True){
  echo $_SESSION['comfirmuser'].':';
//  echo $_SESSION['stid'];
}
?>  </a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
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
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
          <?php echo $data['names'];
                    $_SESSION['MM_Username'] = $data['matno'];

                   $retnt = programmes($data['prog_id'], $logs);
                    $prgid = mysqli_fetch_assoc($retnt);
          ?>
         <hr>

         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $data['matno'];?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $prgid['programme'];?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $data['session'];?></p>
        </div>

      </div>
      <br>
      <br>
      <br><br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br><br>

      <?php
      if(isset($_GET['Ok']))
      {
        echo   ' </div>
        <div class="w3-col m7">

            <div class="w3-row-padding">
              <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                  <div class="w3-container w3-padding">
                    <h4>Comfirmation</h4>';

        echo "<a href='Login_v3/index.php' style='color:red'>Click here </a> if the Name, and Matric Number is not correct about you please verify your matric number and try login again  " ;

             echo '
             </div>
             </div>
             </div>
             </div>
<br>
<br> 
             <div class="w3-col m7">

                 <div class="w3-row-padding">
                   <div class="w3-col m12">
                     <div class="w3-card w3-round w3-white">
                       <div class="w3-container w3-padding">
                         <h4>Change Your Password</h4>';

             echo "Change your passowrd to enable you have full access to your profile <br>" ;
             //echo "<a href=''></a>";
             echo '<a  style="color:red" href="javascript:void(0);"
                  NAME="My Window Name"  title=" Change Password "
                  onClick=window.open("childpass.php","Ratting","width=550,height=170,0,status=0,");>
                  Click here to change your password</a>';

                  echo '</div></div></div></div>';


      //  exit();
      }
    ?>



          </div>
        </div>
      </div>
      <br>
      <!-- End Right Column -->
    </div>

<br>
<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

</body>
</html>

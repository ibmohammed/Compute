<?php
if (!isset($_SESSION))
{
  session_start();
  require_once('functions/queries.php');
  require_once('connections/connection.php');
}


$MM_restrictGoTo = "Login_v3/index.php";

if (!((isset($_SESSION['usercomfirmed']))))
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
<meta http-equiv="refresh" content="20; url='stdprofile.php'" />
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
  <!--<a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><img src="images/img2A.jpg"></a>-->
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><img src="images/img2A.png"></a>
<span style="font-size:12pt" >Niger State Polytechnic, <br>Zungeru</span>
  <div class="w3-dropdown-hover w3-hide-small" >


  </div>

  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="w3images/user.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
<span style="color:gold"><?php
if(@$_SESSION['usercomfirmed'] == True){
  echo $_SESSION['usercomfirmed'];
}
?>(Student) </span> </a><br>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>
<br>
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
       $return_result = students_data($_SESSION['usercomfirmed'],$logs);
        $data = mysqli_fetch_assoc($return_result);

        
        
        $return_dept = departmentss(@$data['dept_id'], $logs);
        $schlid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();
        $return_schl = schoolss(@$schlid['schl_id'], $logs);
        $clgid = mysqli_fetch_assoc($return_schl);
        //$clgid = $result2->fetch_array();
        $return_college = collegess(@$clgid['college_id'], $logs);
        $clg = mysqli_fetch_assoc($return_college);
        //$clg = $result3->fetch_array();


        ?>
      <div class="w3-card w3-round w3-white">
        <div class="w3-container" style="font-size:small">
         <h4 class="w3-center">My Profile</h4>
          <?php echo $data['names'];
                    $_SESSION['MM_Username'] = $data['matno'];
                    $_SESSION['programme'] = $data['dept_id'];
                    $_SESSION['matricno'] = $data['matno'];
                    $_SESSION['session'] = $data['session'];
          ?>
         <hr>

         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $data['matno'];?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $clg['college'];?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $clgid['school'];?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $schlid['name'];?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $data['session'];?></p>
        </div>

      </div>
      <br>
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

        echo "<a href='Login_v3/index.php'>Click here </a> if the Name, and Matric Number is not correct about you please verify your matric number and try login again  " ;

             echo '
             </div>
             </div>
             </div>
             </div>

             <div class="w3-col m7">

                 <div class="w3-row-padding">
                   <div class="w3-col m12">
                     <div class="w3-card w3-round w3-white">
                       <div class="w3-container w3-padding">
                         <h4>Change Your Password</h4>';

             echo "You need to change your passowrd" ;
             //echo "<a href=''></a>";
             echo '<a href="javascript:void(0);"
                  NAME="My Window Name"  title=" Change Password "
                  onClick=window.open("childpass.php","Ratting","width=550,height=170,0,status=0,");>
                  Click here to change your password</a>';

                  echo '</div></div></div></div>';


        exit();
      }
    ?>
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">

        <!--  <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Courses</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>
              <ul>
                <li><a href="stdprofile.php?Courses=1" src="">Semester 1</a></li>
                <li><a href="stdprofile.php?Courses=2" src="">Semester 2</a></li>
                <li><a href="stdprofile.php?Courses=3" src="">Semester 3</a></li>
                <li><a href="stdprofile.php?Courses=4" src="">Semester 4</a></li>
                <li><a href="stdprofile.php?Courses=0" src="">All Semester</a></li>
              </ul>
            </p>
          </div>
        -->
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My results</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p><p>
              <ul>
                <li><a href="stdprofile.php?Results=1" src="">Semester 1</a></li>
                <li><a href="stdprofile.php?Results=2" src="">Semester 2</a></li>
                <li><a href="stdprofile.php?Results=3" src="">Semester 3</a></li>
                <li><a href="stdprofile.php?Results=4" src="">Semester 4</a></li>
                <!--<li><a href="stdprofile.php?Results=0" src="">All Semester</a></li>-->
              </ul>
            <p></p>
          </div>

          <button onclick="myFunction('Demo4')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> <a href="Login_v3/logout.php?logout">SignOut</a> </button>
          <div id="Demo4" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>
      </div>
      <br>



      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Put somthing in here </strong></p>
        <!--<p>People are looking at your profile. Find out who.</p>-->
      </div>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">


      <!-- Set Result -->
        <?php if(@$_GET['Results']==True)
        {
          ?>
          <div class="w3-container w3-card w3-white w3-round w3-margin">
            <br>
            <!--<img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            <span class="w3-right w3-opacity">16 min</span>-->
            <?php
          if(isset($_GET['Results']))
          {
              ?>
            <h4>Results </h4><br>
            <h6 class="w3-opacity"> <?php echo "Smester ". $_GET['Results']." ".$_SESSION['session']." "."Session"; ?></h6>
            <hr class="w3-clear">
        <?php
              $course = $_SESSION['programme'];
              $sem =  $_GET['Results'];
              $sess = $_SESSION['session'];

              //$_SESSION['MM_Username'];
              $mat = $_SESSION['matricno'];
              $semester =  $_GET['Results'];
              require_once('RCS/indresult.php');

            }

               ?>
          </div>
        <?php
      }
      ?>
      <!-- End of Set Result -->

      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">

              <h4>Courses</h4>
              <h6 class="w3-opacity">Latest Result</h6>
              <?php
              $course = $_SESSION['programme'];
            //  $sem =  $_GET['Results'];
               $sess = $_SESSION['session'];

              //$_SESSION['MM_Username'];
              $mat = $_SESSION['matricno'];
            //  $semester =  $_GET['Results'];
              require_once('RCS/courses.php');

              ?>
            <!--  <p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p>
              <button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button>-->
              <?php //include('HostelManagement/profile.php');?>

              <hr class="w3-clear">


            </div>
          </div>
        </div>
      </div>

      <!-- Set Courses -->
      <?php if(@$_GET['Courses']==True){?>
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
      <!--  <img src="/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">1 min</span>-->

        <h4>Courses  </h4><br>
        <hr class="w3-clear">
      </div>
    <?php }?>
      <!-- End of Set Courses -->



      <!-- End Middle Column -->
    </div>

    <!-- Right Column -->

    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">

        <div class="w3-container">
<?php require_once('RCS/calculate_gp.php') ?>

          <p>T C U</p>
          <!--<img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">-->
          <div class="w3-half">
            <button class="w3-button w3-block w3-blue-grey w3-section" title="Accept"><i class="fa"><?php echo @$unit; ?></i></button>
          </div>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>G P </p>
          <!--<img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>-->
          <div class="w3-half">
            <button class="w3-button w3-block w3-blue-grey w3-section" title="Decline"><i class="fa"><?php echo @$gp;?></i></button>
          </div>
          <div class="w3-row w3-opacity">


          </div>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>G P A</p>
          <!--<img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>-->
          <div class="w3-half">
            <button class="w3-button w3-block w3-blue-grey w3-section" title="Decline"><i class="fa"><?php echo @$gpa;?></i></button>
          </div>
          <div class="w3-row w3-opacity">


          </div>
        </div>
      </div>
      <br>
      <!-- End Right Column -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Page Container -->
</div>
<br>
<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else {
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className =
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
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
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NSPZ Student Profile</title>
  <link rel="icon" href="images/img2A.jpg" type="image/x-jpg">
  <!--<meta http-equiv="refresh" content="100; url='stdprofile.php'" />-->
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject 
  <link rel="shortcut icon" href="imagess/favicon.png" />-->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="../../index.html"><img src="imagess/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="imagess/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field d-none d-md-block">
          <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>                
              </div>
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="imagess/faces/face1.jpg" alt="image">
                <span class="availability-status online"></span>             
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black">
                  <?php
if(@$_SESSION['usercomfirmed'] == True){
  echo $_SESSION['usercomfirmed'];
}
?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="SEET/logout.php?logout">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
               
                Signout
              </a>
            </div>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="SEET/logout.php?logout">
              <i class="mdi mdi-power"></i>
            </a>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="mdi mdi-format-line-spacing"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php 
      if(isset($_GET['Cancel']))
      {
        echo "The Matric Number you entered is incorrect, please Check for the correct matric number and try again ";
        echo "<a href='Login_v3/index.php'> Back</a>";
        exit();
      }
       $return_result = students_data($_SESSION['usercomfirmed'],$logs);
        $data = mysqli_fetch_assoc($return_result);

        $return_dept = programmes(@$data['prog_id'], $logs);
        $dptid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();
        $return_dept = departmentss(@$dptid['dept_id'], $logs);
        $schlid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();

        $return_schl = schoolss(@$schlid['schl_id'], $logs);
        $clgid = mysqli_fetch_assoc($return_schl);
        //$clgid = $result2->fetch_array();
        $return_college = collegess(@$clgid['college_id'], $logs);
        $clg = mysqli_fetch_assoc($return_college);
        //$clg = $result3->fetch_array();


        ?>



      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="imagess/faces/face1.jpg" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2" style="font-size:8pt">
                <!--user name-->
                <?php echo $data['names']; 
                
                $_SESSION['MM_Username'] = $data['matno'];
                $_SESSION['programme'] = $data['prog_id'];
                $_SESSION['matricno'] = $data['matno'];
                $_SESSION['session'] = $data['session'];

                ?>
              </span>

              <span class="text-secondary text-small">Student</span>

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

              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="stdprofile.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Semester Results</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="stdprofile_link.php?Results1">First</a></li>
                <li class="nav-item"> <a class="nav-link" href="stdprofile_link.php?Results2">Second</a></li>
                <li class="nav-item"> <a class="nav-link" href="stdprofile_link.php?Results3">Third</a></li>
                <li class="nav-item"> <a class="nav-link" href="stdprofile_link.php?Results4">Fourth</a></li>
              </ul>
            </div>
          </li>

     
    <li class="nav-item">
            <a class="nav-link" href="stdprofile_link.php?setting">
              <span class="menu-title">Settings</span>
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
          </li>
          <?php 
           $course = $_SESSION['programme'];
           //  $sem =  $_GET['Results'];
              $sess = $_SESSION['session'];

             //$_SESSION['MM_Username'];
             $mat = $_SESSION['matricno'];

          require_once('SEET/calculate_gp.php'); 
          ?>


          <li class="nav-item sidebar-actions">
            <span class="nav-link">
          
            </span>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
      
        <div class="content-wrapper">




        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
        <!--          <h4 class="card-title">Results</h4>-->
                  <p class="card-description">
                  <!--  Add class <code>.table-bordered</code>-->
                  </p>



            <?php if(@$_GET["Results"] == True)
        {
          //echo hfhhfh;
          ?>
         
            <br>
           
    
     <!-- semester result-->
  <?php if(isset($_GET['Results']))
          {
              ?>
            
            <h6 class="w3-opacity"> <?php echo "Smester ". $_GET['Results']." <br>".$_SESSION['session']." "."Session"; ?></h6>
            <hr class="w3-clear">
            <?php
            $course = $_SESSION['programme'];
            $sem =  $_GET['Results'];
            $sess = $_SESSION['session'];
            //$_SESSION['MM_Username'];
            $mat = $_SESSION['matricno'];
            $semester =  $_GET['Results'];
            require_once('SEET/indresult.php');
          } 
          ?>
          <hr class="w3-clear">
          <?php
        }
        if(isset($_GET['setting'])){
          echo '<h3>Change password</h3>';
          include('SEET/alluseredit.php');
        }
    
          ?>
        <!-- end of semester result-->
        <!---dashboard -->
       <div class="page-header">
          <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>                 
          </span>
              Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>

          <div class="row">

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">Total Course Unit
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo @$unit; ?></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">Cumulative G P: 
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo @$gp;?></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Cumulative G P A 
                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo @$gpa;?></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
          </div>
          
     <!-- - End of Dashboard -->

     <!-- All courses and result -->

              <h4>My Courses and Results</h4>
              
              <?php
              $course = $_SESSION['programme'];
            //  $sem =  $_GET['Results'];
               $sess = $_SESSION['session'];

              //$_SESSION['MM_Username'];
              $mat = $_SESSION['matricno'];
            //  $semester =  $_GET['Results'];
              require_once('SEET/courses.php');

              ?>

<!-- End of All courses and result -->
              </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
            </div>



        <!-- content-wrapper ends -->
        
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>

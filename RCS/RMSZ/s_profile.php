<?php
if (!isset($_SESSION))
{
  session_start();
  require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');
}


$MM_restrictGoTo = "../../Login_v3/index.php";

if (!((isset($_SESSION['staffcomfirmed']))))
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


?><!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NSPZ Staff Profile</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->

  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->

  <link rel="shortcut icon" href="../../imagess/favicon.png" />
</head>

<body>

  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->

    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../imagess/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../imagess/logo-mini.svg" alt="logo"/></a>
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
                <img src="../../imagess/faces/face1.jpg" alt="image">
                <span class="availability-status online"></span>             
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black">
                  <?php
if(@$_SESSION['staffcomfirmed'] == True){
  echo $_SESSION['staffcomfirmed'];
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
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                
                Signout
              </a>
            </div>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="logout.php?logout1">
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
        echo "The Staff Number you entered is incorrect, please Check for the correct Staff number and try again ";
        echo "<a href='logins.php'> Back</a>";
        exit();
      }
        $return_result = staff_data(@$_SESSION['staffcomfirmed'], $logs);
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



      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="../../imagess/faces/face1.jpg" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2" style="font-size:8pt">
                <!--user name-->
                <?php echo $data['names'];

                    $_SESSION['MM_Username'] = $data['number'];
                    $_SESSION['programme'] = $data['dept_id'];
                    $_SESSION['number'] = $data['number'];
                    $_SESSION['id_staff'] = $data['id'];
                    //$_SESSION['session'] = $data['session'];
          ?>
              </span>

              <span class="text-secondary text-small">Staff</span>

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

        echo "<a href='../../Login_v3/index.php'>Click here </a> if the Name, and Matric Number is not correct about you please verify your matric number and try login again  " ;

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
            <a class="nav-link" href="s_profile.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>

        
  <!--      
    -->
         
          
          
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


<!-- input Result -->
<?php if(isset($_POST['Submitf']))
        {
          ?>
          
            <br>
            <!--<img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            <span class="w3-right w3-opacity">16 min</span>-->
            <?php
          //if(isset($_GET['Results']))
          //{
              ?>
            <h4>Import Results </h4><br>
            <h6 class="w3-opacity"> </h6>
            <hr class="w3-clear">
        <?php
             
       		require_once('csvresn.php');
	      ?>
         
        <?php
      }
      ?>
      <!-- End of input Result -->
         
                  

      
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
                  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">College
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h3 class="mb-5"><?php echo $clg['college'];?></h3>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">School 
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h3 class="mb-5"><?php echo $clgid['school'];?></h3>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Department 
                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h3 class="mb-5"><?php echo $schlid['name'];?></h3>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
          </div>
          
     <!-- - End of Dashboard -->


<!--- course allocation -->

       <h4>Courses</h4>
                            
              <?php
                           
              //require_once('RCS/courses.php');
				$msql = "SELECT * FROM `course` WHERE staff_id = '".$_SESSION['id_staff']."'";
				$msqls = mysqli_query($logs, $msql);
				?>
	<h4 style="color:red">Courses Allocated to <?php echo @$_SESSION['names']." (".@$_SESSION['number'].")";?></h4>
	
		<div>
			<table  class="table table-bordered" style="width:100%">
			
      <thead>
        <tr>
        <th>#</th>  
        <th>CourseCode</th>
        <th>Course Tile</th>
        <th>Course Unit</th>
      </tr>
      </thead>
      <tbody>	
						
			<?php 
			$in = 0;
      while($col = mysqli_fetch_assoc($msqls)){ $in++;
      
      
      ?>
      	<form name="form<?php echo $in;?>" method="post" action="">
				<tr>
				
				
        <td>	<?php echo $in;?></td>
        <td>	<button class="btn btn-gradient-primary mr-2" style="width:150px"  name="Submitf"><?php echo $col['code'];?></button></td>
        <td>		<?php echo $col['title'];?></td>
        <td>		<?php echo $col['unit'];?>
										<input type="hidden" value="<?php echo $col['semester'];?>" name="semester"> 
										<input type="hidden" value="<?php echo $col['sessions'];?>" name="session">
										<input type="hidden" value="<?php echo $col['prog_id'];?>" name="dept_id">
										<input type="hidden" value="<?php echo $col['code'];?>" name="code">
                    <!--&nbsp;&nbsp;<button style="width:70px; font-size:8pt" name="SubmitS"><?php //echo $col['code'];?></button>-->

					
				</td>
        </tr>
        </form>
        <?php }?>
      </tbody>
				
			</table>
      <br>
            
<!--- End of course allocation -->


    
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

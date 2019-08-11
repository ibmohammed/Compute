<?php 
if (!isset($_SESSION)) 
{
  session_start();
}
error_reporting(-1);
ini_set('display_errors', true); 
 
require_once('Connections/logs.php'); 
require_once('../connections/connection.php');
require_once('../functions/queries.php');

$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_GET['accesscheck'])) 
{
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if(isset($_POST['Submit']))
{
	$loginUsername = $_POST['username'];
	$loginUsername =  preg_replace("/[^a-zA-Z0-9\s]/", "", $loginUsername);
	$password = $_POST['pasword'];
	$password =  preg_replace("/[^a-zA-Z0-9\s]/", "", $password);
	$MM_fldUserAuthorization = "";
	$MM_redirectLoginSuccess = "index.php";
	$MM_redirectLoginSuccess2 = "s_profile.php";
	$MM_redirectLoginSuccess3 = "smanage.php";
	$MM_redirectLoginSuccess4 = "exams_record.php";
	$MM_redirectLoginFailed = "logins.php";
	$MM_redirecttoReferrer = true;
	$stmt = mysqli_prepare($conn, 
	"SELECT id, username, password, progs,  t_user, status 
	FROM  `logintbl` WHERE username =?");
	/* bind parameters for markers */
	mysqli_stmt_bind_param($stmt, "s", $loginUsername);
	/* execute query */
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $uname, $pwrd, $prog, $t_user, $number);
	mysqli_stmt_store_result($stmt);
	/* fetch value */
	$deptcode = mysqli_stmt_fetch($stmt);
	$_SESSION['myaidi'] =  $id;
	$_SESSION['utyp'] =  "Staff";  
	$_SESSION["t_user"] = $t_user;

	//departments_code($prog, $conn);
	
	if($t_user == 0)
	//if($row['status']== 0)
	{
		require_once('cord_logs.php');
	}
	elseif($t_user == 1)
	{
		require_once('staff_logs.php');
	}
	elseif($t_user == 2)
	{
		require_once('smanage_logs.php');
	}
	elseif($t_user == 3)
	{
		require_once('xams_logs.php');
	}
	elseif($t_user == 4)
	{
		require_once('s_logs.php');
	}
}
//include("logintop.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body>
 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="../images/logo.svg">
              </div>
			  <h4>Hello! let's get started</h4>
			  
              <h6 class="font-weight-light">Sign in to continue.</h6>

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

			 <form class="pt-3" name="loginform" action="" method="post">
                <div class="form-group">
                  <input type="username" name="username" class="form-control form-control-lg" id="exampleInputEmail100" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="pasword" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button name="Submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div>
			  </form>
			  
			
		
			
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>

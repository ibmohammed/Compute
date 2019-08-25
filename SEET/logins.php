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
	//$loginUsername =  preg_replace("/[^a-zA-Z0-9\s]/", "", $loginUsername);
	$loginUsername =  preg_replace("/[^a-zA-Z0-9\s\/]/", "", $loginUsername);
	$password = $_POST['pasword'];
	$password =  preg_replace("/[^a-zA-Z0-9\s]/", "", $password);

	//check if the user is a student 

	$return_result = students_login($loginUsername, $password, $logs);
	mysqli_stmt_execute($return_result);
	mysqli_stmt_bind_result($return_result, $id, $matric_no, $pwrd, $status);
	mysqli_stmt_store_result($return_result);

	$MM_fldUserAuthorization = "";
	$MM_redirectLoginSuccess = "index.php";
	$MM_redirectLoginSuccess2 = "s_profile.php";
	$MM_redirectLoginSuccess3 = "smanage.php";
	$MM_redirectLoginSuccess4 = "exams_record.php";
	$MM_redirectLoginFailed = "logins.php";
  $MM_redirecttoReferrer = true;
  
  if(mysqli_stmt_num_rows($return_result) == 0)
  {
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

  }
  else 
  {
	$t_user = 4;
  }
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
		
		//session_destroy();
		require_once('s_logs.php');
	}
}
//include("../Login_v3/logintop.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
<!--===============================================================================================-->
<title>NSPZ Student Profile</title>
<meta charset="UTF-8">
<link rel="icon" href="images/img2A.jpg" type="image/x-jpg">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_v3/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Login_v3/css/main.css">
<!--===============================================================================================-->
</head>
<body>

<div class="limiter">
	<div class="container-login100" style="background-image: url('../Login_v3/images/bg-001.jpg');">
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41">
				Account Login
			</span>

			<form class="login100-form validate-form p-b-33 p-t-5" name="form1" action="" method="post">

				<div class="wrap-input100 validate-input" data-validate = "Enter username">
					<input class="input100" type="text" name="username" placeholder="User name">
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<input class="input100" type="password" name="pasword" placeholder="Password">
					<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>

				<div class="container-login100-form-btn m-t-32">
					<button class="login100-form-btn" name="Submit">
						Login
					</button>

				</div>
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
			</form>
		</div>
	</div>
</div>


<?php
//include("../Login_v3/loginbotom.php");
?>

<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="../Login_v3/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../Login_v3/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../Login_v3/vendor/bootstrap/js/popper.js"></script>
<script src="../Login_v3/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../Login_v3/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../Login_v3/vendor/daterangepicker/moment.min.js"></script>
<script src="../Login_v3/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="../Login_v3/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="../Login_v3/js/main.js"></script>

</body>
</html>
<?php 
if (!isset($_SESSION)) 
{
  session_start();
}
error_reporting(-1);
ini_set('display_errors', true); 
 
require_once('Connections/logs.php'); 
require_once('../../connections/connection.php');
require_once('../../functions/queries.php');

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
include("logintop.php");
?>

<div class="limiter">
	<div class="container-login100" style="background-image: url('../../Login_v3/images/bg-001.jpg');">
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
include("loginbotom.php");
?>


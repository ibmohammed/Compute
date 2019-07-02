<?php 
if (!isset($_SESSION)) {
  session_start();
}
?>

<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<?php 
require_once('Connections/logs.php'); 
require_once('../../connections/connection.php');
require_once('../../functions/queries.php');



$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_GET['accesscheck'])) 
{
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

?>
<?php 

if(isset($_POST['Submit']))
{
	$loginUsername = $_POST['username'] ;
	$password = $_POST['pasword'];
	$MM_fldUserAuthorization = "";
	  $MM_redirectLoginSuccess = "index.php";
  	  $MM_redirectLoginSuccess2 = "s_profile.php";
	  $MM_redirectLoginFailed = "logins.php";
	  $MM_redirecttoReferrer = true;
  

	$sql = "SELECT id, username, password, progs,  status FROM  `logintbl` 
	WHERE username='$loginUsername' AND password='$password'";
	
	$result = mysqli_query($conn, $sql);
	$loginFoundUser = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	
	//$_SESSION['deptcode'] = ;
	
	if($row['status']== 0)
	{
		// admin user 
		
		$_SESSION['username'] = $row["username"];
		$_SESSION['password'] = $row["password"];
		$_SESSION['deptcode'] = $row['progs'];
		$_SESSION['stid'] = $row['id'];
		if ($loginFoundUser) 
		{
		
		
			$loginStrGroup = "";
			//declare two session variables and assign them
			$_SESSION['MM_Usernames'] = $loginUsername;
			$_SESSION['MM_UserGroups'] = $loginStrGroup;	      
			
			if (isset($_SESSION['PrevUrl']) && true) 
			{
				$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
			}
			
			echo '<script type="text/javascript">
			location.replace("index.php");
			</script>';
			// exit(header("Location: " . $MM_redirectLoginSuccess ));
			// echo "Yes";
		}
		else 
		{
			echo '<script type="text/javascript">
			alert("incorrect login details");
			location.replace("logins.php");
			</script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
		}
	}
	else
	{
	//staff login 
	
		$_SESSION['staffcomfirmed'] = $row["username"];
		$_SESSION['password'] = $row["password"];
		$_SESSION['deptcode'] = $row['progs'];
		$_SESSION['stid'] = $row['id'];

		
		if ($loginFoundUser) 
		{
		
// start comfirmation //////////////////////
		
			if($_POST['pasword'] == '0000')
		    {
		        $return_comfirm = login_scomfirm($_POST['username'], $_POST['pasword'],$logs);
		
		        $comfirm = mysqli_fetch_assoc($return_comfirm);
		//echo ;
		//      javascript function to comfirm new user entry
		        echo '<p>Click the button to Comfirm that ('.$comfirm['names'].') is your name</p>';
		
		      	echo '<button onclick="myFunction()">Comfirm</button>
		        <p id="demo"></p>
		        <script>
		        var fname ;
		        var othername;
		        function myFunction() {
		          var txt;
		          var fname = "'.$comfirm['names'].'";
		
		
		          var r = confirm("is this your name? \n " + fname + "\nclick OK for Yes and Cancel for No");
		          if (r == true) {
		            txt = "";
		            window.location.href = "s_profile2.php?Ok";
		          } else {
		            txt = "";
		            alert("The Matric Number you entered is incorrect, \nPlease Check for the correct matric number and try again");
		            window.location.href = "index.php";
		
		
		          }
		          document.getElementById("demo").innerHTML = txt;
		        }
		        </script>';
		
		          $_SESSION['comfirmstaff'] = $_POST['username'];
		          exit();
	        }
	        else
	        {
	
			
			
			// end confirmation 
			
			
				
			
				$loginStrGroup = "";
				//declare two session variables and assign them
				$_SESSION['MM_Usernames'] = $loginUsername;
				$_SESSION['MM_UserGroups'] = $loginStrGroup;	      
				
				if (isset($_SESSION['PrevUrl']) && true) 
				{
					$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
				}
				
				echo '<script type="text/javascript">
				location.replace("s_profile.php");
				</script>';
				// exit(header("Location: " . $MM_redirectLoginSuccess ));
				// echo "Yes";
			
	      }
		
		}
		else 
		{
			echo '<script type="text/javascript">
			alert("incorrect login details");
			location.replace("logins.php");
			</script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
		}
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


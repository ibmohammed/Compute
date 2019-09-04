<?php
	
if (!isset($_SESSION))
{
  session_start();
}	
		$_SESSION['username'] = $uname;
		$_SESSION['password'] = $pwrd;
		$_SESSION['deptcode'] = $prog;
		$_SESSION['stid'] = $id;



		if (password_verify($password, $pwrd)) 
		{
			$_SESSION['users_types'] = 2;
			$_SESSION['page_name'] = "NSPZ RMS-Admin";
			$_SESSION['themenu'] = "newmenus_manage.php";
			include("dchronicle1.php");
			
		}
		else 
		{
			echo '<script type="text/javascript">
			alert("incorrect login details");
			location.replace("logins.php");
			</script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
        }
        ?>
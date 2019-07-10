<?php
		
		$_SESSION['username'] = $uname;
		$_SESSION['password'] = $pwrd;
		$_SESSION['deptcode'] = $prog;
		$_SESSION['stid'] = $id;



		if (password_verify($password, $pwrd)) 
		{
		
			include("dchronicle1.php");
			
		}
		else 
		{
			echo '<script type="text/javascript">
			alert("incorrect login details'.$uname.$pwrd.'");
			location.replace("logins.php");
			</script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
        }
        ?>
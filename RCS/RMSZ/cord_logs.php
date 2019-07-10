<?php
// Coordinator user 
		
		
		
		$_SESSION['username'] = $uname;
		$_SESSION['password'] = $pwrd;
		$_SESSION['deptcode'] = $prog;
		$_SESSION['stid'] = $id;


		if (password_verify($password, $pwrd)) 
		{
			$page_dir = "coord.php";
            include("dchronicle.php");		
        }
        else 
        {
            echo '<script type="text/javascript">
            alert("incorrect login detailskkk'.$uname.$pwrd.'");
            location.replace("logins.php");
            </script>';
            
            //header("Location: ". $MM_redirectLoginFailed );
        }
        ?>
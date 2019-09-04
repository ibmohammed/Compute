<?php
// Coordinator user 
	
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
            $_SESSION['users_types'] = 0;
            $_SESSION['page_name']= "NSPZ RMS-Coordinator";
            $_SESSION['themenu'] = "newmenus.php";
            $page_dir = "index.php";
            //$page_dir = "coord.php";
            include("dchronicle.php");		
        }
        else 
        {
            echo '<script type="text/javascript">
            alert("incorrect login detail");
            location.replace("logins.php");
            </script>';
            
            //header("Location: ". $MM_redirectLoginFailed );
        }
        ?>
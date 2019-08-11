
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="RMSZ/images/nipoly2%20(1).GIF" type="image/x-jpg"/>
<title>Student Login</title>
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css' />

	<link rel="stylesheet" href="css/animate.css" />
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>

<body>

<?php 
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require_once('Connections/logs.php'); 
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

?>
<?php 

if(isset($_POST['Submit'])){
$loginUsername = $_POST['username'] ;
$password = $_POST['pasword'];
$MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "studentlogin.php";
  $MM_redirecttoReferrer = true;
  



$sql = "SELECT names, matno, dept FROM  `studentsnm` WHERE names LIKE '%$loginUsername%' AND matno LIKE '%$password%' ";
$result = mysqli_query($conn, $sql);
$loginFoundUser = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
  $_SESSION['names'] = $row["names"];
 $_SESSION['matno'] =   $row["matno"];
 $_SESSION['deptcode'] =  $row["dept"];
  
    if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
  
    
    $_SESSION['MM_Usernames'] = $loginUsername;
    $_SESSION['MM_UserGroups'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    
    echo '<script type="text/javascript">
				location.replace("index.php");
			  </script>';
   // exit(header("Location: " . $MM_redirectLoginSuccess ));
  // echo "Yes";
  }
  else {
  echo '<script type="text/javascript">
				alert("Incorrect Login Details");
			  </script>';
  
  //  header("Location: ". $MM_redirectLoginFailed );
  }


}
?>

	<div class="container">
		<div class="top">
			<h2 id="title" class="hidden">Student Login Area</h2>
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
<form id="form1" name="form1" method="POST" action="">
	Username
			<br/>
			<!--<input type="text" name="username" id="username" />-->
			<input name="username" type="text"id="username"  value="" placeholder = "Any of your names."/>
			<br/>
			<label for="password">Password</label>
			<br/>
			<input name="pasword" type="password"id="password" value="" placeholder = "Matric No."  />
			<!--<input type="password" id="password" name="password" />-->
			<br/>
			<input type="submit" value="Sign In" name="Submit" />
			<br/>
					</form>
		</div>
	</div>

</body>

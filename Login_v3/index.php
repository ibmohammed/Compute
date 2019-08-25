<?php

if (!isset($_SESSION)) 
{
  session_start();
}

require_once('../connections/connection.php');
require_once('../functions/queries.php');


//C:\wamp64\www\compute\functions
if(isset($_POST['submit']))
{  
  $qq = current_session($logs);
  $qs = mysqli_fetch_assoc($qq);
  $_SESSION['sem'] = $qs["semester"];
  $_SESSION['sess'] = $qs["session"];


  $loginUsername = $_POST['username'];
  $loginUsername =  preg_replace("/[^a-zA-Z0-9\s\/]/", "", $loginUsername);

  $password = $_POST['password'];
  $password =  preg_replace("/[^a-zA-Z0-9\s]/", "", $password);



  $return_result = students_login($loginUsername, $password, $logs);
  mysqli_stmt_execute($return_result);
  mysqli_stmt_bind_result($return_result, $id, $matric_no, $pwrd, $status);
  mysqli_stmt_store_result($return_result);
   /* fetch value */
   $row =  mysqli_stmt_fetch($return_result);
  //$loginFoundUser = mysqli_stmt_num_rows($return_result);

  //$row = mysqli_fetch_array($return_result);

  // $_SESSION['stid'] = $row['id'];
  $_SESSION['stid'] = $id;
  $_SESSION['myaidi'] =  $id;

  $studentdata = login_comfirm($loginUsername, $password,$logs);
  mysqli_stmt_execute($studentdata);
  mysqli_stmt_bind_result($studentdata, $sn, $names, $matno, $prog_id, $year, $session, $status);
  mysqli_stmt_store_result($studentdata);
  mysqli_stmt_fetch($studentdata);

  $_SESSION['utyp'] =  "Student";

  //if($loginFoundUser !== 0)
  if(password_verify($password, $pwrd)) 
  //if(mysqli_num_rows($return_result)!== 0)
  {

    if($password == "Eeasy0123")
    {
      $return_comfirm = login_comfirm($loginUsername, $password,$logs);
      mysqli_stmt_execute($return_comfirm);
      mysqli_stmt_bind_result($return_comfirm, $sn, $names, $matno, $prog_id, $year, $session, $status);
      mysqli_stmt_store_result($return_comfirm);
      mysqli_stmt_fetch($return_comfirm);

      echo $loginUsername;
      echo $names;
      // $comfirm = mysqli_fetch_assoc($return_comfirm);
      //echo ;
      //      javascript function to comfirm new user entry
      echo '<p>Click the button to Comfirm that ('.$names.') is your name</p>';

      echo '<button onclick="myFunction()">Comfirm</button>
      <p id="demo"></p>
      <script>
      var fname ;
      var othername;
      function myFunction() {
      var txt;
      var fname = "'.$names.'";


      var r = confirm("is this your name? \n " + fname + "\nclick OK for Yes and Cancel for No");
      if (r == true) {
      txt = "";
      window.location.href = "../stdprofile2.php?Ok";
      } else {
      txt = "";
      alert("The Matric Number you entered is incorrect, \nPlease Check for the correct matric number and try again");
      window.location.href = "index.php";


      }
      document.getElementById("demo").innerHTML = txt;
      }
      </script>';
      //$loginUsername, $password
      $_SESSION['comfirmuser'] = $loginUsername;
      exit();
    }
    else
    {

      $_SESSION['usercomfirmed'] = $loginUsername;
      //keep user logs
      $table_id = $id;
      $tablename = "students_log";
      $action = "Login";
      $whoid = $sn;
      $whoname = $matric_no;
      
      $ddate = date("Y-m-d");
      $dtime = date("h:i:sa");
       chronicles($logs, $table_id, $tablename, $action, $whoid, $whoname);

     if (mysqli_insert_id($logs)){
        header("location:../stdprofile.php");

      }else{
        die ("weldone");
      }
           

     
    }
  }
  else
  {
    // code...
    header("location:index.php?Invalid=Inorrect Username and Password");
  }

// code..
}

include("logintop.php");
?>


<div class="limiter">
	<div class="container-login100" style="background-image: url('images/bg-001.jpg');">
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
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>

				<div class="container-login100-form-btn m-t-32">
					<button class="login100-form-btn" name="submit">
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

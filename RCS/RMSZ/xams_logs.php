<?php


	//system manager  login 
	
		$_SESSION['staffcomfirmed'] = $uname;
		$_SESSION['password'] = $pwrd;
		$_SESSION['deptcode'] = $prog;
		$_SESSION['stid'] = $id;
		
		
		//if ($loginFoundUser) 
		if (password_verify($password, $pwrd)) 
		{
		
				// start comfirmation //////////////////////
		
				if($_POST['pasword'] == "Simply012345@")
				{
			
		        $return_comfirm = login_scomfirm($loginUsername, $password, $logs);
				//$comfirm = mysqli_fetch_assoc($return_comfirm);
				mysqli_stmt_execute($return_comfirm);
       			mysqli_stmt_bind_result($return_comfirm, $id, $names, $number, $contact, $dept_id);
       			mysqli_stmt_store_result($return_comfirm);
                mysqli_stmt_fetch($return_comfirm);

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
		            window.location.href = "s_profile2.php?Ok";
		          } else {
		            txt = "";
		            alert("The Matric Number you entered is incorrect, \nPlease Check for the correct matric number and try again");
		            window.location.href = "index.php";
		
		
		          }
		          document.getElementById("demo").innerHTML = txt;
		        }
		        </script>';
			//	$_SESSION['comfirmstaff'] = $loginUsername;
				$_SESSION['comfirmstaff'] = $number;
		          //$_SESSION['comfirmstaff'] = $_POST['username'];
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
				location.replace("exams_records.php");
				</script>';
				// exit(header("Location: " . $MM_redirectLoginSuccess ));
				// echo "Yes";
			
	      }
		
		}
		else 
		{
			echo '<script type="text/javascript">
			alert("incorrect login detailsppp");
			location.replace("logins.php");
			</script>';
			
			//header("Location: ". $MM_redirectLoginFailed );
		}


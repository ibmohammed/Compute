<?php 
// start comfirmation //////////////////////
		
			if($_POST['pasword'] == 'Simply012345@')
		    {
                mysqli_stmt_bind_param($stmt, "ss", $loginUsername, $password);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id, $uname, $pwrd, $prog, $t_user);
                mysqli_stmt_store_result($stmt);
                $loginFoundUser = mysqli_stmt_num_rows($stmt);
                /* fetch value */
                $row =  mysqli_stmt_fetch($stmt);
				//echo ;
				//  javascript function to comfirm new user entry
		        echo '<p>Click the button to Comfirm that ('.$uname.') is your name</p>';
		      	echo '<button onclick="myFunction()">Comfirm</button>
		        <p id="demo"></p>
		        <script>
		        var fname ;
		        var othername;
		        function myFunction() {
		          var txt;
		          var fname = "'.$uname.'";
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
				//$_SESSION['comfirmstaff'] = $loginUsername;
				$_SESSION['comfirmstaff'] = $number;
		          //$_SESSION['comfirmstaff'] = $_POST['username'];
		          exit();
	        }
	        else
            {
				
				$stff = login_scomfirm($number, $logs);
				//mysqli_stmt_bind_param($stff, "s", $uname);
				mysqli_stmt_execute($stff);
				mysqli_stmt_bind_result($stff, $stfid, $name, $number, $contact, $dept_id);
				mysqli_stmt_store_result($stff);
				mysqli_stmt_fetch($stff);

				$table_id = $id;
				$tablename = "logintbl";
				$action = "Login";
				$whoid = $stfid;
				$whoname = $number;
				$ddate = date("Y-m-d");
				$dtime = date("h:i:sa");

			 	chronicles($logs, $table_id, $tablename, $action, $whoid, $whoname);
			 
				if (mysqli_insert_id($logs)){
					$loginStrGroup = "";
				//declare two session variables and assign them
				$_SESSION['MM_Usernames'] = $loginUsername;
				$_SESSION['MM_UserGroups'] = $loginStrGroup;	      

				if (isset($_SESSION['PrevUrl']) && true) 
				{
				$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
				}

				echo '<script type="text/javascript">
					
					location.replace("'.$page_dir.'");
				</script>';

				}else{
					die ("No log entered");
				}

	  		}?>
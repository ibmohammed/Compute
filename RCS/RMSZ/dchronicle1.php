<?php 
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
				location.replace("smanage.php");
				</script>';
				}else{
					die ("No log enetered");
                }
                ?>
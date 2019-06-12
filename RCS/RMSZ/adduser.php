<?php
if (!isset($_SESSION))
{
	session_start();
}?>

<?php 
include("includes/header.php"); 
include("logintop.php");
?>

<?php
//staff registration 
if(isset($_POST['Submit2']))
{

	$dptdcode = $_POST['dptdcode'];
	$names = $_POST['staffname'];
	$contact = $_POST['contact'];
	$number = $_POST['staffnumber'];
	
	$logintbl="INSERT INTO staff (names, number, contact, dept_id)
	VALUES ('$names','$number','$contact','$dptdcode')";
	
	
	if (mysqli_query($conn, $logintbl))
	{
		//echo "User Added Successfuly";
		//$uname = 
		
		$qry="INSERT INTO logintbl (username, password, progs, t_user, status)
		VALUES ('$number', '0000', '$dptdcode', '1', '2')";
		
		if (mysqli_query($conn, $qry))
		{
		//echo "User Added Successfuly";
		header("location:adduser.php?Success=Staff Added Successfuly");
		// header("location:index.php?Invalid=Inorrect Username and Password");
		}
		else
		{
			echo"request failed .";
			echo mysqli_error($conn);
		}
		
	}
	else
	{
		echo"request failed .";
		echo mysqli_error($conn);
	}
	
	//end staff registration 

}

// Coordinator registraion 

elseif(isset($_POST['Submit']))
{

	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	$dptdcode = $_POST['dptdcode'];
	
	?>
	
	<?php
	if($uname!=="Coordinator")
	{
		//staff registration 
		$dptdcode
		
		//echo 
		?>
		<div class="limiter">
	<div class="container-login100" style="background-image: url('../../Login_v3/images/bg-001.jpg');">
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41">
				New Staff
			</span>


<form class="login100-form validate-form p-b-33 p-t-5" name="form2" action="" method="post">

	<input type="hidden" name="dptdcode" value="<?php echo $dptdcode;?>" />
			
	<div class="wrap-input100 validate-input" data-validate = "Enter staffname">
			<input class="input100" type="text" type="text" name="staffname" placeholder="Staff name"/>
			<span class="focus-input100" data-placeholder="&#xe82a;"></span>
	</div>
				
	<div class="wrap-input100 validate-input" data-validate = "Enter staffnumber">					
		<input class="input100" type="text" type="text" name="staffnumber" placeholder="Staff number"/>
		<span class="focus-input100" data-placeholder="&#xe82a;"></span>
	</div>
				
	<div class="wrap-input100 validate-input" data-validate = "Enter contact">						
		<input class="input100" type="text" type="text" name="contact" placeholder="Staff contact"/>
		<span class="focus-input100" data-placeholder="&#xe82a;"></span>
	</div>
			
	<div class="container-login100-form-btn m-t-32">
		<button class="login100-form-btn" name="Submit2">
		Add new staff
		</button>
	</div>
	<?php
				if(@$_GET['Success']==True)
				{
					echo "<script>
					alert('New staff added!!')
					</script>
					";
					?>
					<div style="color:#f4021a; font-style:italic; text-align:center; font-family:courier">
						<?php echo $_GET['Success'];?>
					</div>
					<?php
				}
				?>

</form>
		<?php 
	exit();
	}
	else
	{
	
		$logintbl="INSERT INTO logintbl (username, password,progs)
		VALUES ('$uname','$pwd','$dptdcode')";
		
		
		if (mysqli_query($conn,$logintbl))
		{
			//echo "User Added Successfuly";
			header("location:adduser.php?Success=User Added Successfuly");
		}
		else
		{
			echo"request failed .";
			echo mysqli_error();
		}
	
	}
}
?>
<div class="limiter">
	<div class="container-login100" style="background-image: url('../../Login_v3/images/bg-001.jpg');">
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41">
				New User
			</span>


<form class="login100-form validate-form p-b-33 p-t-5" name="form1" action="" method="post">

	<div class="wrap-input100 validate-input" data-validate = "Select username">

		<select class="input100" name="username">
			<option selected="selected"> Select User </option>
			<option>Coordinator</option>
			<option>Other User</option>
		</select>
		<span class="focus-input100" data-placeholder="&#xe82a;"></span>
	</div>
				
	<div class="wrap-input100 validate-input" data-validate = "Enter password">
		<input class="input100" type="password" name="password" placeholder="Password"/>
		<span class="focus-input100" data-placeholder="&#xe80f;"></span>
	</div>
	
	<div class="wrap-input100 validate-input" data-validate = "<?php echo @$_SESSION['deptcode'];?>">
		<input class="input100" name="dptdcode" type="text" value="<?php echo @$_SESSION['deptcode'];?>">
		<span class="focus-input100" data-placeholder="&#xe82;"></span>
	</div>

	<div class="container-login100-form-btn m-t-32">
		<button class="login100-form-btn" name="Submit">
			Add new user
		</button>

	</div>
	<?php
				if(@$_GET['Success']==True)
				{
					echo "<script>
					alert('New user added!!')
					</script>
					";
					?>
					<div style="color:#f4021a; font-style:italic; text-align:center; font-family:courier">
						<?php echo $_GET['Success'];?>
					</div>
					<?php
				}
				?>

</form>
<?php
include("loginbotom.php");
?>

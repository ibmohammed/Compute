<?php
if (!isset($_SESSION))
{
	session_start();
}?>

<?php 
//include("includes/header.php"); 
//include("logintop.php");
?>
	<?php 

$dcode =  dept_function($logs);             


//staff registration 
if(isset($_POST['Submit2']))
{

	
function staff_reg($names,$number,$contact,$ccdes){
	
	$logintbl="INSERT INTO staff (names, number, contact, dept_id)
	VALUES ('$names','$number','$contact','$ccdes')";
	return $logintbl;
	
}
	
$names = $_POST['staffname'];
$contact = $_POST['contact'];
$number = $_POST['staffnumber'];
$t_user = $_POST['t_user'];


	if($t_user!==1){

		$dptdcode = 0;	
		$logintbl = 	staff_reg($names,$number,$contact,$dptdcode);
	}else{
		$dptdcode = $_POST['dptdcode'];
		$ccodes = mysqli_query($logs, "SELECT dept_id, name, schl_id FROM `departments` WHERE code= '".$dptdcode."' ") or die(mysqli_error($logs));
		$ccdes = mysqli_fetch_assoc($ccodes);
		$logintbl = 	staff_reg($names,$number,$contact,$ccdes['dept_id']);
		
	}
	
	
	if (mysqli_query($logs, $logintbl))
	{
		//echo "User Added Successfuly";
		//$uname = 
		
		$qry="INSERT INTO logintbl (username, password, progs, t_user, status)
		VALUES ('$number', '0000', '$dptdcode', '$t_user', '$t_user')";
		
		if (mysqli_query($logs, $qry))
		{
		//echo "User Added Successfuly";

		echo '<script type="text/javascript">
		location.replace("index.php?Success=Staff Added Successfuly");
		</script>';


		//header("location:index.php?Success=Staff Added Successfuly");
		// header("location:index.php?Invalid=Inorrect Username and Password");
		}
		else
		{
			echo"request failed .";
			echo mysqli_error($logs);
		}
		
	}
	else
	{
		echo"request failed .";
		echo mysqli_error($logs);
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
		
			<h3>
				Other Users Registration form
			</h3>


<form  name="form2" action="" method="post">

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
	<table class="table table-bordered">
	
	<tr>
	<td>

	<input type="hidden" name="dptdcode" value="<?php echo $dptdcode;?>" />
	<input class="form-control" type="text" name="staffname" placeholder="Staff name"/>
	</td>
</tr>

<tr>
<td>	
		<input class="form-control" name="staffnumber" placeholder="Staff number"/>
		</td>
</tr>

<tr>
<td>
		<input class="form-control" name="contact" placeholder="Staff contact"/>

</td>
</tr>


<tr>
<td>
		<select  name="t_user" class="form-control">
			<option selected="selected" value=""> Select User Type</option>
			<option value="3">Exams and Records</option>
			<option value="2">System Manager</option>
			<option value="1">Teaching Staff</option>
		</select>
		</td>
</tr>
<!--
<tr>
<td>
	

	
		<select name="dptdcode" class="form-control">
		<option selected="selected" value="">Select Department</option>
		<?php //while($dcodess = mysqli_fetch_assoc($dcode)){?>
		<option value="<?php //echo $dcodess['code'];?>"><?php //echo $dcodess['name'];?></option>
		<?php //}?></select>
		</td>
</tr>
-->
		
	</table>
		<input name="Submit2" value="Add new staff" type="Submit" class="btn btn-gradient-primary mr-2">
		

			
</form>
<hr>
		<?php 
	//exit();
	}
	else
	{
	$cordname = $_POST['cordname'];

		$logintbl="INSERT INTO logintbl (username, password,progs, t_user, status)
		VALUES ('$uname','$pwd','$dptdcode', '0', '0')";
		
		
		if (mysqli_query($logs,$logintbl))
		{


			$logintbl = 	staff_reg($names,$number,$contact,$dptdcode);
			
			//echo "User Added Successfuly";
			//header("location:adduser.php?Success=User Added Successfuly");
			echo '<script type="text/javascript">
                location.replace("index.php?Success=User Added Successfuly");
                </script>';
		}
		else
		{
			echo"request failed .";
			echo mysqli_error($logs);
		}
	
	}
}
?>

<h3>New Coordinator Registration Form</h3>
<form name="form1" action="" method="post">
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
<table class="table table-bordered">

<tr>
<td>
		<select  name="username" class="form-control">
			<option selected="selected" value=""> Select User Type</option>
			<option>Coordinator</option>
			<option>Other User</option>
		</select>
		</td>
</tr>

<tr>
<td>
		<input type="text" name="cordname" placeholder="Enter Cordinator's name" class="form-control"/>
		</td>
</tr>

<tr>
<td>
		<input type="password" name="password" placeholder="Password" class="form-control"/>
		</td>
</tr>

<tr>
<td>
	

	<?php 

	 $dcode =  dept_function($logs);             
	

	 ?>
			
		<select name="dptdcode" class="form-control">
		<option selected="selected" value="">Select Department</option>
		<?php while($dcodess = mysqli_fetch_assoc($dcode)){?>
		<option value="<?php echo $dcodess['code'];?>"><?php echo $dcodess['name'];?></option>
		<?php }?></select>
		</td>
</tr>

		
	
</table>	
<br><p>
<input name="Submit" class="btn btn-gradient-primary mr-2" value="Add Coordinator" Type="Submit">
</p>		
</form>
<p><hr></p>
<?php
//include("loginbotom.php");
?>

<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php //require('includes/header.php');    ?>

	<?php 
	if(isset($_POST['Submit'])){
	$programme = $_POST['prog'];
  $dpt = $_POST['dpt'];
  //$deptcode = $_POST['deptcode'];
	
	$sql = mysqli_query($logs,"INSERT INTO `programmes` (`programme`, `dept_id`)
		VALUES('$programme','$dpt')") or die(mysqli_error());
	
	
	echo "<script language = 'javascript'>alert('Programme Added')</script>";
	
	}
	$schqry = mysqli_query($logs, "SELECT dept_id, name FROM `departments`") or die(mysqli_error($logs));
	?>
	
	<form id="form1" name="form1" method="post" action="">
	&nbsp;
  <table class="table table-bordered" >
        <tr>
          <td><strong>Department:</strong></td>
          <td>
          <select name="dpt" class="form-control">
					<option selected = "selected" value="">Select Department</option>
					<?php 
					while($rows = mysqli_fetch_assoc($schqry))
					{?>
						<option value="<?php echo $rows['dept_id'];?>"><?php echo $rows['name'];?></option>
						<?php 
					}?>
				</select>
          </td>
        </tr>
        <tr>
          <td><strong>Programme:</strong></td>
          <td>
          <input name="prog" type="text" id="prog" class="form-control"/>
          </td>
        </tr>
        
      </table>
      <br>
        <p>
            <input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2"/>
         </p>
      </form> 
      <br>  
<hr>
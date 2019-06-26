<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require('includes/header.php');    ?>

	<?php 
	if(isset($_POST['Submit'])){
	$programme = $_POST['prog'];
  $schl = $_POST['schl'];
  $schlcode = $_POST['deptcode'];
	
	$sql = mysqli_query($conn,"INSERT INTO `departments` (`name`, `code`, `schl_id`)
		VALUES('$programme','$schlcode','$schl')") or die(mysqli_error());
	
	
	echo "<script language = 'javascript'>alert('Programme Added')</script>";
	
	}
	$schqry = mysqli_query($logs, "SELECT schl_id, school FROM `schools`") or die(mysqli_error($logs));
	?>
	
	<form id="form1" name="form1" method="post" action="">
	&nbsp;
  <table class="table table-bordered" >
        <tr>
          <td><strong>School:</strong></td>
          <td>
          <select name="schl" class="form-control">
					<option selected = "selected" value="">Select School</option>
          <option value="0">None</option>
					<?php 
					while($rows = mysqli_fetch_assoc($schqry))
					{?>
						<option value="<?php echo $rows['schl_id'];?>"><?php echo $rows['school'];?></option>
						<?php 
					}?>
				</select>
          </td>
        </tr>
        <tr>
          <td><strong>Department:</strong></td>
          <td>
          <input name="prog" type="text" id="prog" class="form-control"/>
          </td>
        </tr>
        <tr>
          <td><strong>Department Code:</strong></td>
          <td><label>
          <input name="deptcode" type="text" id="prev" class="form-control"/>
          </label></td>
        </tr>
      </table>
      <br>
        <p>
            <input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2"/>
         </p>
      </form> 
      <br>  
<hr>
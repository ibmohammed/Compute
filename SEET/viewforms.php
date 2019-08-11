
<form action="" method="post" name="grade" id="grade">
    
      <table class="table table-bordered">
        <tr>
          <td>PROGRAMME:</td>
          <td>
            <select name="programme" id="programme" class="form-control">
            <option selected="selected" value="">Select Programme</option>
              <?php include('dptcode.php');

            if($forms_choose == 1){
                $queri = 	mysqli_query($conn,"SELECT * FROM `programmes`") or die(mysqli_error($conn));
                //  $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
            }elseif($forms_choose == 0){
                $sq = mysqli_query($conn,"SELECT * FROM `departments` WHERE code = '$departmentcode'") or die(mysqli_error($conn));
                $did = mysqli_fetch_assoc($sq);
                $queri = mysqli_query($conn,"SELECT * FROM `programmes` WHERE dept_id LIKE '".$did['dept_id']."'") or die(mysqli_error($conn));
            }

              //	$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error($conn));
              while($pcd = mysqli_fetch_assoc($queri)){
              ?>
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
              <?php }?>
            </select>         
          </td>
        </tr>
        <tr>
          <td >SESSION:</td>
          <td >
            <select name="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
              <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
              <?php echo include('includes/sessions.php');?>
            </select>
          -
          <select name="year" id="year" class="form-control">
            <option selected="selected" value="">Select Year</option>
            <?php 
            for($i = 10; $i<=22; $i++)
            {
              echo "<option>".$i."</option>";
            }?>
	        
          </select>
          </td>
        </tr>
        <tr>
          <td>SEMESTER:</td>
          <td>
            <select name="semester" class="form-control">
            <option selected="selected" value="">Select Semester</option>
              <option value="1">First Semester</option>
              <option value="2">Second Semester</option>
              <option value="3">Third Semester</option>
              <option value="4">Fourth Semester</option>
              <option value="5">Fift Semester</option>
              <option value="6">Sixth Semester</option>
            </select>
          </td>
        </tr>
      </table>
      <br>
      <p></p>
      <p><input name="Submit" value="Submit" type="submit" class="btn btn-gradient-primary mr-2"/></p>
      <br />
    </form>


<em style="color:green">Select programme and year to view student records</em>
<hr>
  <form id="form2" name="form2" method="post" action="" target="_new">
    <table class="table table-bordered" >
      <tr>
        <td ><strong>PROGRAMME:</strong></td>
        <td>
          <select name="dept" id="dept" class="form-control">
          <option selected="selected" value="">Select Programme</option>
            <?php include('dptcode.php');
          $queri = prog_function($logs);
          while($pcd = mysqli_fetch_assoc($queri)){
             ?>
              <option value="<?php echo $pcd['prog_id'];?>">
              <?php echo $pcd['programme'];?></option>
              <?php 
            }?>
          </select>
        </td>
      </tr>
      <tr>
        <td ><strong>YEAR:</strong></td>
        <td >
        <select name="year" id="year" class="form-control">
          <option selected="selected">Year</option>
          <?php 
            for($i = 10; $i<=22; $i++)
            {
              echo "<option>".$i."</option>";
            }?>
        </select>
      </td>
    </tr>
</table>
<br>
<input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2"/>
</form>
   <hr>                       
 <br>
 <hr>
 <br>
<br/>
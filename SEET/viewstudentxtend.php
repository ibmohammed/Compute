
<i style="color:green">Select programe and year to view student records</i>
  <form id="form2" name="form2" method="post" action="">
    <table class="table table-bordered" >
      <tr>
        <td ><strong>PROGRAMME:</strong></td>
        <td>
          <select name="dept" id="dept" class="form-control">
          <option selected="selected" value="">Select Programme</option>
            <?php include('dptcode.php') ;
          
           $prgqry = prog_function($logs);
           while($pcd = mysqli_fetch_assoc($prgqry)){?>
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
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

	
	<?php 
	

	if (isset($_POST['Submit'])){
  //echo '<h3>'..'</h3>';
  $the_prog = programmes($_POST['dept'], $logs);
    $prog_name = mysqli_fetch_assoc($the_prog);

	?>
  <i style="color:green;">Class of <?php echo  $_POST['year']." students records for: ".$prog_name['programme'];?></i>



	<table class="table table-bordered" >
      <tr>
        <td>
       <!-- <input type="text" name="search" id="search" class="form-control" />-->
       <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Matric Number.." class="form-control">
          <table class="table table-bordered" id="myTable">
              <tr>
              <th><span style ="color:black;">Id</span></th>
              <th onclick="sortTable(0)"><span style ="color:black;">Name</span></th>
              <th onclick="sortTable(1)"><span style ="color:black;">MatricNo</span></th>
              <th><span style ="color:black;">Session</span></th>
              <th><span style ="color:black;">Year</span></th>
              <th><span style ="color:black;">STATUS</span></th>
        	  </tr>
			<?php
			$dept = $_POST['dept'];
			$year=$_POST['year'];
          //  $session=$_POST['session'];
            
            $sql = mysqli_prepare(
                                    $logs, "SELECT * FROM `studentsnm` 
                                            WHERE 
                                            prog_id = ? && 
                                            year =?  
                                            ORDER BY 
                                            `matno` 
                                            ASC"
                                )
                                        or die(mysqli_error($logs));
            mysqli_stmt_bind_param($sql, "ss", $dept, $year);
            mysqli_stmt_execute($sql);
            $result = mysqli_stmt_get_result($sql);

            $n=0;
			 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
       $n=$n+1;
       
				$status=$row['Withdrwan']; 
			  if($status==0){
           $active = "Active";
           $rowcolor = "#000000";
			  }elseif($status==1){
          $rowcolor = "#FF0000";
            $active = "In_Active";
				  }
			 ?>
            <tr style="color:<?php echo @$rowcolor;?>">
              <td ><span class="style1"><?php echo $n;?></span></td>
              <td ><span class="style1"><?php echo $row['names'];?></span></td>
              <td ><span class="style1"><?php echo $row['matno'];?></span></td>
              <td ><span class="style1"><?php echo $row['session'];?></span></td>
              <td  style="width: 32px"><span class="style1"><?php echo $row['year'];?></span></td>
              <td ><span class="style1">
                <?php echo $active;?>
              </span></td>
            </tr><?php  }?>
          </table>
            
        </td>
      </tr>
    </table><?php //exit;
   }?>
  
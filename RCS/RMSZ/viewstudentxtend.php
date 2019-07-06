
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
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
        </select>

      </td>

    </tr>
<!--
    <tr>
      <td ><strong>SESSION:</strong></td>
      <td>
      <select name="session" id="session" class="form-control">
        <option selected="selected">Session</option>
        <option>2010/2011</option>
        <option>2012/2013</option>
        <option>2013/2014</option>
        <option>2014/2015</option>
        <option>2015/2016</option>
        <option>2016/2017</option>                  
        <option>2017/2018</option>
      </select>
    </td>
  </tr>
  -->
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
	?>
  <i style="color:green;">Class of <?php echo  $_POST['year']." students records for: ".$_POST['dept'];?></i>
	<table class="table table-bordered" >
      <tr>
        <td>
          <table class="table table-bordered" >
              <tr>
              <td><span style ="color:black;">Id</span></td>
              <td><span style ="color:black;">Name</span></td>
              <td><span style ="color:black;">MatricNo</span></td>
              <td><span style ="color:black;">Session</span></td>
              <td><span style ="color:black;">Year</span></td>
              <td><span style ="color:black;">STATUS</span></td>
        	  </tr>
			<?php
			$dept = $_POST['dept'];
			$year=$_POST['year'];
          //  $session=$_POST['session'];
            
            $sql = mysqli_prepare(
                                    $conn, "SELECT * FROM `studentsnm` 
                                            WHERE 
                                            prog_id = ? && 
                                            year =?  
                                            ORDER BY 
                                            `matno` 
                                            ASC"
                                )
                                        or die(mysqli_error($conn));
            mysqli_stmt_bind_param($sql, "ss", $dept, $year);
            mysqli_stmt_execute($sql);
            $result = mysqli_stmt_get_result($sql);

            $n=0;
			 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			 $n=$n+1;
			 ?>
            <tr>
              <td ><span class="style1"><?php echo $n;?></span></td>
              <td ><span class="style1"><?php echo $row['names'];?></span></td>
              <td ><span class="style1"><?php echo $row['matno'];?></span></td>
              <td ><span class="style1"><?php echo $row['session'];?></span></td>
              <td  style="width: 32px"><span class="style1"><?php echo $row['year'];?></span></td>
              <td ><span class="style1">
                <?php
				$status=$row['Withdrwan']; 
			  if($status==0){
				  echo "Active";
			  }elseif($status==1){
					  echo "<font color='#FF0000'>In_Active</font>";
				  }?>
              </span></td>
            </tr><?php  }?>
          </table>
            
        </td>
      </tr>
    </table><?php //exit;
   }?>
      
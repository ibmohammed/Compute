
	<?php 
	if (isset($_POST['Submit'])){
	//echo '<h3>'..'</h3>';
	?>
  <i style="color:green;">Class of <?php echo  $_POST['year']." students records for: ".$_POST['dept'];?></i>



	<table class="table table-bordered" >
      <tr>
        <td>
       <!-- <input type="text" name="search" id="search" class="form-control" />-->
       <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Matric Number.." class="form-control">
          <table class="table table-bordered" id="myTable">
              <tr>
              <th onclick="sortTable(1)"><span style ="color:black;">MatricNo</span></th>
              
        	  </tr>
			<?php
			$dept = $_POST['dept'];
			$year=$_POST['year'];
          //  $session=$_POST['session'];
            
            $result =  edit_students($logs, $dept, $year);

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
             
              <td ><span class="style1"><?php echo $row['matno'];?></span></td>
              
            </tr><?php  }?>
          </table>
            
        </td>
      </tr>
    </table><?php exit;
   }?>
  
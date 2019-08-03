

<?php
    if(isset($_POST['Submit']))
    
    {

            
            function staff_reg($names,$number,$contact,$ccdes){
            
                $logintbl="INSERT INTO staff (names, number, contact, dept_id)
                VALUES ('$names','$number','$contact','$ccdes')";
                return $logintbl;
                
            }

        function insert_logintbl($username, $password, $dptdcode, $t_user, $status){
            $qry="INSERT INTO logintbl (username, password, progs, t_user, status)
            VALUES ('$username', '$password', '$dptdcode', '$t_user', '$status')";
            return $qry;
        }  

                
    

               




            $names = $_POST['staffname'];
            $staffnumber = $_POST['staffnumber'];
            $contact = $_POST['contact'];
           // $ccdes = $_POST[''];
            $username = $_POST['username'];
           // $dptdcode;
            $t_user = $_POST['t_user']; 
            $dptid = $_POST['dptid'];

        $ccodes = mysqli_query($logs, "SELECT dept_id, name, code, schl_id FROM `departments` WHERE dept_id= '".$dptid."' ") or die(mysqli_error($logs));
		$ccdes = mysqli_fetch_assoc($ccodes);
            
            if ($t_user !== "2"){
                $password = "Simply012345@"; 
            
            }else{
                $password = $_POST['password'];


            }

            $passwordlength= strlen($password);
        
            if ($passwordlength < 6){
                $output2= "<br><redtext> Invalid password. Password must be at least 6 characters</redtext>";
            }
            if ($passwordlength > 15)
            {
                $output2= "<br><redtext> Invalid password. Password cannot be greater than 15 characters</redtext>";
            }
            preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $password, $matches);
            if(empty($matches[0])!==true)
            {
               $output3= "<br><redtext> Invalid password. Password must contain numbers and letters with atleast one upper case or lowercase character and symbol</redtext>".
               
               var_dump(empty($matches[0]));
            }else{


                $options = [
                    'cost' => 11,
                ];
                

                $hash = password_hash($password, PASSWORD_BCRYPT,  $options);


                $qry = staff_reg($names,$staffnumber,$contact, $dptid);
                $logintbl = insert_logintbl($username, $hash, $ccdes['code'], $t_user, $staffnumber);

                if (mysqli_query($logs, $logintbl) && mysqli_query($logs, $qry))
                {
                    /*echo '<script type="text/javascript">
                location.replace("index.php?Success=User Added Successfuly");
                </script>';*/


                echo '<script type="text/javascript">
                alert("index.php?Success=User Added Successfuly'.$hash.'");
                </script>';
                }
                else
                {
                    echo"request failed .";
                    echo mysqli_error($logs);
                }

                
        
         }

         echo @$output2. " <br> ". @$output3;

    }
    if(@$_GET['Success'])
    {
        echo "<i style='color:purple;'>".$_GET['Success']."</i>";
    }

?>
<form name="form1" action="" method="post">
<table class="table table-bordered">

<tr>
<td><input class="form-control" type="text" name="staffname" placeholder="Staff name"/></td>
</tr>

<tr>
<td><input class="form-control" type="text" name="staffnumber" placeholder="Staff Number"/></td>
</tr>

<tr>
<td>
		<input class="form-control" name="contact" placeholder="Staff contact"/>

</td>
</tr>

<tr>
<td>
		<input type="text" name="username" placeholder="Username" class="form-control"/>
		</td>
</tr>

<tr>
<td>
		<input type="password" name="password" placeholder="Password" class="form-control"/>
		</td>
</tr>

<tr>
<td>

	<?php  $dcode =  dept_function($logs);?>	
		<select name="dptid" class="form-control">
		<option selected="selected" value="">Select Department</option>
		<?php while($dcodess = mysqli_fetch_assoc($dcode)){?>
		<option value="<?php echo $dcodess['dept_id'];?>"><?php echo $dcodess['name'];?></option>
		<?php }?></select>
		</td>
</tr>


<tr>
<td>
            <?php 
            $ut = user_type($logs); ?>
		<select  name="t_user" class="form-control">
			<option selected="selected" value=""> Select User Type</option>
		<?php while($utypes = mysqli_fetch_assoc($ut)){?>
        	<option value="<?php echo $utypes['status'];?>"><?php echo $utypes['type'];?></option>
            <?php } ?>
          <!--  <option value="3">Exams and Records</option>
			<option value="2">System Manager</option>
			<option value="1">Teaching Staff</option> -->
		</select>
		</td>
</tr>		
	
</table>	
<br><p>
<input name="Submit" class="btn btn-gradient-primary mr-2" value="Add New staff/user" Type="Submit">
</p>		
</form>
<p><hr></p>
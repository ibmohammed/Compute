<?php 
	
		?>
<br>
		<hr>
		<br>
        <i style ="color:red;">Select the course code and Choose file containing the scores to upload</i>
		<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">
						
			<table class="table table-bordered">
				<tr>
				<td>Course Code:</td>
				<td>
				<select name="ccodes" class="form-control" id="exampleSelectGender">
				<option selected="selected"><?php// echo $_POST['code'];?></option>
				<?php while($rows = mysqli_fetch_array($crss, MYSQLI_ASSOC)){?>
				<option><?php echo $rows['code'];?></option>
                <?php 
                if ($semsesprog==0)
                {
                    $_SESSION['semester']= $rows['semester'];
                    $_SESSION['sessions']= $rows['sessions'];
                    $_SESSION['prog_id'] = $rows['prog_id'];
                }else
                {
                                      
                    $_SESSION['semester'] = $_POST['semester'];
                	$_SESSION['sessions'] = $_POST['session'];
                    $_SESSION['prog_id'] = $_POST['programme'];
                }
            }?>
				</select></td>
			</tr>
			<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" class="form-control"/> </td>
			</tr>
		</table>
		<br>
		
		<input name="Submitm" type="submit" value="Submit" class="btn btn-gradient-primary mr-2"> 
		<hr>
		<br>
			
		</form>
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("includes/header.php"); ?>    
<?php  
if(isset($_POST['Submit']))
{
	$sesn = $_POST['session'];
	$sesn = preg_replace("/[^0-9\/]/", "", $sesn);
	$prgrm = $_POST['programme'];
	$prgrm = preg_replace("/[^0-9]/", "", $prgrm);
	$semst = $_POST['semester'];
	$semst = preg_replace("/[^0-9]/", "", $semst);
	//	$year=$_POST['year'];
	$fname = $_FILES['csv']['name'];
	echo 'upload file name: '. $fname. ' ';
	$chk_ext = explode(".",$fname);
	if(strtolower(end($chk_ext)) == "csv")
	{
		$filename = $_FILES['csv']['tmp_name'];
		$handle = fopen($filename, "r");
		while (($data = fgetcsv($handle,1000,",")) !== FALSE)
		{
			$code = $data[0];
			$code = preg_replace("/[^a-zA-Z0-9\s]/", "", $code);
			$title = $data[1];
			$title = preg_replace("/[^a-zA-Z0-9\s]/", "", $title);
			$unit = $data[2];
			$unit = preg_replace("/[^0-9]/", "", $unit);
			
			if (preg_match('/^\d{1}$/', $unit)) {
						

				$snm = mysqli_query($conn,"SELECT * FROM `course`
						WHERE 
						`prog_id` =	'".addslashes($prgrm)."'&&
						`unit` =    '".addslashes($unit)."'&&
						`semester` =   '".addslashes($semst)."'&&
						`code` =    '".addslashes($code)."'&&
						`sessions` =	'".addslashes($sesn)."'
						") or die(mysqli_error($conn));

						if(mysqli_num_rows($snm)==0)
						{
							$staffs_id = 0;
							$snms = mysqli_query($conn,"INSERT INTO `course` 
							(`prog_id`,`unit`,`semester`,`code`,`title`,`sessions`, `staff_id`) 
									VALUES(
									'".addslashes($prgrm)."',
									'".addslashes($unit)."',
									'".addslashes($semst)."',
									'".addslashes($code)."',
									'".addslashes($title)."',
									'".addslashes($sesn)."',
									'".addslashes($staffs_id)."'
									)
								") or die(mysqli_error($conn)); 
						}
						else
						{
							$snm = mysqli_query($conn,"UPDATE `course` SET
								`prog_id` =	'".addslashes($prgrm)."',
									`unit` = '".addslashes($unit)."',
									`semester` = '".addslashes($semst)."',
									`code` =  '".addslashes($code)."',
									`title` =  '".addslashes($title)."',
									`sessions` = '".addslashes($sesn)."'
								WHERE 
								`prog_id` =	'".addslashes($prgrm)."'&&
									`unit` =  '".addslashes($unit)."'&&
									`semester` = '".addslashes($semst)."'&&
									`code` = '".addslashes($code)."'&&
									`sessions` = '".addslashes($sesn)."'
								") or die(mysqli_error($conn));
						}			
				}
				else 
				{
					echo '<script type="text/javascript">
					alert("Please check the records you are uploading");
					location.replace("index.php?csvc");
					</script>';
				}
		}
			fclose($handle);
			echo "Successfully imported";
	}
	else
	{
		echo "Invalid file";
	}?>
	<table class="table table-bordered">
        <tr>
          <td style="height: 25px"><span style="font-weight: bold;">S/n</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Title</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Code</span></td>
          <td style="height: 25px"><span style="font-weight: bold;">Unit</span></td>
        </tr>
        <?php 
        $sql=mysqli_query($conn,"SELECT * FROM `course` 
            WHERE prog_id ='$prgrm' && 
            semester='$semst' && 
            sessions = '$sesn'") or die(mysqli_error($conn));
            $n= 0 ;
            while($row=mysqli_fetch_assoc($sql)){
            $n = $n+1;
            ?>
        <tr>
          <td><span style="font-weight: bold;"><?php echo $n;?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['title'];?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['code'];?></span></td>
          <td><span style="font-weight: bold;"><?php echo $row['unit'];?></span></td>
        </tr>
        <?php }?>
    </table>
<?php
} 
?>
<br>
<hr>
<hr>
<i style="color:green">Select Programme, Session, Semester and choose ".cv" file containing the courses to import</i>
<hr>
<hr>
<br>

<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">

    <table class="table table-bordered" >
		<tr>
          <td><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
		  <td>
		  <select name="programme" id="programme" class="form-control">
		  <option selected="selected" value="">Select Programme</option>
         			
         			 <?php include('dptcode.php');
            
            $queri = prog_function($logs);
           // $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error($conn));
            //while($prgasc = mysqli_fetch_assoc($prgqry))
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option value="<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
              
              <?php }?>
              
             
          </select> </td>
        </tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">SESSION:</span></td>
			<td>  
				<select name="session" class="form-control">
				<option selected="selected" value="">Select Session</option>
          <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                    <?php echo include('includes/sessions.php');?>
                    <option>2018/2019</option>

          </select></td>
		</tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">SEMESTER:</span></td>
			<td>  <select name="semester" class="form-control">
            <option selected="selected" value="">Select Semester</option>
			<option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
			<option value="4">Fourth Semester</option>
            <option value="5">Fift Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
		</tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">Choose your file:</span></td>
			<td>  <input name="csv" type="file" id="csv" class="btn btn-gradient-primary mr-2" /></td>
		</tr>
	</table>
<br>
	<p><input name="Submit" type="submit" value="Submit" class="btn btn-gradient-primary mr-2" > </p>
</form>
 <hr>
<?php include("includes/header.php"); ?>
    
	<?php // include('title1.php');?>
<div align="left">
 
   <div align="center">
          <?php 
//	if(isset($_POST['Submit'])){ ?>
<?php 
$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
//$start=$_POST['start'];
//$list=$_POST['list'];
		if ((!$programme)){
	die("empty fields not allowed");
	}
	
	$query= mysqli_query($conn,"SELECT * FROM course WHERE dept_id='$programme' && semester	='$semester'");
	if(!$query){
	die (mysqli_error());
	}
		// keep title here
	
//	include('title.php');
	

	?>
      

  <table border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:14px; width: 600px; border:thin; border-collapse:collapse">
      <tr>
        <td valign="top"><?php 
		$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
		$qry = mysqli_query($conn,"SELECT * FROM course WHERE dept_id='$programme' && semester	='$semester' && sessions = '$session'") or die (mysqli_error());
				?>
				
			<!--

          <table border="1"  style="font-size:12px; width: 600px; border:thin; border-collapse:collapse">
            <tr>
              <td style="height: 19px"><strong>S/N</strong></td>
              <td style="height: 19px"><strong>Title</strong></td>
              <td style="height: 19px"><strong>Code</strong></td>
              <td style="height: 19px"><strong>Unit</strong></td>
            </tr>
            <?php $j =0; 
  while($courses = mysqli_fetch_assoc($qry)){
	  $j = $j + 1;?>
            <tr>
              <td style="height: 25px"><?php echo $j;?></td>
              <td style="height: 25px"><?php echo $courses['title'];?></td>
              <td style="height: 25px"><?php echo $courses['code'];?></td>
              <td style="height: 25px"><?php echo $courses['unit'];?></td>
            </tr>
            <?php }?>
        </table>
        
        -->
        </td>
      </tr>
      <tr>
        <td valign="top" style="height: 25px"></td>
      </tr>
      <tr>
        <td valign="top" style="height: 17px"><?php 
	
	
//	$cal = ($n - $pass);
	
// include this for 6 or 3 semester programme

	if (($semester == 6) or ($semester == 3)){
	echo "No of Students with Distinction: ".$dst."<br> ";
	echo "No of Students with Uper Credit: ".$uc."<br> ";
	echo "No of Students with Lower credit: ".$lc."<br> ";
	echo "No of Students with Pass: ".$pss."<br> ";
	
	}
	// in %
  include('reanalyz.php');	 
	?></td>
      </tr>
  </table>

 <?php // exit;}?>
</div>
<!--
-->
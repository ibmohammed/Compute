<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require("includes/header.php");?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

</head>

<body>

  <form id="form2" name="form2" method="post" action="">
    <table class="table table-bordered" >
      <tr>
        <td ><strong>PROGRAMME:</strong></td>
        <td>
          <select name="dept" id="dept" class="form-control">
            <?php include('dptcode.php') ;
            $queri = mysqli_query($conn,"SELECT * FROM `programmes` WHERE prog_id = '".$_SESSION['prgid']."'") or die(mysqli_error($conn));
            while($pcd = mysqli_fetch_assoc($queri)){?>
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
</table>
<br>
<input type="submit" name="Submit" value="Submit" class="btn btn-gradient-primary mr-2"/>
</form>
                          
 <br><p><a href="index.php?regs">Register Student</a></p>
 <br>

<br/>

	<?php 

?>
	
	<?php 
	

	if (isset($_POST['Submit'])){
	echo '<h3>'.$_POST['dept'].'</h3>';
	?>
	<table class="table table-bordered" >
      <tr>
        <td>
          <table class="table table-bordered"  style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1" >
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
			$session=$_POST['session'];
			$sql=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE prog_id = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC") or die(mysqli_error($conn));
			$n=0;
			 while ($row=mysqli_fetch_assoc($sql)){
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
      
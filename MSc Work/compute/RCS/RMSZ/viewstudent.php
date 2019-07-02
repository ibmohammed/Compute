<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require("includes/header.php");?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	color: #0033FF;
}
a:hover {
	color: #0066FF;
}
.style1 {color: #000000}
.style3 {color: #FF0000}
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
.style4 {color: #000033}
.style7 {color: #FFF; font-weight: bold; }
.style8 {color: #FFF}
.auto-style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: small;
}
-->
</style>
</head>

<body>


  <div style="float:left; width:600px;">


    
    
    <form id="form2" name="form2" method="post" action="">
          <table border="0">
            <tr>
              <td style="height: 30px" ><strong>PROGRAMME:</strong></td>
              <td style="height: 30px; width: 86px">
                <select name="dept" id="dept">
                <?php include('dptcode.php') ;
            
            
            $queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error());
            
            while($pcd = mysqli_fetch_assoc($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
    			  
                </select>
              </td>
            </tr>
            <tr>
              <td ><strong>YEAR:</strong></td>
              <td style="width: 86px" >
                <select name="year" id="year">
                  <option selected="selected"></option>
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
              <td style="width: 86px" >
                <select name="session" id="session">
                  <option selected="selected"></option>
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
                    <input type="submit" name="Submit" value="Submit" />
                          </form>
                          
 <a href="index.php?regs">Register Student</a>

<br/>

	<?php 

?>
	
	<?php 
	

	if (isset($_POST['Submit'])){
	echo '<h3>'.$_POST['dept'].'</h3>';
	?>
	<table border="0">
      <tr>
        <td>
          <table border="1" style="font-size:11; width:800px; border:thin; border-collapse:collapse" cellpadding="0" cellspacing="1" >
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
			$sql=mysqli_query($conn,"SELECT *FROM `studentsnm` WHERE dept = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC");
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
    </table><?php exit; }?>
                         
         </div>

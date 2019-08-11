<?php include("includes/header.php"); ?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>
	<?php if (isset($_GET['deletes'])){
	$id = $_GET['id'];
$matno = $_GET['matno'];

	$query=mysql_query("DELETE FROM `studentsnm` WHERE sn = '$id'");
	if (!$query){
	die (mysql_error());
	}
	$query=mysql_query("DELETE FROM `results` WHERE matric_no = '$matno'");
	if (!$query){
	die (mysql_error());
	}
	
	echo "<font color = 'red'><i>"."Deleted"."</i></font>";
	}
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
              <td><span style ="color:black;">EDIT</span></td>
              <td><span style ="color:black;">DELETE</span></td>
        	  </tr>
			<?php
			
$depts = $_GET['dept'];

$depts = mysql_escape_string($depts);

$yearr = $_GET['year'];
$sessionn = $_GET['session'];

/*
			$dept = $_POST['dept'];
			$year=$_POST['year'];
			$session=$_POST['session'];
			*/
			
			$sql=mysql_query("SELECT *FROM `studentsnm` WHERE dept = '$depts' && year ='$yearr' && session='$sessionn'  ORDER BY `matno` ASC");
			$n=0;
			 while ($row=mysql_fetch_array($sql)){
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
              <td ><a href="index.php?edits= &id=<?php echo $row['sn']."&"."Edit="."edit"."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style1">EDIT</a></td>
              <td ><a href="index.php?id=<?php echo $row['sn']."&"."deletes="."del"."&"."matno=".$row['matno']."&"."dept="."$dept"."&"."year="."$year"."&"."session="."$session";?>" class="style1">DELETE</a></td>
            </tr><?php  }?>
          </table>
            
        </td>
      </tr>
    </table>
</body>

</html>

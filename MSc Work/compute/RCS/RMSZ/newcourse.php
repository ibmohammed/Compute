<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require('includes/header.php');    ?>

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
-->
</style>

</head>

<body>
	
	<?php 
	if(isset($_POST['Submit'])){
	$programme = $_POST['prog'];
	$level = $_POST['prev'];
	
	$sql = mysqli_query($conn,"INSERT INTO dept(dep, prev)
		VALUES('$programme','$level')") or die(mysqli_error());
	
	
	echo "<script language = 'javascript'>alert('Programme Added')</script>";
	
	}
	
	?>
	
	<form id="form1" name="form1" method="post" action="">
	&nbsp;<table>
        <tr>
          <td><strong>Department:</strong></td>
          <td><label>
            <input name="prog" type="text" id="prog" style="width: 273px" />
          </label></td>
        </tr>
        <tr>
          <td><strong>Position:</strong></td>
          <td><label>
            <input name="prev" type="text" id="prev" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="left"><label>
            <input type="submit" name="Submit" value="Submit" />
          </label></td>
        </tr>
      </table>
      </form>   

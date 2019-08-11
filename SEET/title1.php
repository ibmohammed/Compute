
<?PHP 
/*
$csns= mysqli_query($conn,"SELECT college, school
FROM `dept` 
WHERE dep = '$programme' ") 
or die (mysqli_error());

$fet = mysqli_fetch_assoc($csns);  
*/
?>

<table style="font-size:8pt; text-transform:uppercase" align="right">
<tr>
<td style="width: 35%"><div >
<strong>College</strong>:&nbsp;<?php echo $clg['college']; //$fet['college'];?> 

<br/>
<strong>Session</strong>:&nbsp; <?php echo $session;?>
<br/>
<strong>Semester</strong>:&nbsp;<?php echo $semester.$first." Semester ";?> 

</div>
</td>
<td style="width: 15%">&nbsp;</td>
<td style="width: 15%">&nbsp;</td>
<td style="width: 35%"><div>

<strong>ScDepartment</strong>:&nbsp; <?php echo $schlid['name'];//$fet['school'];?>
<br/>
<strong>School</strong>:&nbsp; <?php echo $clgid['school'];//$fet['school'];?>
<br/>
	<strong>Programme</strong>:&nbsp; <?php echo $dptid['programme'];//$programme;?>
		
	</div>
</td>
	</tr>
</table>
	
	<div >
	&nbsp;</div>



<div align="center" style="font-size:24pt;">NIGER STATE POLYTECHNIC, ZUNGERU</div>
<div align="center" style="font-size:14pt;">CENTRE FOR CONTINUING EDUCATION AND TRAINING</div>
<?PHP 
$csns= mysqli_query($conn,"SELECT college, school
FROM `dept` 
WHERE dep = '$programme' ") 
or die (mysql_error());

$fet = mysqli_fetch_assoc($csns);  ?>

		

<table style="width: 100%; font-size:8pt; text-transform:uppercase" align="right">
	<tr>
		<td style="width: 35%"><div >
	
		<strong>College</strong>:&nbsp;<?php echo $fet['college'];?> 
		<br/>
		<strong>Session</strong>:&nbsp; <?php echo $session;?>
		<br/>
		<strong>Semester</strong>:&nbsp;<?php echo $semester.$first." Semester ";?> 
		
	</div>
</td>
		<td style="width: 15%">&nbsp;</td>
		<td style="width: 15%">&nbsp;</td>
		<td style="width: 35%"><div>
		<strong>School</strong>:&nbsp; <?php echo $fet['school'];?>
		<br/>
			<strong>Programme</strong>:&nbsp; <?php echo $programme;?>
		
	</div>
</td>
	</tr>
</table>

		

	
	<div >
	&nbsp;</div>



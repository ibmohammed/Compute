<div align="center" style="font-size:24pt;">NIGER STATE POLYTECHNIC, ZUNGERU</div>
<!--<div align="center" style="font-size:14pt;">CENTRE FOR CONTINUING EDUCATION AND TRAINING</div>-->
<br>
<?PHP 
  require_once('../../functions/queries.php');
  /*
$csns= mysqli_query($conn,"SELECT college, school
FROM `dept` 
WHERE dep = '$programme' ") 
or die (mysqli_error($conn));

$fet = mysqli_fetch_assoc($csns); 
*/
		$return_dept = programmes(@$programme, $conn);
        $dptid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();
        $return_dept = departmentss(@$dptid['dept_id'], $conn);
        $schlid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();

        $return_schl = schoolss(@$schlid['schl_id'], $conn);
        $clgid = mysqli_fetch_assoc($return_schl);
        //$clgid = $result2->fetch_array();
        $return_college = collegess(@$clgid['college_id'], $conn);
        $clg = mysqli_fetch_assoc($return_college);
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



<h3>NIGER STATE POLYTECHNIC, ZUNGERU</h3>
<!--<div align="center" style="font-size:14pt;">CENTRE FOR CONTINUING EDUCATION AND TRAINING</div>-->
<br>
<?PHP 
  require_once('../functions/queries.php');
  /*
$csns= mysqli_query($logs,"SELECT college, school
FROM `dept` 
WHERE dep = '$programme' ") 
or die (mysqli_error($logs));

$fet = mysqli_fetch_assoc($csns); 
*/
		$return_dept = programmes(@$programme, $logs);
        $dptid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();
        $return_dept = departmentss(@$dptid['dept_id'], $logs);
        $schlid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();

        $return_schl = schoolss(@$schlid['schl_id'], $logs);
        $clgid = mysqli_fetch_assoc($return_schl);
        //$clgid = $result2->fetch_array();
        $return_college = collegess(@$clgid['college_id'], $logs);
        $clg = mysqli_fetch_assoc($return_college);
		?>

<table style="font-size:8pt; text-transform:uppercase" class="table">
	<tr>
		<td style="width: 35%">
			<strong>College</strong>:&nbsp;<?php echo $clg['college']; //$fet['college'];?> 
			<br/>
			<strong>Session</strong>:&nbsp; <?php echo $session;?>
			<br/>
			<strong>Semester</strong>:&nbsp;<?php echo $semester.$first." Semester ";?> 
		</td>
		<td style="width: 15%">&nbsp;</td>
		<td style="width: 15%">&nbsp;</td>
		<td style="width: 35%">
			<strong>Department</strong>:&nbsp; <?php echo $schlid['name'];//$fet['school'];?>
			<br/>
			<strong>School</strong>:&nbsp; <?php echo $clgid['school'];//$fet['school'];?>
			<br/>
			<strong>Programme</strong>:&nbsp; <?php echo $dptid['programme'];//$programme;?>
		</td>
	</tr>
</table>

		

	
	<div >
	&nbsp;</div>



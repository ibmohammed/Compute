
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("header.php");?>

	
			<?php
			$qry = "SELECT * FROM  `studentsnm`";
			$sqm=mysqli_query($conn,$qry) or die(mysqli_error());
			$img = mysqli_fetch_array($sqm);
			$equry = "SELECT * FROM results WHERE matric_no = '$mat'  AND session = '$sess'";
			$mtr = mysqli_query($conn,$equry);
			if (!$mtr){
				die("query failled".mysqli_error());
			}
			$mn = mysqli_fetch_array($mtr);
			?>
			<?php

			if ($mat !== $mn['matric_no'])
			{
				die ("No Records found pls make sure The entries are correct");
			}
			?>
			<br/>

			<table align="center" width="100%">
				
				<tr>
					<td colspan="2" align="center" id="page">
						<!--
						<table>
							<tr>
								<td align="left" class="style9" id="page2"><strong>SEMESTER:</strong></td>
								<td align="left" class="style8" id="page1"><span style="color: #FF0000">
									<strong><?php echo $mn['semester'].$first." "."Semester" ;?></strong></span>
								</td>
								<td align="left" class="style9" id="page">
									<strong><span style="color: #000000">SESSION</span>:
									</strong>
								</td>
								<td align="left" class="style9" id="page2" style="width: 10px">
									<span class="style6"><span style="color: #FF0000"><?php echo $mn['session'] ;?></span>
								</td>
							</tr>
						</table>
						-->
					</td>
				</tr>
			</table>




			<table class="table table-bordered" border="1" cellspacing="0" cellpadding="1" align="center">
			<thead>
			<tr>
				<th id="page3"><big>#</big></th>
				<th id="page3"><big>Codes</big></th>
				<th id="page3"><big> Course Names</big></th>
				<th id="page3"><big>Unit</big></th>
				<th id="page3"><big>Mark</big></th>
				<th id="page3"><big>Grade</strong></big></th>
				<th id="page3"><big>Points</big></th>
				<th id="page3"><big>W Pts</big></th>
				<th id="page3"><big>Sem</big></th>
			</tr> 
			
			</thead>
			<tbody>
			<?php

			$ssql = "SELECT *  FROM course WHERE `prog_id` LIKE '$course'";

			$msq = mysqli_query($conn, $ssql) or die(mysqli_error($logs));

			//$rsql = "SELECT * FROM results WHERE matric_no LIKE '$mat' AND semester = $sem";
			$rsql = "SELECT * FROM results WHERE matric_no LIKE '$mat'";
			$msql = mysqli_query($conn,$rsql)  or die(mysqli_error());;
			$snn = 0;
			while (($row= mysqli_fetch_assoc($msq)) && ($col= mysqli_fetch_assoc($msql)))
			{
				$snn++;
				?>
			<tr>
				<td id="page3"><big><?php echo $snn;?></big></td>
				<td id="page4"><?php echo $row['code'];?></td>
				<td id="page4"><?php echo $row['title'];?></td>
				<td id="page4"><?php echo $col['unit'];?></td>
				<td id="page4"><?php echo $col['score'];?></td>
				<td id="page4"><?php echo $col['grade'];?></td>
				<td id="page4"><?php echo $col['points'];?></td>
				<td id="page4"><?php echo $col['points']*$col['unit'];?></td>
				<td id="page4"><?php echo $col['semester'];?></td>
			</tr>
			
			<?php }?>
			</tbody>
			</table>
		
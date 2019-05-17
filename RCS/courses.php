
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php include("header.php");?>

<style type="text/css">
<!--
a:link {
color: #0033FF;
}
a:hover {
color: #0066FF;
}
.style3 {color: #000000}
-->

<!--
.style1 {color: #FF0000}
.style2 {color: #000066}
.style7 {font-size: 18px}
.style8 {font-size: 16px}
.style9 {font-size: 16px; font-weight: bold; }
-->
</style>

	<table  align="center">
		<tr>
		<td align="center" valign="top">
			<?php
			$qry = "SELECT * FROM  `studentsnm`";
			$sqm=mysqli_query($conn,$qry) or die(mysqli_error());
			$img = mysqli_fetch_array($sqm);
			$equry = "SELECT * FROM results WHERE matric_no LIKE '$mat'  AND session LIKE '$sess'";
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
				<!--<tr>
					<td align="left" id="page" style="height: 24px"><b>MATRIC No.:</b> </td>
					<td align="left" id="page2" style="height: 24px">
						<span style="font-size: 16px">
							<strong><?php echo $mn[2] ;?></strong>
						</span>
					</td>
				</tr>
				<tr align="left">
					<td id="page">
						<b><strong>NAME: </strong></b>
					</td>
					<td id="page2">
						<span style="font-size: 16px"> <strong><?php echo $mn[1];?></strong> </span>
					</td>
				</tr>-->
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
			<table border="1" cellspacing="0" cellpadding="1" align="center">
			<tr>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>#</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Codes</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big> Course Names</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Unit</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Mark</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><big><strong>
				Grade</strong></big></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Points</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>W Pts</big></strong></span></td>
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big>Sem</big></strong></span></td>
			</tr>
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
				<td id="page3"><span style="color: #000000; font-size: 10px"><strong><big><?php echo $snn;?></big></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['code'];?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $row['title'];?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['unit'];?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['score']; ;?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['grade']; ;?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']; ;?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['points']*$col['unit'];?></strong></span></td>
				<td id="page4"><span style="font-size: 10px; color: #000000"><strong><?php echo $col['semester'];?></strong></span></td>
			</tr>
			<?php }?>
			</table>
		</td>
	</tr>
</table>

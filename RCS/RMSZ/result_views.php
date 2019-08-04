
<?php 
if(isset($_POST['Submit']))
{ 
	?>
	<?php 
	$semester=$_POST['semester'];
	$session=$_POST['session'];
	$year=$_POST['year'];
	$programme=$_POST['programme'];
	$start=@$_POST['start'];
	$list=@$_POST['list'];
	
	if ($programme =="" || $year == "" || $session == "" || $semester == "") 
	{
		echo '<script type="text/javascript">
		alert("Empty fields not allowed!!!");
		location.replace("index.php?views");
    	</script>';
		//die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
	}

		//	elect courses 

	$the_course_result = the_courses($logs, $programme, $semester, $session);

	switch ($semester) 
	{
		case "1":
		$first = "st";
		$s = "1";
		break;

		case "2":
		$first = "nd";
		$s = "2";
		break;

		case "3":
		$first = "rd";
		$s = "3";

		break;
		case "4":
		$first = "th";
		$s = "4";
		break;

		case "5":
		$first = "th";
		$s = "5";
		break;

		case "6":
		$first = "th";
		$s = "6";

		break;
	}

	// keep title here

	include('title.php');

	?>
	</div>
	<style type="text/css" media="print,screen" >
		table td 
		{
			border-bottom:1px solid gray;
		}
		th 
		{
			font-family:Arial;
			color:black;
			background-color:lightgrey;
		}
		thead 
		{
			display:table-header-group;
		}
		tbody 
		{
			display:table-row-group;
		}
	</style>
<?php
if($academic_res == 1 || $academic_res == 3)
{
    $th_names = '<th rowspan="2">Names</th>';
   
}
elseif($academic_res == 0 || $academic_res == 2)
{
    $th_names = "";
    $td_names_s = "";
    $td_names_e = "";
}
?>
	<table id="t1" border="1" align="center" cellpadding="0" cellspacing="1" style=" width:auto; border:thin; border-collapse:collapse"> 
    
    <!--<table id="t1" class="table table-bordered">-->
		<thead>
			<tr style="font-size:7pt;">
				<th rowspan="2"><div align="center" style="font-weight: bold"><span><strong>S/N</strong></span></div></th>
				<th rowspan="2" ><div align="center" style="font-weight: bold"><span><strong>Matric_No</strong></span></div></th>
                <?php echo $th_names;?>
				<?php 
				while($row = mysqli_fetch_array($the_course_result, MYSQLI_ASSOC))
				{ 
				?>  
				<th rowspan="2"><div align="center" style="font-weight: bold"><span><strong><?php echo $row['code']."<br>"."(".$row['unit'].")";?></strong></span></div></th>
				<?php }?>
				<th colspan="3"><div align="center" style="font-weight: bold">Current_Semester </div></th>
				<th colspan="3"><div align="center" style="font-weight: bold">Previous_Semester </div></th>
				<th colspan="3"><div align="center" style="font-weight: bold">Current_Cumulative </div></th>
				<th colspan="5"><div align="center" style="font-weight: bold">REMARKS</div></th>
			</tr>
			<tr style="font-size:8pt;">
				<th style="height: 21px" ><div align="center" style="font-weight: bold">cr</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">gp</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">gpa</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">cr</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">gp</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">gpa</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">cr</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">gp</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">gpa</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">co</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">EM</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">Sit</div></th>
				<th style="height: 21px" ><div align="center" style="font-weight: bold">Pend</div></th>
				<th style="height: 21px" ><div align="center"></div></th>
			</tr>
		</thead>
	<?php $n = $start; 

	// delete the $start and $last variable to make all result appear
	//$msql=mysqli_query($conn,"SELECT * FROM `studentsnm` WHERE prog_id ='$programme'&&  year='$year'  && Withdrwan ='0' ORDER BY  `matno` ASC LIMIT $start,$list");

	$the_student = the_students($conn, $programme, $year);

	while($col = mysqli_fetch_array($the_student, MYSQLI_ASSOC))
	{
		$n= $n+1;
		?>
		<tbody>
			<tr style="font-size:8pt">
				<td><?php echo $n;?></td>
				<td><?php echo $col['matno'];?> &nbsp;</td>
                <?php 
                if($academic_res == 1 || $academic_res == 3)
                {
                    echo "<td>".$col['names']."</td>";
                }
               // echo $td_names_s. $td_names_e;?>
				<?php 
				$matno = $col['matno'];

				//$sql= mysqli_query($conn,"SELECT * FROM results WHERE 
				//prog_id='$programme' && semester='$semester' && matric_no='$matno'") 
				//or die (mysqli_error($conn));
				$the_semeter_result = the_semeter_result($conn, $programme, $semester, $matno);

				$unit=0;
				$gp=0;
				$rem = 0;

				while ($res=mysqli_fetch_array($the_semeter_result, MYSQLI_ASSOC))
				{

					?>
					<td >
					<div align="center" style="font-size:10pt">
					<?php
					// grade / score 
					if (($res['grade']=="SICK")||($res['grade']=="ABSE")||($res['grade']=="PEND")||($res['grade']=="---")||($res['grade']=="EM")||($res['grade']=="AE")||($res['grade']=="PI"))
					{
						echo $res['grade']; 
					}
					else
					{ 
						// echo $res['score'];
						//echo '<br/><hr style="width:8px; height:;"/>';
						echo $res['grade'];
					} 
					?>
					</div></td>
					<?php 
					// do not count the unit of unknown grades
					if (($res['grade']=="SICK")||($res['grade']=="ABSE")||($res['grade']=="PEND")||($res['grade']=="---")||($res['grade']=="EM")||($res['grade']=="AE")||($res['grade']=="PI"))
					{
						$res['unit']=0; 
					} 

					$unit=$unit+$res['unit'];
					$p=$res['unit']*$res['points'];
					$gp=$gp+$p;
				}

				if ($unit==0)
				{
					$gpa= 0;	
				}
				else
				{
					$gpa = number_format(($gp/$unit),2);
				}
				include("includes/cpgpa.php");

				?>
				<td><div align="center"><?php echo $unit;?></div></td>
				<td><div align="center"><?php echo $gp;?></div></td>
				<td><div align="center"><?php echo $gpa;?></div></td>
				<td><div align="center"><?php echo $pcu;?></div></td>
				<td><div align="center"><?php echo $pcgp;?></div></td>
				<td><div align="center"><?php echo $pcgpa;?></div></td>
				<td><div align="center"><?php echo $ccu;?></div></td>
				<td><div align="center"><?php echo $ccgp;?></div></td>
				<td>
					<div align="center"><?php echo $ccgpa;?></span></div>
				</td>
				<td>
					<div align="center"><?php include("includes/rmk.php"); ?></div>
				</td>
				<td>
					<div align="center">
						<?php 
						$matno = $col['matno'];
						$the_student_result = the_student_result($logs, $programme, $matno);
						if(!$the_student_result)
						{
							die (mysqli_error());
						}

						$the_total_unit = the_total_unit($logs, $programme, $semester, $session);
						$uu = mysqli_fetch_array($the_total_unit, MYSQLI_ASSOC);
						$unn = $uu['vaule_sum'];

						$rem = 0;
						while ($result=mysqli_fetch_array($the_student_result, MYSQLI_ASSOC))
						{  
							if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")||($result['grade'] =="ABSE")||($result['grade'] =="EM")||($result['grade']=="AE")||($result['grade']=="PI"))
							{
								$rem++;
								$reslt = $result['grade'];
							}
						}

						//$ccgpa
						if ($semester <=5)
						{
							if($rem>=1)
							{

								if(($gpa<=1.49)&&($semester==1)&&($unit == 0) )
								{

									echo "";

								}
								elseif(($gpa<=1.49)&&($semester>=1))
								{
									echo "ATW";
								}elseif(($unit > $unn))
								{
									echo "";
									//}elseif(($gpa<=1.49)&&($semester>=1)&&($unit == 0)){
									//echo "";
								}
							}
							elseif($rem<1)
							{
								if(($unit == $unn)&&($gpa>=3.5))
								{
									echo "QR";
								}
								elseif($gpa<=1.49 && ($unit < $unn))
								{
									echo "ATW";
								}elseif(($unit == $unn)&& ($gpa >=1.50))
								{
									echo "PASS";
								}
							}

						}
						elseif($semester==6)
						{
							if(($rem>=1 )&&($reslt=="EM"))
							{
								echo "EM"; 
							}
							elseif($rem>=1)
							{
								echo "";
							}
							elseif($rem<1)
							{
								include("includes/remks.php");
								echo $remarks;
							}
						} 

						?>
					</div>
				</td>
			</tr>
			<?php 
		}
		//wihle from the student table
			?>
		</tbody> 
	</table>
		

<?php 
if($academic_res == 1 || $academic_res == 3)
{?>

		<div id="analysis"> 
			<?php 
			// dislay Analysis Page after the rsult 
			echo "<p style='page-break-before:always'></p>";
			include('analysis1.php');
			echo "<p style='page-break-before:always'></p>";
			include('analyz.php');
			?>
		</div>
        <?php 
        $the_act = "viewexport.php";
        $the_print = "viewabm_print.php";
}
elseif($academic_res == 0 || $academic_res == 2)
{
    $the_act = "viewexport1.php";
    $the_print = "views_print.php";
}
?>

		<!-- Exportto word -->
	
		
    <?php 
    if($academic_res == 2 || $academic_res == 3)
    {

    }
    else{
///";
include('selected.php');

    }
			exit; 
}
?>
    
    

   
    
  <p>&nbsp;</p>


<?php
 include("viewforms.php");
 ?>
<?php //require('includes/header.php');    ?>


<?php 


$semester=$_POST['semester'];
$session=$_POST['session'];
$year=$_POST['year'];
$programme=$_POST['programme'];
$start=@$_POST['start'];
$list=@$_POST['list'];

$atw = 0;
$pass = 0;
$abs = 0;
$msql=mysqli_query($logs,"SELECT * FROM `studentsnm` 
WHERE prog_id ='$programme' && year='$year' 
&& Withdrwan ='0'  ORDER BY length(matno),matno ASC") or 
die(mysqli_error($logs));

$numrow = mysqli_num_rows($msql);

while ($col=mysqli_fetch_assoc($msql))
{
	$n= $n+1;
	$matnos = $col['matno'];
	$sql= mysqli_query($logs,"SELECT * FROM results WHERE prog_id='$programme' && 
	semester='$semester'  && matric_no='$matnos'") or die (mysqli_error());
	$unit=0;
	$gp=0;
	$rem = 0;
	while ($res=mysqli_fetch_assoc($sql))
	{
		?>
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

	if($gpa <= 1.49)
	{
		$atw++;
	}
	//	echo $gpa.'<br>';
	$mysql= mysqli_query($logs,"SELECT * FROM results WHERE prog_id='$programme' &&  matric_no='$matnos'") or 
	die (mysqli_error());

	$qq = mysqli_query($logs,"SELECT SUM(unit) AS vaule_sum FROM course 
	WHERE prog_id='$programme' && semester ='$semester' && sessions = '$session'");
	$uu = mysqli_fetch_assoc($qq);
	$unn = $uu['vaule_sum'];

	//$unit=0;
	//$gp=0;
	$rem = 0;
	while ($result=mysqli_fetch_assoc($mysql))
	{ 
		if (($result['grade'] =="F")||($result['grade'] =="PEND")||($result['grade'] =="ABS")||($result['grade'] =="SICK")||($result['grade'] =="ABSE")||($result['grade'] =="EM")||($result['grade']=="AE")||($result['grade']=="PI"))
		{
			$rem++;
			$reslt = $result['grade'];

			if(($reslt=="AE") or ($reslt=="ABS"))
			{
				// echo "PENDING"; 
				$abs++;
			}

		}
	}

	// Work on this Part to Set The Remarks Accordinlgy 


	if ($semester <=5)
	{

		if($rem>=1)
		{
			if(($gpa<=1.49) && ($semester==1) && ($unit == 0))
			{
				echo "";
			}
			elseif(($unit > $unn))
			{
				echo "";	
			}
		}
		elseif($rem<1)
		{
			
			if(($unit == $unn) && ( ($gpa >= 1.50) || ($gpa >= 3.50)))
			{
				$pass++;
			}
		}

	}
	elseif($semester==6)
	{
		if($rem>=1)
		{
			echo "";
		}
		elseif($rem<1)
		{
			include("includes/remks.php");
			//echo $remarks;
		}
	} 
	
}

if (@$n!=0)
{

	$pp = number_format(((@$pass/@$n) * 100),2);
	$ptw = number_format(((@$atw/@$n) * 100),2);
	$pabs = number_format(((@$abs/@$n) * 100),2);
}	

	?>
<h2 align="Center">Result Summary in Table</h2>

<table border="1" align="center" cellpadding="0" cellspacing="1" style="font-size:14px; width: 100%; border:thin; border-collapse:collapse" class="table table-bordered">
	<tr>
		<td style="height: 23px; width: 266px;"><strong>Total Number of Students in Class:</strong></td>
		<td style="height: 23px; width: 31px;" class="auto-style1"><strong>&nbsp; <?php echo $numrow;?>
		</strong></td>
		<td style="height: 23px; width: 87px;" class="auto-style1"><strong>&nbsp;%100.00</strong></td>
	</tr>
	<tr>
		<td style="width: 266px"><strong>Number of Students that Passed:</strong></td>
		<td style="width: 31px" class="auto-style1"><strong>&nbsp;<?php echo $pass;
		if(@$numrow!==0)
		{
			$rr = number_format((($pass/$numrow)*100),2);
		}
		?></strong></td>
		<td style="width: 87px" class="auto-style1">&nbsp;<strong><?php echo '%'.@$rr;?></strong></td>
	</tr>
	<tr>
	<?php 
	$co = (($numrow) - ($pass) - ($abs) - ($atw));
	if (@$n!=0)
	{
		$pf = number_format((($co /$n) * 100),2);
	}?>
		<td style="width: 266px; height: 25px"><strong>Number of Students with CO:</strong></td>
		<td style="width: 31px; height: 25px" class="auto-style1"><strong>&nbsp;<?php echo $co;
		if(@$numrow!=0)
		{
			$ccc = number_format((($co/$numrow)*100),2);
		}
		?></strong></td>
		<td style="width: 87px; height: 25px" class="auto-style1">&nbsp;<strong><?php echo '%'.@$ccc;?></strong></td>
	</tr>
	<tr>
		<td style="width: 266px"><strong>Number of Students Abesnt with Excuse:</strong></td>
		<td style="width: 31px" class="auto-style1"><strong>&nbsp;<?php echo @$abs;
		if(@$numrow!=0)
		{
			$abss =number_format((($abs/$numrow)*100),2);
		}
		?></strong></td>
		<td style="width: 87px" class="auto-style1">&nbsp;<strong><?php echo '%'.@$abss;?></strong></td>
	</tr>
	<tr>
		<td style="width: 266px; height: 25px;"><strong>Number of Students ATW:</strong></td>
		
				
		<td style="width: 31px; height: 25px;" class="auto-style1"><strong>&nbsp;<?php echo @$atw;
		
		if(@$numrow!=0)
		{
			$atww = number_format((($atw/$numrow)*100),2);
		}
		?></strong></td>
		
				
		<td style="width: 87px; height: 25px;" class="auto-style1">&nbsp;<strong><?php echo '%'.@$atww;?></strong></td>
	</tr>
</table>
<?php 

?>
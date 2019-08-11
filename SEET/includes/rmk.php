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
        
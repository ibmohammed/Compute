<?php 
if ($semester == 2)
{
$sem_range = 2;
$semester = 1;
}
elseif ($semester == 3)
{
$sem_range = 3;
$semester = 2;
}
elseif ($semester == 4)
{
$sem_range =  4;
$semester = 3;
}
elseif ($semester == 5)
{
$sem_range = 5;
$semester = 4;
}
elseif ($semester == 6)
{
$sem_range =  6;
$semester = 5;
}

if ($semester >1)
{
	$sem2_cum = 
	"SELECT 
	name, matric_no, sum(unit) as ccunit, sum(unit*points) as ccgp, (sum(unit*points)/sum(unit)) as ccgpa  
	FROM `results` 
	WHERE 
	matric_no = '$matno' 
	AND 
	(
	`grade` Not LIKE'AE' OR'SICK' OR 'PEND' OR 'PI' OR 'EM' OR 'ABSE' OR '---' OR 'MS'
	)
	AND 
	`semester` <= $sem_range";

	$sem2_cum = mysqli_query($logs, $sem2_cum) or die (mysqli_error($logs));
						$sem2_cum = mysqli_fetch_assoc($sem2_cum);
						$ccu = $sem2_cum["ccunit"];
						$ccgp = $sem2_cum["ccgp"];
						$ccgpa = $sem2_cum["ccgpa"];


	$sem2_prev = 
	"SELECT 
	name, matric_no, sum(unit) as pcunit, sum(unit*points) as pcgp, (sum(unit*points)/sum(unit)) as pcgpa  
	FROM `results` 
	WHERE 
	matric_no = '$matno' 
	AND 
	(
	`grade` Not LIKE'AE' OR'SICK' OR 'PEND' OR 'PI' OR 'EM' OR 'ABSE' OR '---' OR 'MS'
	)
	AND 
	semester = '$semester'";

	$sem2_prev = mysqli_query($logs, $sem2_prev) or die (mysqli_error($logs));
						$sem2_prev = mysqli_fetch_assoc($sem2_prev);
						$pcu = $sem2_prev["pcunit"];
						$pcgp = $sem2_prev["pcgp"];
						$pcgpa = $sem2_prev["pcgpa"];


	//previous cumulative

	$pcgpa=number_format($pcgpa,2);
	
	$ccgpa= number_format(($ccgp/$ccu),2);

}
elseif($semester==1)
{
		
	$sem2_cum = 
	"SELECT 
	name, matric_no, sum(unit) as ccunit, sum(unit*points) as ccgp, (sum(unit*points)/sum(unit)) as ccgpa  
	FROM `results` 
	WHERE 
	matric_no = '$matno' 
	AND 
	(
	`grade` Not LIKE'AE' OR'SICK' OR 'PEND' OR 'PI' OR 'EM' OR 'ABSE' OR '---' OR 'MS'
	)
	AND 
	semester = 1";

	$sem2_cum = mysqli_query($logs, $sem2_cum) or die (mysqli_error($logs));
						$sem2_cum = mysqli_fetch_assoc($sem2_cum);
						$ccu = $sem2_cum["ccunit"];
						$ccgp = $sem2_cum["ccgp"];
						$ccgpa = $sem2_cum["ccgpa"];

						$unit = $sem2_cum["ccunit"];
						$gp = $sem2_cum["ccgp"];
						$gpa = $sem2_cum["ccgpa"];


		//cumulative for first
			//previous cumulative
			
			$pcgp="000";
			$pcu="000";
			$pcgpa="000";
			//current cumulative
		
			
			if($ccu == 0){
			$ccgpa = 0;	
			$gpa= 0;
			}else{

			$ccgpa= number_format(($ccgp/$ccu),2);
			$gpa = number_format(($gp/$unit),2);
			}
		
	/*
			$ccgp="000";
			$ccu="000";
			$ccgpa="000";
*/	
		}
		?>
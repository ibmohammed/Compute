<?php 
if ($semester ==2){
$ssql = "SELECT * FROM results WHERE prog_id='$programme' && semester='1'  && matric_no='$matno'";
$sql1= mysqli_query($conn,$ssql) or die(mysqli_error($conn) );

$ssql2 = "SELECT * FROM results WHERE prog_id='$programme' && semester='2'  && matric_no='$matno'";
$sql2= mysqli_query($conn,$ssql2) or die(mysqli_error($conn) );


//first
		$unit1=0;
		$gp1=0;
		
		while ($res1=mysqli_fetch_assoc($sql1)){ 
		
		if (($res1['grade']=="SICK")||($res1['grade']=="ABSE")||($res1['grade']=="PEND")||($res1['grade']=="---")||($res1['grade']=="EM")||($res1['grade'] =="MS")||($res1['grade']=="AE")||($res1['grade']=="PI")){
			 $res1['unit'] = 0;
}
		
		
		$unit1 = $unit1 + $res1['unit'];
		$p1 = $res1['unit']*$res1['points'];
		$gp1=$gp1+$p1;
		}
		if($unit1 == 0){
		$gpa1 = 0;	
			}else{
				$gpa1 = $gp1/$unit1;
			}

		//second
		$unit2=0;
		$gp2=0;

		while ($res2=mysqli_fetch_assoc($sql2)){ 
		
			if (($res2['grade']=="SICK")||($res2['grade']=="ABSE")||($res2['grade']=="PEND")||($res2['grade']=="---")||($res2['grade']=="EM")||($res2['grade'] =="MS")||($res2['grade']=="AE")||($res2['grade']=="PI")){
			 $res2['unit']=0;
}
		
		$unit2=$unit2+$res2['unit'];
		$p2=$res2['unit']*$res2['points'];
		$gp2=$gp2+$p2;
		}
		if($unit2 == 0){
		$gpa2 = 0;	
			}else{
				$gpa2 = $gp2/$unit2;
			}
		
		//cumulative for second
			//previous cumulative
			$pcgp =$gp1;
		 	$pcgpa=number_format($gpa1,2);
		 	$pcu=$unit1;
			//current cumulative
			$ccgp=$gp1+$gp2;
			$ccu=$unit1+$unit2;
			$ccgpa= number_format(($ccgp/$ccu),2);
		
		}elseif($semester==3){
$ssql1 = "SELECT * FROM results WHERE programme='$programme' && semester='1'  && matric_no='$matno'";
$sql1= mysqli_query($conn,$ssql1); 

$ssql2 = "SELECT * FROM results WHERE programme='$programme' && semester='2'  && matric_no='$matno'";
$sql2= mysqli_query($conn,$ssql2);

$ssql3 = "SELECT * FROM results WHERE programme='$programme' && semester='3'  && matric_no='$matno'";
$sql3= mysqli_query($conn,$ssql3);


//first
		$unit1=0;
		$gp1=0;
		
		while ($res1=mysqli_fetch_assoc($sql1)){ 

if (($res1['grade']=="SICK")||($res1['grade']=="ABSE")||($res1['grade']=="PEND")||($res1['grade']=="---")||($res1['grade']=="EM"||($res1['grade'] =="MS")||($res1['grade']=="AE")||($res1['grade']=="PI"))){
			 $res1['unit']=0;
}
		$unit1=$unit1+$res1['unit'];
		$p1=$res1['unit']*$res1['points'];
		$gp1=$gp1+$p1;
		}
		if($unit1 == 0){
		$gpa1 = 0;	
			}else{
				$gpa1 = $gp1/$unit1;
			}

		//second
		$unit2=0;
		$gp2=0;

		
		while ($res2=mysqli_fetch_assoc($sql2)){ 

			if (($res2['grade']=="SICK")||($res2['grade']=="ABSE")||($res2['grade']=="PEND")||($res2['grade']=="---")||($res2['grade']=="EM")||($res2['grade'] =="MS")||($res2['grade']=="AE")||($res2['grade']=="PI")){
			 $res2['unit']=0;
}
		$unit2=$unit2+$res2['unit'];
		$p2=$res2['unit']*$res2['points'];
		$gp2=$gp2+$p2;
		}
		if($unit2 == 0){
		$gpa2 = 0;	
			}else{
				$gpa2 = $gp2/$unit2;
			}
		
		//third
		$unit3=0;
		$gp3=0;

		
while ($res3=mysqli_fetch_assoc($sql3)){ 
	if (($res3['grade']=="SICK")||($res3['grade']=="ABSE")||($res3['grade']=="PEND")||($res3['grade']=="---")||($res3['grade']=="EM")||($res3['grade'] =="MS")||($res3['grade']=="AE")||($res3['grade']=="PI")){
			 $res3['unit']=0;
}
		$unit3=$unit3+$res3['unit'];
		$p3=$res3['unit']*$res3['points'];
		$gp3=$gp3+$p3;
		}
		if($unit3 == 0){
		$gpa3 = 0;	
			}else{
				$gpa3 = $gp3/$unit3;
			}
		
		//cumulative for third
			//previous cumulative
			
			$pcgp=$gp1+$gp2;
			$pcu=$unit1+$unit2;
			$pcgpa=number_format(($pcgp/$pcu),2);
			//current cumulative
			
			$ccgp=$gp1+$gp2+$gp3;
			$ccu=$unit1+$unit2+$unit3;
			$ccgpa= number_format(($ccgp/$ccu),2);
		
		}elseif($semester==4){
$ssql1 = "SELECT * FROM results WHERE programme='$programme' && semester='1'  && matric_no='$matno'";
$sql1= mysqli_query($conn,$ssql1);

$ssql2 = "SELECT * FROM results WHERE programme='$programme' && semester='2'  && matric_no='$matno'";
$sql2= mysqli_query($conn,$ssql2);

$ssql3 = "SELECT * FROM results WHERE programme='$programme' && semester='3'  && matric_no='$matno'";
$sql3= mysqli_query($conn,$ssql3);

$ssql4 = "SELECT * FROM results WHERE programme='$programme' && semester='4'  && matric_no='$matno'";
$sql4= mysqli_query($conn,$ssql4);

//first
		$unit1=0;
		$gp1=0;
		
		while ($res1=mysqli_fetch_assoc($sql1)){ 

if (($res1['grade']=="SICK")||($res1['grade']=="ABSE")||($res1['grade']=="PEND")||($res1['grade']=="---")||($res1['grade']=="EM")||($res1['grade'] =="MS")||($res1['grade']=="AE")||($res1['grade']=="PI")){
			 $res1['unit']=0;
}

		$unit1=$unit1+$res1['unit'];
		$p1=$res1['unit']*$res1['points'];
		$gp1=$gp1+$p1;
		}
		if($unit1 == 0){
		$gpa1 = 0;	
			}else{
				$gpa1 = $gp1/$unit1;
			}

		//second
		$unit2=0;
		$gp2=0;

		while ($res2=mysqli_fetch_assoc($sql2)){ 
		
		if (($res2['grade']=="SICK")||($res2['grade']=="ABSE")||($res2['grade']=="PEND")||($res2['grade']=="---")||($res2['grade']=="EM")||($res2['grade'] =="MS")||($res2['grade']=="AE")||($res2['grade']=="PI")){
			 $res2['unit']=0;
}
		$unit2=$unit2+$res2['unit'];
		$p2=$res2['unit']*$res2['points'];
		$gp2=$gp2+$p2;
		}
		if($unit2 == 0){
		$gpa2 = 0;	
			}else{
				$gpa2 = $gp2/$unit2;
			}
		
		//third
		$unit3=0;
		$gp3=0;

		
		while ($res3=mysqli_fetch_assoc($sql3)){ 

			if (($res3['grade']=="SICK")||($res3['grade']=="ABSE")||($res3['grade']=="PEND")||($res3['grade']=="---")||($res3['grade']=="EM")||($res3['grade'] =="MS")||($res3['grade']=="AE")||($res3['grade']=="PI")){
			 $res3['unit']=0;
}


		$unit3=$unit3+$res3['unit'];
		$p3=$res3['unit']*$res3['points'];
		$gp3=$gp3+$p3;
		}
		if($unit3 == 0){
		$gpa3 = 0;	
			}else{
				$gpa3 = $gp3/$unit3;
			}
		//fourth
		$unit4=0;
		$gp4=0;

		
		while ($res4=mysqli_fetch_assoc($sql4)){ 

			if (($res4['grade']=="SICK")||($res4['grade']=="ABSE")||($res4['grade']=="PEND")||($res4['grade']=="---")||($res4['grade']=="EM")||($res4['grade'] =="MS")||($res4['grade']=="AE")||($res4['grade']=="PI")){
			 $res4['unit']=0;
}


		$unit4=$unit4+$res4['unit'];
		$p4=$res4['unit']*$res4['points'];
		$gp4=$gp4+$p4;
		}
		if($unit4 == 0){
		$gpa4 = 0;	
			}else{
				$gpa4 = $gp4/$unit4;
			}
		
		//cumulative for fourth
			//previous cumulative
			
			$pcgp=$gp1+$gp2+$gp3;
			$pcu=$unit1+$unit2+$unit3;
			$pcgpa=number_format(($pcgp/$pcu),2);
			//current cumulative
			
			$ccgp=$gp1+$gp2+$gp3+$gp4;
			$ccu=$unit1+$unit2+$unit3+$unit4;
			$ccgpa= number_format(($ccgp/$ccu),2);
		
		
		}elseif($semester==5){
$ssql1 = "SELECT * FROM results WHERE programme='$programme' && semester='1'  && matric_no='$matno'";
$sql1= mysqli_query($conn,$ssql1);

$ssql2 = "SELECT * FROM results WHERE programme='$programme' && semester='2'  && matric_no='$matno'";
$sql2= mysqli_query($conn,$ssql2);

$ssql3 = "SELECT * FROM results WHERE programme='$programme' && semester='3'  && matric_no='$matno'";
$sql3= mysqli_query($conn,$ssql3);

$ssql4 = "SELECT * FROM results WHERE programme='$programme' && semester='4'  && matric_no='$matno'";
$sql4= mysqli_query($conn,$ssql4);

$ssql5 = "SELECT * FROM results WHERE programme='$programme' && semester='5'  && matric_no='$matno'";
$sql5= mysqli_query($conn,$ssql5);

//first
		$unit1=0;
		$gp1=0;
		
		while ($res1=mysqli_fetch_assoc($sql1)){ 

if (($res1['grade']=="SICK")||($res1['grade']=="ABSE")||($res1['grade']=="PEND")||($res1['grade']=="---")||($res1['grade']=="EM")||($res1['grade'] =="MS")||($res1['grade']=="AE")||($res1['grade']=="PI")){
			 $res1['unit']=0;
}

		$unit1=$unit1+$res1['unit'];
		$p1=$res1['unit']*$res1['points'];
		$gp1=$gp1+$p1;
		}
		if($unit1 == 0){
		$gpa1 = 0;	
			}else{
				$gpa1 = $gp1/$unit1;
			}

		//second
		$unit2=0;
		$gp2=0;

		
		while ($res2=mysqli_fetch_assoc($sql2)){ 
		
		if (($res2['grade']=="SICK")||($res2['grade']=="ABSE")||($res2['grade']=="PEND")||($res2['grade']=="---")||($res2['grade']=="EM")||($res2['grade'] =="MS")||($res2['grade']=="AE")||($res2['grade']=="PI")){
			 $res2['unit']=0;
}
		
		$unit2=$unit2+$res2['unit'];
		$p2=$res2['unit']*$res2['points'];
		$gp2=$gp2+$p2;
		}
		if($unit2 == 0){
		$gpa2 = 0;	
			}else{
				$gpa2 = $gp2/$unit2;
			}
		
		//third
		$unit3=0;
		$gp3=0;

		
		while ($res3=mysqli_fetch_assoc($sql3)){ 
		
		if (($res3['grade']=="SICK")||($res3['grade']=="ABSE")||($res3['grade']=="PEND")||($res3['grade']=="---")||($res3['grade']=="EM")||($res3['grade'] =="MS")||($res3['grade']=="AE")||($res3['grade']=="PI")){
			 $res3['unit']=0;
}
		
		$unit3=$unit3+$res3['unit'];
		$p3=$res3['unit']*$res3['points'];
		$gp3=$gp3+$p3;
		}
		if($unit3 == 0){
		$gpa3 = 0;	
			}else{
				$gpa3 = $gp3/$unit3;
			}
		
		//fourth
		$unit4=0;
		$gp4=0;

		
		while ($res4=mysqli_fetch_assoc($sql4)){ 
		
		if (($res4['grade']=="SICK")||($res4['grade']=="ABSE")||($res4['grade']=="PEND")||($res4['grade']=="---")||($res4['grade']=="EM")||($res4['grade'] =="MS")||($res4['grade']=="AE")||($res4['grade']=="PI")){
			 $res4['unit']=0;
}
		
		$unit4=$unit4+$res4['unit'];
		$p4=$res4['unit']*$res4['points'];
		$gp4=$gp4+$p4;
		}
		if($unit4 == 0){
		$gpa4 = 0;	
			}else{
				$gpa4 = $gp4/$unit4;
			}
		
		//fifth
		$unit5=0;
		$gp5=0;

		
		while ($res5=mysqli_fetch_assoc($sql5)){ 

	
	if (($res5['grade']=="SICK")||($res5['grade']=="ABSE")||($res5['grade']=="PEND")||($res5['grade']=="---")||($res5['grade']=="EM")||($res5['grade'] =="MS")||($res5['grade']=="AE")||($res5['grade']=="PI")){
			 $res5['unit']=0;
}
		$unit5=$unit5+$res5['unit'];
		$p5=$res5['unit']*$res5['points'];
		$gp5=$gp5+$p5;
		}
		if($unit5 == 0){
		$gpa5 = 0;	
			}else{
				$gpa5 = $gp5/$unit5;
			}
		
		//cumulative for fifth
			//previous cumulative
			
			$pcgp=$gp1+$gp2+$gp3+$gp4;
			$pcu=$unit1+$unit2+$unit3+$unit4;
			$pcgpa=number_format(($pcgp/$pcu),2);
			//current cumulative
			
			$ccgp=$gp1+$gp2+$gp3+$gp4+$gp5;
			$ccu=$unit1+$unit2+$unit3+$unit4+$unit5;
			$ccgpa= number_format(($ccgp/$ccu),2);
		
		
		
		}elseif($semester==6){
$ssql1 = "SELECT * FROM results WHERE programme='$programme' && semester='1'  && matric_no='$matno'";
$sql1= mysqli_query($conn,$ssql1);

$ssql2 = "SELECT * FROM results WHERE programme='$programme' && semester='2'  && matric_no='$matno'";
$sql2= mysqli_query($conn,$ssql2);

$ssql3 = "SELECT * FROM results WHERE programme='$programme' && semester='3'  && matric_no='$matno'";
$sql3= mysqli_query($conn,$ssql3);

$ssql4 = "SELECT * FROM results WHERE programme='$programme' && semester='4'  && matric_no='$matno'";
$sql4= mysqli_query($conn,$ssql4);

$ssql5 = "SELECT * FROM results WHERE programme='$programme' && semester='5'  && matric_no='$matno'";
$sql5= mysqli_query($conn,$ssql5);

$ssql6 = "SELECT * FROM results WHERE programme='$programme' && semester='6'  && matric_no='$matno'";
$sql6= mysqli_query($conn,$ssql6);


//first
		$unit1=0;
		$gp1=0;
		
		while ($res1=mysqli_fetch_assoc($sql1)){ 
		
		if (($res1['grade']=="SICK")||($res1['grade']=="ABSE")||($res1['grade']=="PEND")||($res1['grade']=="---")||($res1['grade']=="EM")||($res1['grade'] =="MS")||($res1['grade']=="AE")||($res1['grade']=="PI")){
			 $res1['unit']=0;
}
		
		$unit1=$unit1+$res1['unit'];
		$p1=$res1['unit']*$res1['points'];
		$gp1=$gp1+$p1;
		}
		if($unit1 == 0){
		$gpa1 = 0;	
			}else{
				$gpa1 = $gp1/$unit1;
			}

		//second
		$unit2=0;
		$gp2=0;

		
		while ($res2=mysqli_fetch_assoc($sql2)){ 
		
		if (($res2['grade']=="SICK")||($res2['grade']=="ABSE")||($res2['grade']=="PEND")||($res2['grade']=="---")||($res2['grade']=="EM")||($res2['grade'] =="MS")||($res2['grade']=="AE")||($res2['grade']=="PI")){
			 $res2['unit']=0;
}
		
		$unit2=$unit2+$res2['unit'];
		$p2=$res2['unit']*$res2['points'];
		$gp2=$gp2+$p2;
		}
		if($unit2 == 0){
		$gpa2 = 0;	
			}else{
				$gpa2 = $gp2/$unit2;
			}
		
		//third
		$unit3=0;
		$gp3=0;

		
		while ($res3=mysqli_fetch_assoc($sql3)){ 
		
		if (($res3['grade']=="SICK")||($res3['grade']=="ABSE")||($res3['grade']=="PEND")||($res3['grade']=="---")||($res3['grade']=="EM")||($res3['grade'] =="MS")||($res3['grade']=="AE")||($res3['grade']=="PI")){
			 $res3['unit']=0;
}
		
		$unit3=$unit3+$res3['unit'];
		$p3=$res3['unit']*$res3['points'];
		$gp3=$gp3+$p3;
		}
		if($unit3 == 0){
		$gpa3 = 0;	
			}else{
				$gpa3 = $gp3/$unit3;
			}
		
		//fourth
		$unit4=0;
		$gp4=0;

		
		while ($res4=mysqli_fetch_assoc($sql4)){ 
		
		if (($res4['grade']=="SICK")||($res4['grade']=="ABSE")||($res4['grade']=="PEND")||($res4['grade']=="---")||($res4['grade']=="EM")||($res4['grade'] =="MS")||($res4['grade']=="AE")||($res4['grade']=="PI")){
			 $res4['unit']=0;
}
		
		$unit4=$unit4+$res4['unit'];
		$p4=$res4['unit']*$res4['points'];
		$gp4=$gp4+$p4;
		}
		if($unit4 == 0){
		$gpa4 = 0;	
			}else{
				$gpa4 = $gp4/$unit4;
			}
		
		//fifth
		$unit5=0;
		$gp5=0;

		
		while ($res5=mysqli_fetch_assoc($sql5)){ 
		
			if (($res5['grade']=="SICK")||($res5['grade']=="ABSE")||($res5['grade']=="PEND")||($res5['grade']=="---")||($res5['grade']=="EM")||($res5['grade'] =="MS")||($res5['grade']=="AE")||($res5['grade']=="PI")){
			 $res5['unit']=0;
}
		$unit5=$unit5+$res5['unit'];
		$p5=$res5['unit']*$res5['points'];
		$gp5=$gp5+$p5;
		}
		if($unit5 == 0){
		$gpa5 = 0;	
			}else{
				$gpa5 = $gp5/$unit5;
			}
		
		//sixth
		$unit6=0;
		$gp6=0;

		
		while ($res6=mysqli_fetch_assoc($sql6)){ 
		
			if (($res6['grade']=="SICK")||($res6['grade']=="ABSE")||($res6['grade']=="PEND")||($res6['grade']=="---")||($res6['grade']=="EM")||($res6['grade'] =="MS")||($res6['grade']=="AE")||($res6['grade']=="PI")){
			 $res6['unit']=0;
}
		
		$unit6=$unit6+$res6['unit'];
		$p6=$res6['unit']*$res6['points'];
		$gp6=$gp6+$p6;
		}
		if($unit6 == 0){
		$gpa6 = 0;	
			}else{
				$gpa6 = $gp6/$unit6;
			}
		
		//cumulative for Sixth
			//previous cumulative
			
			$pcgp=$gp1+$gp2+$gp3+$gp4+$gp5;
			$pcu=$unit1+$unit2+$unit3+$unit4+$unit5;
			if ($pcgp== 0){
			$pcgpa = "0.00";	
				}else{
			$pcgpa=number_format(($pcgp/$pcu),2);
			//current cumulative
				}
			$ccgp=$gp1+$gp2+$gp3+$gp4+$gp5+$gp6;
			$ccu=$unit1+$unit2+$unit3+$unit4+$unit5+$unit6;
			$ccgpa= number_format(($ccgp/$ccu),2);
		
		
		
		
		}elseif($semester==1){
		
		
	$ssql1 = "SELECT * FROM results WHERE prog_id='$programme' && semester='1'  && matric_no='$matno'";
$sql1= mysqli_query($conn,$ssql1);


//first
		$unit1=0;
		$gp1=0;
		
		while ($res1=mysqli_fetch_assoc($sql1)){ 
		
		if (($res1['grade']=="SICK")||($res1['grade']=="ABSE")||($res1['grade']=="PEND")||($res1['grade']=="---")||($res1['grade']=="EM")||($res1['grade'] =="MS")||($res1['grade']=="AE")||($res1['grade']=="PI")){
			 $res1['unit'] = 0;
}
		
		
		$unit1 = $unit1 + $res1['unit'];
		$p1 = $res1['unit']*$res1['points'];
		$gp1=$gp1+$p1;
		}
		if($unit1 == 0){
		$gpa1 = 0;	
			}else{
				$gpa1 = $gp1/$unit1;
			}

		//cumulative for first
			//previous cumulative
			
			$pcgp="000";
			$pcu="000";
			$pcgpa="000";
			//current cumulative
		
			$ccgp=$gp1;
			$ccu=$unit1;
					if($ccu == 0){
		$ccgpa = 0;	
			}else{

			$ccgpa= number_format(($ccgp/$ccu),2);
			}
		
	/*
			$ccgp="000";
			$ccu="000";
			$ccgpa="000";
*/	
		}
		?>
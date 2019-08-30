<?php //require("includes/header.php");?>

<div align="left">
  
          <?php 
	if(isset($_POST['Submit'])){
	
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
		location.replace("index.php?viewsco");
    </script>';
    //die("Empty fields not allowed!!!"."<a href='index.php?viewsco'><br>&lt;&lt;Back</a>");
	}
  
  
	$query= mysqli_query($logs,"SELECT * FROM course 
	WHERE prog_id='$programme' && semester	='$semester' && sessions = '$session'") 
  or die (mysqli_error());
  	
    switch ($semester) {
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
	
	include('title.php');
	
	echo"<br>CARRY OVER RESULTS";
	?>
        </div>
        <table id="t1" border="1" cellpadding="0" cellspacing="1" style=" border:thin; border-collapse:collapse; overflow-x:auto;" class="table table-hover">
	      <tr>
	        <td rowspan="2" ><div align="center" class="style2" style="font-weight: bold">S/N</div></td>
        <td rowspan="2" ><div align="center" class="style2" style="font-weight: bold">Matric_No</div></td>
      <?php while($row=mysqli_fetch_assoc($query)){  ?>  
			  <td rowspan="2"  style="width: 10px"><div align="center" class="style2" style="font-weight: bold"><?php echo $row['code']."<br>"."(".$row['unit'].")";?></div></td>
      <?php }?>
	        <td colspan="3" ><div align="center" class="style2" style="font-weight: bold">Current_Semester </div></td>
        <td colspan="3" ><div align="center" class="style2" style="font-weight: bold">Previous_Semester </div></td>
        <td colspan="3" ><div align="center" class="style2" style="font-weight: bold">Current_Cumulative </div></td>
        <td colspan="5" ><div align="center" class="style2" style="font-weight: bold">REMARKS</div></td>
      </tr>
	      <tr>
	        <td ><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td ><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td ><div align="center" class="style1" style="font-weight: bold">co</div></td>
        <td ><div align="center" class="style1" style="font-weight: bold">EM</div></td>
        <td ><div align="center" class="style2 style2" style="font-weight: bold">Sit</div></td>
        <td ><div align="center" class="style2 style2" style="font-weight: bold">Pend</div></td>
        <td ><div align="center"><span class="style1"><span class="style1"><span class="style2"><span class="style2"></span></span></span></span></div></td>
      </tr>
        <?php $n = $start; 
        
$msql=mysqli_query($logs,"SELECT * FROM `studentsnm` WHERE 
prog_id ='$programme'&&  year='$year' && `stat`='2' && Withdrwan ='0'
ORDER BY length(matno),matno ASC") or die(mysqli_error());

while ($col=mysqli_fetch_assoc($msql)){
$n= $n+1;
 ?>
	      <tr>
	        <td><?php echo $n;?></td>
            <td><?php echo $col['matno'];?></td>
    <?php 
		$matno = $col['matno'];
    $sql= mysqli_query($logs,"SELECT * FROM results WHERE 
		prog_id='$programme' && semester='$semester' && matric_no='$matno'") 
		or die (mysqli_error($logs));
		
		$unit=0;
		$gp=0;
		$rem = 0;
		while ($res=mysqli_fetch_assoc($sql)){?>
	        <td>
	        <div align="center">
	        <?php
	    $ssql= mysqli_query($logs, "SELECT * FROM prev_results 
      WHERE prog_id='$programme' && semester='$semester'  && matric_no='$matno'") or die(mysqli_error($logs));    
	    $wr = mysqli_fetch_assoc($ssql);
	    
			if ($res['code']==$wr['code']){
			echo " <u style='color:red; font-weight:bold'>".$res['grade']."</u>";
			//echo ;
			}else{ 
			echo $res['grade'];
					 }
?>
	        </div></td>
		  <?php
		  		  // do not count the unit of unknown grades
	if (($res['grade']=="SICK")||($res['grade']=="ABSE")||($res['grade']=="PEND")||($res['grade']=="---")||($res['grade'] =="EM")||($res['grade']=="AE")||($res['grade']=="PI")){
			 $res['unit']=0; 
			  } 

		$unit=$unit+$res['unit'];
		$p=$res['unit']*$res['points'];
		$gp=$gp+$p;
		}
		if ($unit==0){
		$gpa= 0;	
			}else{
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
            <td><div align="center"><?php echo $ccgpa;?></div></td>
            <td colspan=4></td>
            <td><div align="center"> <?php include("includes/rmk.php"); ?>  </div></td>
          </tr><?php }?>
        </table>     

  <table align="center">
    <tr>
      <td align="left">
      
      <form id="form1" name="form1" method="post" action="">
          
          <input name="semester" type="hidden" id="semester" value="<?php echo $semester;?>" />
          <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
          <input name="year" type="hidden" id="year"  value="<?php echo $year;?>"/>
          <input name="programme" type="hidden" id="programme"  value="<?php echo $programme;?>"/>
          <input name="start" type="hidden" id="start"  value="<?php echo $start-20;?>"/>
          <input name="list" type="hidden" id="list"  value="<?php echo $list;?>"/>
          <input type="submit" name="Submit" value="&lt;&lt;&lt;" />
      </form>      </td>
      <td align="left"><form id="form2" name="form2" method="post" action="">
          
          <input name="semester" type="hidden" id="semester" value="<?php echo $semester;?>" />
          
          <input name="session" type="hidden" id="session"  value="<?php echo $session;?>"/>
          <input name="year" type="hidden" id="year"  value="<?php echo $year;?>"/>
          <input name="programme" type="hidden" id="programme"  value="<?php echo $programme;?>"/>
          <input name="start" type="hidden" id="start"  value="<?php echo $start+20;?>"/>
          <input name="list" type="hidden" id="list"  value="<?php echo $list;?>"/>
          
          <input type="submit" name="Submit" value="&gt;&gt;&gt;" />
          
          </form>      
      </td>
    </tr>
  </table>

  <?php 
  exit; }
	?>
    
    <hr>VIEW CARRY OVER RESULTS SUMMARY <hr>

<hr>
<br>
<?php
 include("viewforms.php");
 ?>  
<br><hr>
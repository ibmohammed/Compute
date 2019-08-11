<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "logins.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php include("includes/header1.php");?>
    <table width="80%" align="center" >
      <tr>
        <td><img src="header1.png" width="100%" height="80" /></td>
      </tr>
    </table>
    <table width="80%" align="center" >
      <tr>
        <td bgcolor="#4F81BD"><marquee behavior="alternate">
          <strong style="color:#FF0000;">Nipoly Consult........</strong>
          </marquee>
          <!-- #BeginDate format:Am1a -->February 2, 2016 8:31 AM<!-- #EndDate --></td>
      </tr>
    </table>
    <table width="80%" border="0" align="center">
  <tr>
    <td>
	<?php
if(isset($_POST['Submit2'])){
	$programme=$_POST['programme'];
	$year=$_POST['year'];
	$session=$_POST['session'];
	$semester=$_POST['semester'];
	$name= $_POST['name'];
	$matno= $_POST['matno'];
	$count = $_POST['count'];
	$count=$count-1;
	$m=0;
	while($m<=$count){
$m=$m+1;
$scr= "score".$m;
$score = $_POST[$scr];
$s = "sn".$m;
$sn = $_POST[$s];
include("includes/scoregrade.php");
$point = $n[$grade1];
$un="unit".$m;
$unit=$_POST[$un];
$cod="code".$m;
$code = $_POST[$cod];
$query=mysql_query("UPDATE  `consultdbsnw`.`results` SET  `code`='$code',`unit`='$unit',`score` =  '$score',`grade` =  '$grade1',`points`='$point' WHERE  `results`.`sn` ='$sn'");
if(!$query){
die(mysql_error());
}
}
echo "<script language = 'javascript'>"."alert('Records updated')"."</script>";
echo "<font color = 'red'><i>"."Records Updated"."</i></font>";

// Display Student List ?>

<table border="1">
            <tr bgcolor="#000033">
              <td><span class="style2">Id</span></td>
              <td><span class="style2">Name</span></td>
              <td><span class="style2">MatricNo</span></td>
              <td><span class="style2">Department</span></td>
              <td><span class="style2">Session</span></td>
              <td bgcolor="#CCCCCC"><span class="style7">Year</span></td>
              <td><span class="style2">STATUS</span></td>
              <td><span class="style2">EDIT</span></td>
            </tr>
			<?php
	//$programme=$_POST['programme'];
	
	
			$dept = $_POST['programme'];
			//$year=$_POST['year'];
			//$session=$_POST['session'];
			$sql=mysql_query("SELECT *FROM `studentsnm` WHERE dept = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC");
			$n=0;
			 while ($row=mysql_fetch_array($sql)){
			 $n=$n+1;
			 ?>
            <tr>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $n;?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['names'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['matno'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['dept'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['session'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['year'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1">
                <?php
				$status=$row['Withdrwan']; 
			  if($status==0){
				  echo "Active";
			  }elseif($status==1){
					  echo "<font color='#FF0000'>In_Active</font>";
				  }?>
              </span></td>
              <td bgcolor="#CCCCCC"><a href="edittest.php?id=<?php echo $row['sn']."&"."semester=".$semester."&"."programme="."$dept"."&"."year="."$year"."&"."session="."$session"."& Submit="."Submit". "& matno=".$row['matno'];?>" class="style1">EDIT</a></td>
            </tr><?php  }?>
      </table>



	<?php }
?>
	
	<?php
	 if(isset($_POST['button'])){
	// show all pages
	
	$programme=$_POST['programme'];
	$session=$_POST['session'];
	$year=$_POST['year'];
	$semester=$_POST['semester'];
	//add session 
	$_SESSION['programme'] = $programme;
	$_SESSION['session'] = $session;
	$_SESSION['year'] = $year;
	$_SESSION['semester'] = $semester;
	
	// show students data?>
	
	<table border="1">
            <tr bgcolor="#000033">
              <td><span class="style2">Id</span></td>
              <td><span class="style2">Name</span></td>
              <td><span class="style2">MatricNo</span></td>
              <td><span class="style2">Department</span></td>
              <td><span class="style2">Session</span></td>
              <td bgcolor="#CCCCCC"><span class="style7">Year</span></td>
              <td><span class="style2">STATUS</span></td>
              <td><span class="style2">EDIT</span></td>
            </tr>
			<?php
			$dept = $_POST['programme'];
			$year=$_POST['year'];
			$session=$_POST['session'];
			$sql=mysql_query("SELECT *FROM `studentsnm` WHERE dept = '$dept' && year ='$year' && session='$session'  ORDER BY `matno` ASC");
			$n=0;
			 while ($row=mysql_fetch_array($sql)){
			 $n=$n+1;
			 ?>
            <tr>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $n;?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['names'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['matno'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['dept'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['session'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1"><?php echo $row['year'];?></span></td>
              <td bgcolor="#CCCCCC"><span class="style1">
                <?php
				$status=$row['Withdrwan']; 
			  if($status==0){
				  echo "Active";
			  }elseif($status==1){
					  echo "<font color='#FF0000'>In_Active</font>";
				  }?>
              </span></td>
              <td bgcolor="#CCCCCC"><a href="edittest.php?id=<?php echo $row['sn']."&"."semester=".$semester."&"."programme="."$dept"."&"."year="."$year"."&"."session="."$session"."& Submit="."Submit". "& matno=".$row['matno'];?>" class="style1">EDIT</a></td>
            </tr><?php  }?>
          </table>
	
    
    
    
	
	 <?php }elseif(isset($_GET['Submit'])){
	$programme=$_GET['programme'];
	$session=$_GET['session'];
	$year=$_GET['year'];
	$semester=$_GET['semester'];
	$matno=$_GET['matno'];
	$query=mysql_query("SELECT * FROM `course` WHERE programme ='$programme' && semester = '$semester'");
	$sql=mysql_query("SELECT * FROM `studentsnm` WHERE matno='$matno'");
	$row=mysql_fetch_array($sql);

	
	?>
	
	<table border="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table border="0">
        <tr>
          <td bgcolor="#999999"><span style="font-weight: bold">Name:</span></td>
          <td bgcolor="#999999"><input name="name" type="text" id="name" value="<?php echo $row['names'];?>" size="40" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#999999"><span style="font-weight: bold">MatricNo:</span></td>
          <td bgcolor="#999999"><input name="matno" type="text" id="matno"  value="<?php echo $row['matno'];?>"/>
          </td>
        </tr>
      </table>
        <table border="0">
          <tr>
            <?php 
				$msql=mysql_query("SELECT * FROM  `results` WHERE matric_no='$matno' && semester='$semester'");
if(!$msql){
die(mysql_error());}

			$n=0; 
						while (($col= mysql_fetch_array($query)) && ($rows = mysql_fetch_array($msql))){
			 $n=$n+1;
			 ?><td bgcolor="#999999"><span style="color: #000000; font-weight: bold"><?php echo $col['code']."<br>";?>
			    
			    <input name="<?php echo'sn'.$n;?>" type="hidden" id="sn" value="<?php echo $rows['sn'];?>" />
			    <input name="<?php echo'score'.$n;?>" type="text" value="<?php echo $rows['score'];?>" size="4">
				<input name="<?php echo'unit'.$n;?>" type="hidden" value="<?php echo $col['unit'];?>" size="4">
				<input name="<?php echo'code'.$n;?>" type="hidden" value="<?php echo $col['code'];?>" size="4">
			 </span></td>
            <?php }?>
          </tr>
        </table>
        <input name="count" type="hidden" id="count" value="<?php echo $n;?>" />
       
        <input type="submit" name="Submit2" value="Submit" />
        <input type="hidden" name="programme"  value="<?php echo $programme;?>"/>
        <input type="hidden" name="session"  value="<?php echo $session;?>"/>
        <input type="hidden" name="semester"  value="<?php echo $semester;?>"/><input type="hidden" name="year"  value="<?php echo $year;?>"/>
    </form>
    </td>
  </tr>
</table>

	<table width="70%" border="0">
      <tr>
        <td>{<a href="index.php">Home</a>}{<a href="editresults.php">Back</a>}</td>
      </tr>
    </table>
	<?php 
	exit;
	}
	
	?>
	
	</td>
  </tr>
</table>
    <table>
      <tr>
        <td><form action="" method="get" name="grade" id="grade">
          <strong>EDIT INDIVIDUAL RESULTS</strong>
          <table style="text-align: left;color:blue;">
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">PROGRAMME:</span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
              <select name="programme" id="programme">
                <option selected="selected"></option>
                  <?php
			include('prog1.php');
			include('prog2.php');
			include('prog3.php');
			 ?>
                <?php // include("includes/optionsc.php"); ?>
              </select>
              </span> </td>
            </tr>
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">MATRIC NUMBER: </span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
              <input type="text" name="matno" /></span></td>
            </tr>
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">SESSION:</span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
              <select name="session">
                  <?php echo include('includes/sessions.php');?>
                  
              </select>
              -          
              <select name="year" id="year">
                <option selected="selected"></option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
              </select>
              </span></td>
            </tr>
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">SEMESTER:</span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
              <select name="semester">
                <option selected="selected"></option>
                <option value="1">First Semester</option>
                <option value="2">Second Semester</option>
                <option value="3">Third Semester</option>
                <option value="4">Fourth Semester</option>
                <option value="5">Fifth Semester</option>
                <option value="6">Sixth Semester</option>
              </select>
              </span></td>
            </tr>
          </table>
          <input name="Submit" value="Submit" type="submit" />
          <br />
        </form></td>
      </tr>
      <tr>
        <td><form id="form2" name="form2" method="post" action="">
          <strong>EDIT RESULTS</strong>
          <table style="text-align: left;color:blue;">
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">PROGRAMME:</span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
                <select name="programme" id="programme2">
                  <option selected="selected"></option>
                  <?php
			include('prog1.php');
			include('prog2.php');
			include('prog3.php');
			 ?>
                  <?php // include("includes/optionsc.php"); ?>
                </select>
              </span></td>
            </tr>
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">SESSION:</span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
                <select name="session" id="session">
                  <?php echo include('includes/sessions.php');?>
                </select>
                -
                <select name="year" id="year2">
                  <option selected="selected"></option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td bgcolor="#999999"><span style="font-weight: bold">SEMESTER:</span></td>
              <td bgcolor="#999999"><span style="font-weight: bold">
                <select name="semester" id="semester">
                  <option selected="selected"></option>
                  <option value="1">First Semester</option>
                  <option value="2">Second Semester</option>
                  <option value="3">Third Semester</option>
                  <option value="4">Fourth Semester</option>
                  <option value="5">Fifth Semester</option>
                  <option value="6">Sixth Semester</option>
                </select>
              </span></td>
            </tr>
          </table>
          <input type="submit" name="button" id="button" value="Submit" />
        </form>&nbsp;</td>
      </tr>
    </table>
    <table width="80%" border="0" align="center">
  <tr>
    <td>{<a href="index.php">Home</a>}</td>
  </tr>
</table>

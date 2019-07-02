<?php include("includes/header.php"); ?>    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Delete Records</title>
</head>

<body>

<?php 

if(isset($_POST['Submit'])){ 
	
	
//			$ccode=$_POST['code'];
			$semester=$_POST['semester'];
			$session=$_POST['session'];
			$year=$_POST['year'];
			$programme=$_POST['programme'];
			
			$programme = mysql_escape_string($programme);
			
			$nsemester = ($semester - 1);

			$sql= mysql_query("DELETE FROM `results` 
			WHERE `programme` = '$programme'  && `semester` ='$semester' && `session`= '$session' ") 
			or die ('Err'.mysql_error());


			$sqls = mysql_affected_rows();
		

if($sqls !== 0){

					// Select Records entered to enable Delete 

					$qry = mysql_query("SELECT * FROM `entered` WHERE 
					`programme` = '$programme' && `session` = '$session' && `semester` = '$semester'") 
					or die('selqry'.mysql_error());

					 
while($fid = mysql_fetch_array($qry)){

					$eid = $fid['sn'];

					// Query to dalete Records Selected

					$delqry = mysql_query("DELETE FROM `entered`  `entered` WHERE `sn` = '$eid' ") or die('delqry'.mysql_error());

				}
					echo "<div style='color:green; font-style:italic;'>";
					echo $semester." Records Deleted Successfully<br/>";

					// Update Student Status 
	

/*	$query = mysql_query("UPDATE  `studentsnm` SET status = '$nsemester' 
					WHERE matno='$matno'") 
					or die(mysql_error());

if ($query){
 
				echo $matno." Data Updated Successfully<br/>";
				echo "</div>";
		}


			}else{

					echo "records not deleted for Semester ". $semester."<br/>";

				}

*/

	} 

	}
?>




<form action="" method="post" name="grade" id="grade">
      <div class="auto-style1">
      <table align="center">
        <tr>
          <td align="left"><strong>PROGRAMME:</strong></td>
          <td align="left"><select name="programme" id="programme">
            <option selected="selected"><?php // echo $_GET['depts'];?></option>
			
			
			
			 <?php include('dptcode.php') ;
            
            
            //$queri = mysql_query("SELECT * FROM `dept` WHERE 
            //prog = '$departmentcode'  && `dep` LIKE '%National Diploma%'") or die(mysql_error());
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE 
            prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option selected="selected"><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
                        
          </select>
          
          </td>
        </tr>
        <tr>
          <td align="left"><strong>SEMESTER:</strong></td>
          <td align="left"><select name="semester">
            <option selected="selected"></option>
            <option value="1">First Semester</option>
            <option value="2">Second Semester</option>
            <option value="3">Third Semester</option>
            <option value="4">Fourth Semester</option>
            <option value="5">Fifth Semester</option>
            <option value="6">Sixth Semester</option>
          </select></td>
        </tr>
        <tr>
          <td align="left"><strong>SESSION:</strong></td>
          <td align="left"><select name="session">
          <option selected="selected"></option>
          <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
                     <?php echo include('includes/sessions.php');?>

            </select>
            -
            <select name="year" id="year">
              <option selected="selected" ></option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
              <option>13</option>
              <option>14</option>
              <option>15</option>
              <option>16</option>
                 <?php 
                         for($i = 2017; $i<=2020; $i++){
                         
                         echo "<option>".$i."</option>";
                         }
                         ?>
            </select>
            <input  type="hidden" name="start" value="0" />
          <input type="hidden" name="list" value="20" /></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
          </table>
      <input name="Submit" value="Submit" type="submit" />

  </div>

  </form>
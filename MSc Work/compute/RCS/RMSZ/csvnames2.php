<?php  
if(isset($_POST['Submit'])){



//connect to the database 
$connect = mysql_connect("localhost","root","");
mysql_select_db("consultdbsnw",$connect); //select the table 
// 



if ($_FILES['csv']['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    // $programme=$_POST['programme'];
//	
	//$session=$_POST['session'];
	//$semester=$_POST['semester'];

     			//$code = $_POST['ccodes'];
//				$semst = $_POST['semester'];
				$sesn = $_POST['session'];
				$prgrm = $_POST['programme'];
				
$prgrm = mysql_escape_string($prgrm);
				
				$year=$_POST['year'];
		
    //loop through the csv file and insert into database
    
    do { 
        if ($data[0]) { 
           
		    	$smatno = $data[1];
				$names = $data[0];

				$names = mysql_escape_srting($names);
				
				
		// check if students records exist 
				
				$snms = mysql_query("SELECT `names` FROM `studentsnm` WHERE `matno` = '$smatno'");

				$numrows = mysql_num_rows($snms);

				
				//if($numrows == 0){
				
			//	

			//	$point = $n[$grade1];
				mysql_query("INSERT INTO `consultdbsnw`.`studentsnm`  
				(`names`, `matno`, `dept`, `year`, `session`, `sex`) 
				VALUES( 
                    '".addslashes($names)."',
                    '".addslashes($data[1])."',
                    '".addslashes($prgrm)."',
                    '".addslashes($year)."',
                    '".addslashes($sesn)."',
					'".addslashes($data[2])."'

				   ) ON DUPLICATE KEY UPDATE
				    `names` = '".addslashes($names)."', 
				    `matno` = '".addslashes($data[1])."', 
				    `dept` = '".addslashes($prgrm)."', 
				    `year` = '".addslashes($year)."', 
				    `session` = '".addslashes($sesn)."', 
				    `sex` = '".addslashes($data[2])."'
				    
            ") or die(mysql_error()); 
            
           /*}
           else{
           
  echo          
header('Location: index.php?csvn'."&fail=1"."&year=".$year."&prog=".$prgrm."&sessn=".$sesn); die;            
           
           }*/
        } 
        
        
    } while ($data = fgetcsv($handle,1000,",","'"));
    
    //redirect 
    
     
echo "Student Records Imported";//  header('Location: index.php?csvn'."&pass=1"); die; 



} 

}


// ending ---------

//Begining --------

//connect to the database 
$connect = mysql_connect("localhost","root","");
mysql_select_db("consultdbsnw",$connect); //select the table 
// 

?>


<form id="form1" action="" enctype="multipart/form-data" method="post" name="form1">


    <table style="width: 60%">
		<tr>
          <td style="height: 30px" ><span style="font-weight: bold; color: #000000">PROGRAMME:</span></td>
          <td style="height: 30px" ><select name="programme" id="programme">
         			<option selected="selected"></option>
         			
         			 <?php include('dptcode.php') ;
            
            
            $queri = mysql_query("SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysql_error());
            
            while($pcd = mysql_fetch_array($queri)){
            ?>
            
            
              <option><?php echo $pcd['dep'];?></option>
              
              <?php }?>
              
             
          </select> </td>
        </tr>
		<tr>
			<td><span style="font-weight: bold; color: #000000">SESSION:</span></td>
			<td>  &nbsp;<select name="session">
          <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                    <?php echo include('includes/sessions.php');?>

          </select><select name="year" id="year">
            <option selected="selected"></option>
			<option>9</option>
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
          </select></td>
		</tr>
		<tr>
			<td>Choose your file:</td>
			<td>  <input name="csv" type="file" id="csv" /></td>
		</tr>
	</table>
	<input name="Submit" type="submit" value="Submit"> 
</form>
 

<?php if (!empty($_GET['pass'])) { 
echo "<b>Your file has been imported.</b><br><br>"; 
} //generic success notice 
elseif (!empty($_GET['fail'])) {
echo "<b>This records cannot be enttered twice, please goto Edit Records.</b><br><br>"; 

$year = $_GET['year'];
//$semst = $_GET['sem'];
$prgrm = $_GET['prog'];
$sesn = $_GET['sessn'];
echo "<hr>";
echo "<p>Existing Records for class of: ".$year." </p>";
echo "<hr>";
echo "<hr>";
echo "<br>";
$sql = mysql_query("SELECT * FROM `studentsnm` WHERE 
	`year` = '$year' && `dept`= '$prgrm' && `session`= '$sesn' ") or die(mysql_error());
	
	echo "<table style='width: 100%'>";
	echo "<tr>		 <td>Name</td>		 <td>Matno</td>	 </tr>";

while($rows = mysql_fetch_array($sql)){	 

echo "<tr><td>".$rows['names']."</td><td>".$rows['matno']."</td></tr>";
	 }
echo "</table>";

echo "<br>";
echo "<hr>";

}


?> 

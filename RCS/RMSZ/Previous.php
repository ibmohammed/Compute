<?php include("includes/header.php"); ?>
<?php 
if (isset($_POST['Submit'])){
  $prog = $_POST['programme'];
  $matno = $_POST['matno'];
  $semester = $_POST['semester'];
  $year = $_POST['year'];
  $coresults = mysql_query("SELECT * FROM coresult WHERE matric_no = '$matno' && programme = '$prog' && semester = '$semester'&& year = '$year'") or die(mysql_error());
	$col = mysql_fetch_assoc($coresults);
	?>
	
    
      <table width="70%" align="center" >
        <tr>
          <td><img src="header1.png" width="100%" height="80" /></td>
        </tr>
        <tr>
          <td><a href="index.php">Home</a></td>
        </tr>
      </table>
      <div align="center">
      <table width="450" border="1">
  <tr>
    <td width="117" bgcolor="#D6D6D6"><strong>Name:</strong></td>
    <td width="317" colspan="2" bgcolor="#FFFFFF"><strong><?php echo $col['name'];?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#D6D6D6"><strong>MatricNumber:</strong></td>
    <td colspan="2" bgcolor="#FFFFFF"><strong><?php echo $col['matric_no'];?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#D6D6D6"><strong>Semester/Session:</strong></td>
    <td colspan="2" bgcolor="#FFFFFF"><strong><?php echo "Semester:".$col['semester']."--".$col['session'];?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#D6D6D6"><strong>Department:</strong></td>
    <td colspan="2" bgcolor="#FFFFFF"><strong><?php echo $col['programme'];?></strong></td>
  </tr>
  <tr class="centr">
    <td align="center" bgcolor="#FFFFCC"><strong>Course Code</strong></td>
    <td align="center" bgcolor="#FFFFCC"><strong>Score</strong></td>
    <td align="center" bgcolor="#FFFFCC"><strong>Grade</strong></td>
    </tr>
  <?php 
  $coresults = mysql_query("SELECT * FROM coresult WHERE matric_no = '$matno' && programme = '$prog' && semester = '$semester'&& year = '$year'") or die(mysql_error());
while($row = mysql_fetch_assoc($coresults)){
  ?>
  <tr>
    <td align="center"><?php echo  $row['code'];?></td>
    <td align="center"><?php echo  $row['score'];?></td>
    <td align="center"><?php echo  $row['grade'];?></td>
    </tr>
  <?php }?>
</table>
<?php exit; }

?>
<table width="70%" align="center" >
        <tr>
          <td><img src="header1.png" width="100%" height="80" /></td>
        </tr>
        <tr>
          <td><a href="index.php">Home</a></td>
        </tr>
      </table>
<form action="" method="post" name="grade" id="grade">
    <div align="left">
    <div align="center">  <table>
        <tr>
          <td align="left"><strong>PROGRAMME:</strong></td>
          <td align="left"><select name="programme" id="programme">
            <?php
			include('prog1.php');
			include('prog2.php');
			include('prog3.php');
			 ?>
          </select></td>
        </tr>
        <tr>
          <td align="left"><strong>SEMESTER:</strong></td>
          <td align="left"><select name="semester" id="semester">
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
          <td align="left"><strong>MatricNumber:</strong></td>
          <td align="left"><input type="text" name="matno" id="matno" /></td>
        </tr>
        <tr>
          <td height="39" align="left"><strong>SESSION:</strong></td>
          <td align="left">
          <select name="year">
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
            </select>
            </td>
        </tr>
      </table>
      <input name="Submit" value="Submit" type="submit" />
  </div>
</form>
</div>
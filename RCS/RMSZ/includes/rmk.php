<style>
.tdclm{
	width:100px;
	font-family:"Times New Roman", Times, serif;
	font-size:xx-small;

	
	}
</style>
  <?php
		include("includes/co.php");
		 while($row=mysqli_fetch_assoc($sql)){
echo $row['code'].", ";}
include("includes/ABS.php");
		while($row=mysqli_fetch_assoc($sqlm)){
echo $row['code'].", ";}?>
        </div></td>
        <td bgcolor="#FFFFFF" style="font-size:8px;"><div align="center" class="style1">
          <?php
		include("includes/EM.php");
		 while($row=mysqli_fetch_assoc($sql)){
echo $row['code'].", ";}?>
        </div></td>
        <td bgcolor="#FFFFFF" style="font-size:8px;"><div align="center" class="style1">
          <?php 
		include("includes/AE.php");
		while($row=mysqli_fetch_assoc($sql)){
echo $row['code'].", ";}

include("includes/sitting.php");
		while($row=mysqli_fetch_assoc($sql)){
echo $row['code'].", "." ";}
include("includes/sick.php");
		while($row=mysqli_fetch_assoc($query)){
echo $row['code'].", ";}
?>
        </div></td>
        <td bgcolor="#FFFFFF" style="font-size:8px;"><div align="center" class="style1">
          <?php 
		include("includes/pend.php");
		while($row=mysqli_fetch_assoc($sql)){
echo $row['code'].", ";}?>
        
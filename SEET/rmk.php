<style>
.tdclm{
	width:100px;
	font-family:"Times New Roman", Times, serif;
	font-size:xx-small;

	
	}
</style>
  <?php
		include("includes/co.php");
		 while($row=mysql_fetch_array($sql)){
echo $row['code'].", ";}
include("includes/ABS.php");
		while($row=mysql_fetch_array($sqlm)){
echo $row['code'].", ";}?>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style1">
          <?php
		include("includes/EM.php");
		 while($row=mysql_fetch_array($sql)){
echo $row['code'].", ";}?>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style1">
          <?php 
		include("includes/AE.php");
		while($row=mysql_fetch_array($sql)){
echo $row['code'].", ";}

include("includes/sitting.php");
		while($row=mysql_fetch_array($sql)){
echo $row['code'].", "." ";}
include("includes/sick.php");
		while($row=mysql_fetch_array($query)){
echo $row['code'].", ";}
?>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="center" class="style1">
          <?php 
		include("includes/pend.php");
		while($row=mysql_fetch_array($sql)){
echo $row['code'].", ";}?>
        
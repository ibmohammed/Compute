<tr>
	        <td rowspan="2" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">S/N</div></td>
        <td rowspan="2" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Matric_No</div></td>
      <?php 
	  $querys= mysql_query("SELECT * FROM course WHERE programme='$programme' && semester	='$semester'");
	  while($rows=mysql_fetch_array($querys)){  ?>  <td rowspan="2" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold"><?php echo $rows['code']."<br>"."(".$rows['unit'].")";?></div></td>
      <?php }?>
	        <td colspan="3" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Current_Semester </div></td>
        <td colspan="3" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Previous_Semester </div></td>
        <td colspan="3" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">Current_Cumulative </div></td>
        <td colspan="5" bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">REMARKS</div></td>
      </tr><tr>
	        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">cr</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gp</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2" style="font-weight: bold">gpa</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style1" style="font-weight: bold">co</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style1" style="font-weight: bold">EM</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2 style2" style="font-weight: bold">Sit</div></td>
        <td bgcolor="#CCCCFF"><div align="center" class="style2 style2" style="font-weight: bold">Pend</div></td>
        <td bgcolor="#CCCCFF"><div align="center"><span class="style1"><span class="style1"><span class="style2"><span class="style2"></span></span></span></span></div></td>
      </tr>
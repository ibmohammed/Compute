<tr >
      <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"><span style="color: #000000">S/N</span></div></td>
      <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"><span style="color: #000000">MATRIC No.</span></div></td>
      <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold"><span style="color: #000000">NAMES</span></div></td>
	  <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold">Student<br /> 
      Signature. </div></td>
	  <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold">BookletNo.</div></td>
	  <?php 
	  $code = mysql_query("SELECT * FROM `course` WHERE programme LIKE '$cid' AND semester = '$smtr'");
	  if(!$code){
	  die ("Query Selection failed".mysql_error());
	  }
	 
	  ?>
    
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </span>
      <div align="center" style="font-size: x-small; font-weight: bold">1</div></td>
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
      <div align="center" style="font-size: x-small; font-weight: bold">2</div></td>
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
      <div align="center" style="font-size: x-small; font-weight: bold">3</div></td>
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
      <div align="center" style="font-size: x-small; font-weight: bold">4</div></td>
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
      <div align="center" style="font-size: x-small; font-weight: bold">5</div></td>
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
      <div align="center" style="font-size: x-small; font-weight: bold">6</div></td>
	  <td rowspan="2" id = 'page'><span class="style6" style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </span>
      <div align="center" style="font-size: x-small; font-weight: bold">7</div></td>
	  <td colspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold">EXAMS</div></td>
	  <td rowspan="2" id = 'page'><p align="center" style="font-size: x-small; font-weight: bold">CA</p>
      <p align="center" style="font-size: x-small; font-weight: bold">40%</p></td>
	  <td rowspan="2" id = 'page'><p align="center" style="font-size: x-small; font-weight: bold">TOTAL</p>
      <p align="center" style="font-size: x-small; font-weight: bold">100%</p></td>
	  <td rowspan="2" id = 'page'><div align="center" style="font-size: x-small; font-weight: bold">REMARKS</div></td>
    </tr>	
        <tr  bgcolor = '' >
      <td id = 'page'><span style="font-size: x-small; font-weight: bold">100%</span></td>
      <td id = 'page'><span style="font-size: x-small; font-weight: bold">60%</span></td>
    </tr>
   
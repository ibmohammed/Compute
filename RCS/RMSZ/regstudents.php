<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require('includes/header.php');    ?>
    


  <?php 	
    if (isset($_POST['Submit']))
    {

      $image=$_FILES["file"]["name"];
      $sname=$_POST['sname'];
      $sname = mysqli_escape_string($conn,$sname);
      $sex=$_POST['sex'];
      $cid=$_POST['programme'];
      $hpro = $_POST['hpro'];
      $cid = mysqli_escape_string($conn,$cid);
      $mat=$_POST['mat'];
      $ric=$_POST['ric'];
      $no=$_POST['no'];
      $sess=$_POST['session'];
      $matricno = $mat."/".$ric."/".$no;
  ?>
  <?php
      // check if record exist
      $sql=mysqli_query($conn,"SELECT *FROM `studentsnm`WHERE `matno` = '$matricno'AND `prog_id` = '$cid'");
      if(!$sql){
       die(mysqli_error($conn));
      }
      $col =mysqli_fetch_assoc($sql);
      if (($matricno==$col['matno'])&&($cid==$col['prog_id'])){
          echo "<script language = 'javascript'>"."alert('record already Exist')"."</script>";
      }else{
        $stdnm=mysqli_query($conn,"INSERT INTO studentsnm (names, matno, prog_id, year, images, session, status, stat, Withdrwan, sex) 
        VALUES ('$sname', '$matricno', '$cid', '$ric','$image','$sess','0','0','0','$sex')") or die(mysqli_error($conn));
        
        
              $pp = "0000";
							$stat = "Enable";
							
				 
          mysqli_query($conn, 	"INSERT INTO `students_log` 
					(`matric_no`,`password`,`status`) 
					VALUES( '".addslashes($matricno)."', '".addslashes($pp)."', '".addslashes($stat)."')") or die(mysqli_error($conn));
          

        echo "<script language = 'javascript'>"."alert('Successful')"."</script>";
        echo "<h5 style = 'color:red'>Record added Successfully <h5>";

      }
      
  ?>
<!--/*
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="MM_validateForm('sname','','R','mat','','R','ric','','R','no','','R','mat','','R','ric','','R','no','','R');return document.MM_returnValue">
  <div align="center"><strong>STUDENTS RECORD FORM </strong></div>
  <table class="table table-bordered" width="100%" align="center">
        
     <tr>
          <td align="left" ><strong>LOAD IMAGE: </strong></td>
          <td align="left" ><input name="file" type="file" id="file" />
            <span class="style3">*</span>
          </td>
      </tr>
     
      <tr>
          <td align="left" ><strong>PROGRAMME:</strong></td>
          <td align="left" >
           <select name="programme" id="programme" class="form-control">
            
           
              <input type = "text" value="<?php //echo @$_POST['programme'];?>" name="programme" class="form-control">
              <?php 
              //include('dptcode.php') ; 
             // $qri = mysqli_query($conn, "SELECT * FROM programmes WHERE prog_id=''") or die(mysqli_error($conn));
              //progs_function($logs, $_POST['programme']); 
            //  $prgss = mysqli_fetch_assoc($qri);
              ?>


              <input type = "text" value="<?php //echo $prgss['programme'];?>" class="form-control" name ="unknown">
    
            </select>
            <span style="color:red">*<?php //echo $prgss['programme'];?></span>
          </td>
      </tr>
      <tr>
          <td align="left" ><strong>STUDENT NAME:</strong></td>
          <td align="left" ><input name="sname" type ="text" id="sname"  class="form-control"/>
            <span class="style3">*</span>
          </td>
      </tr>

      <tr>
          <td align="left" ><strong>GENDER:</strong></td>
          <td align="left" >
            <select name="sex" id="sex" class="form-control">
            <option selected="selected"></option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
            <span class="style3">*</span>
          </td>
      </tr>

      <tr>
          <td align="left" ><p><strong>MATRIC NO.:</strong></p>
        
          </td>
          <td align="left" >
           
          <table class="table table-bordered">
               <tr>
               <td><input name="mat" id="mat" value="<?php //echo $mat;?>" size= "15" class="form-control" placeholder="NDCS"/>/</td>
              <td>  <input name="ric" id="ric" value="<?php //echo $ric;?>" size= "8" class="form-control" placeholder="015"/> / </td>
                <td>  <input name="no" id="no" value="" size= "8" class="form-control" placeholder="098"/></td>
                <td> (eg. NDCS/015/098) <span style="color:red">*</span></td>
                </tr>
               </td>
               </table>
          
          
          </td>
      </tr>

      <tr>
          <td height="24" align="left" ><strong>SESSION:</strong></td>
          <td align="left" >
          <select name="session" id="session" class="form-control">
              <option selected="selected"><?php //echo $sess;?></option>
			          <?php //echo include('includes/sessions.php');?>

          </select>
            <span class="style3">*</span>
          </td>
        </tr>

  </table>
      <div align="center">
	          <input class="btn btn-gradient-primary mr-2" name="Submit" type="submit" id="Submit" value="Submit" />
        </div>
</form>
*/

	-->	  
  <?php //exit; 
}
?>
  



<form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="MM_validateForm('mat','','R','ric','','R','no','','R');MM_validateForm('sname','','R','mat','','R','ric','','R','no','','R','mat','','R','ric','','R','no','','R');return document.MM_returnValue">
      <div align="center"><strong>STUDENTS RECORD FORM </strong></div>

      <table class="table table-bordered">
           
        <tr>
               <td width="12%" align="left" ><strong> LOAD IMAGE:</strong></td>
               <td width="88%" align="left" ><input name="file" type="file" id="file" class="btn btn-gradient-primary mr-2"/></td>
            </tr>
            <tr>
                <td align="left" ><strong>PROGRAMME:</strong></td>
                <td align="left" ><span style="font-weight: bold">

                   <select name="programme" class="form-control" id="programme" class="form-control">            
                      <option selected="selected" value="">Select Programme</option>
                        <?php 
                          include('dptcode.php') ;           
                          $queri = prog_function($logs); 
                        while($prgasc = mysqli_fetch_assoc($queri))
                        {            
                        ?>
                            <option value="<?php echo $prgasc['prog_id'];?>">
                              <?php echo $prgasc['programme'];?>
                            </option>

                                <?php   
                          } 
                         
                          ?>
                  </select>
                </span> <span style="color:red">*</span>
                <input type="hidden" value="<?php //echo $prgn['programme'];?>" name="hpro">
                </td>
          </tr>

          <tr>
              <td align="left" ><strong>STUDENTNAME:</strong></td>
              <td align="left" >
                <input name="sname" type ="text" id="sname" size = "30" class="form-control" placeholder="Enter Student name"/> <span style="color:red">*</span></td>
          </tr>
          <tr>
              <td align="left" >
                <span style="font-weight: bold">GENDER:</span></td>
                  <td align="left" >
                  <select name="sex" id="sex" class="form-control">
                   <option selected="selected" value="">Select Gender</option>

                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
              <span style="color:red">*</span>
              </td>

            </tr>

            <tr>
               <td align="left" ><p><strong>MATRIC NO.:</strong></p></td>
               <td align="left" >



               <table class="table table-bordered">
               <tr>
               <td><input name="mat" id="mat" value="" size= "15" class="form-control" placeholder="NDCS"/>/</td>
              <td>  <input name="ric" id="ric" value="" size= "8" class="form-control" placeholder="015"/> / </td>
                <td>  <input name="no" id="no" value="" size= "8" class="form-control" placeholder="098"/></td>
                <td> (eg. NDCS/015/098) <span style="color:red">*</span></td>
                </tr>
               </td>
               </table>




                </td>
            </tr>

            <tr>
                <td height="24" align="left" ><strong>SESSION:</strong></td>
                <td align="left" >
                  <select name="session" id="session" class="form-control">
                  <option selected="selected" value="">Select Session</option>
                    <option><?php echo (date('Y')-1)."/".(date('Y')); ?></option>
                    <?php echo include('includes/sessions.php');?>

                  </select>  <span style="color:red">*</span>              
                </td>
            </tr>

      </table>
      
        <input class="btn btn-gradient-primary mr-2" name="Submit" value="Submit" type="submit" />
    
</form>
<p></p>
<br>
<p><a href="smanage.php?edits">Edit Students Records</a></p>
<br>

<p></p>
<hr>
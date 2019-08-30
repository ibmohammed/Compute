<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php //require('includes/header.php');    ?>
    


  <?php 	
    if (isset($_POST['Submit']))
    {

      $image = $_FILES["file"]["name"];
      $sname = $_POST['sname'];
      $sname = mysqli_escape_string($logs,$sname);
      $sex = $_POST['sex'];
      $cid = $_POST['programme'];
      $hpro = $_POST['hpro'];
      $cid = mysqli_escape_string($logs,$cid);
      $mat = $_POST['mat'];
      $ric = $_POST['ric'];
      $no = $_POST['no'];
      $sess = $_POST['session'];
      $matricno = $mat."/".$ric."/".$no;


      if ($cid == "" || $mat == "" || $sess == "" || $ric == "" || $no == "" || $sname == "" || $sex == "") 
      {
        echo '<script type="text/javascript">
        alert("Empty fields not allowed!!!");
        location.replace("index.php?regs");
        </script>';
        //die("Empty fields not allowed!!!"."<a href='index.php?views'><br>&lt;&lt;Back</a>");
      }

  ?>
  <?php
      // check if record exist
      $sql=mysqli_query($logs,"SELECT *FROM `studentsnm`WHERE `matno` = '$matricno'AND `prog_id` = '$cid'");
      if(!$sql){
       die(mysqli_error($logs));
      }
      $col =mysqli_fetch_assoc($sql);
      if (($matricno==$col['matno'])&&($cid==$col['prog_id'])){
          echo "<script language = 'javascript'>"."alert('record already Exist')"."</script>";
      }else{
        $stdnm=mysqli_query($logs,"INSERT INTO studentsnm (names, matno, prog_id, year, images, session, status, stat, Withdrwan, sex) 
        VALUES ('$sname', '$matricno', '$cid', '$ric','$image','$sess','0','0','0','$sex')") or die(mysqli_error($logs));
        
        $options = [
          'cost' => 11,
        ];
        $pp = "Eeasy0123";
      $stat = "Enable";
      $hash = password_hash($pp, PASSWORD_BCRYPT,  $options);
      	 
          mysqli_query($logs, 	"INSERT INTO `students_log` 
					(`matric_no`,`password`,`status`) 
					VALUES( '".addslashes($matricno)."', '".addslashes($pp)."', '".addslashes($stat)."')") or die(mysqli_error($logs));

        echo "<script language = 'javascript'>"."alert('Successful')"."</script>";
        echo "<h5 style = 'color:red'>Record added Successfully <h5>";

      }
}
?>


<form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="MM_validateForm('mat','','R','ric','','R','no','','R');MM_validateForm('sname','','R','mat','','R','ric','','R','no','','R','mat','','R','ric','','R','no','','R');return document.MM_returnValue">
      <div><strong>STUDENTS RECORD FORM </strong></div>

      <table class="table table-bordered">
           
        <tr>
               <td width="12%" ><strong> LOAD IMAGE:</strong></td>
               <td width="88%" ><input name="file" type="file" id="file" class="btn btn-gradient-primary mr-2"/></td>
            </tr>
            <tr>
                <td ><strong>PROGRAMME:</strong></td>
                <td ><span style="font-weight: bold">

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
              <td><strong>STUDENTNAME:</strong></td>
              <td>
                <input name="sname" type ="text" id="sname" size = "30" class="form-control" placeholder="Enter Student name"/> <span style="color:red">*</span></td>
          </tr>
          <tr>
              <td>
                <span style="font-weight: bold">GENDER:</span></td>
                  <td >
                  <select name="sex" id="sex" class="form-control">
                   <option selected="selected" value="">Select Gender</option>

                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
              <span style="color:red">*</span>
              </td>

            </tr>

            <tr>
               <td ><p><strong>MATRIC NO.:</strong></p></td>
               <td >



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
                <td ><strong>SESSION:</strong></td>
                <td>
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
<p><a href="index.php?edits">Edit Students Records</a></p>
<br>

<p></p>
<hr>
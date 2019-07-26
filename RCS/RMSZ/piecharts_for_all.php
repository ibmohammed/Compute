<?php

if (!isset($_SESSION))
{
  session_start();
  require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');
}


if(isset($_POST["Submit1"]))
{
    //$course_code = $_POST[""];
    $semester = $_POST["semester"];
    $session = $_POST["session"];
    $programme = $_POST["programme"];

    $ccccc = mysqli_query($logs,"SELECT * FROM course 
                            WHERE 
                            `prog_id` = '$programme' &&   
                            `semester` = '$semester' && 
                            `sessions` = '$session'
                            ") or die(mysqli_error($conn));
        $n=0;
        while($course_code = mysqli_fetch_assoc($ccccc))
        {
            $n++;
            $functn = "drawChart".$n;
            $hrfunctn = "hrcahrts".$n;
            $piechart = "piechart".$n;
            $hrchart = "hrchart".$n;
            echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>";    
            echo "<script type='text/javascript'>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback($functn );
            google.charts.setOnLoadCallback($hrfunctn);


            function $functn() {

                var data = google.visualization.arrayToDataTable([
                ['Grade', 'Number of Students'],";
            
                $grade_array = ["A","AB","B","BC","C","CD","D","E","F","EM","AE","AW","PI","MS","NR"];
                foreach($grade_array as $grd)
                {
                    $c_cod = $course_code['code'];

                    $a = mysqli_query($logs,"SELECT * FROM `results` 
                            WHERE grade = '$grd' && 
                            `code` = '$c_cod' &&  
                            `prog_id` = '$programme' &&   
                            `semester` = '$semester' && 
                            `session` = '$session' && 
                            `stat` = '0'
                            ")or die(mysqli_error($logs));
                    $nrows = mysqli_num_rows($a);

                    echo "['$grd',     $nrows],"; 
                }
            
                echo "
                ]);

                var options = {
                title: '$c_cod'
                };

                var chart = new google.visualization.PieChart(document.getElementById('$piechart'));

                chart.draw(data, options);
            }
            
   
   function $hrfunctn() 
   {
     var data = google.visualization.arrayToDataTable([
       ['Grade', 'Number of Student', { role: 'style' } ],";

       $grade_array = ["A","AB","B","BC","C","CD","D","E","F","EM","AE","AW","PI","MS","NR"];
       
       foreach($grade_array as $grd)
       {
         $m = $m+1;
           $c_cod = $course_code['code'];

           $a = mysqli_query($logs,"SELECT * FROM `results` 
                   WHERE grade = '$grd' && 
                   `code` = '$c_cod' &&  
                   `prog_id` = '$programme' &&   
                   `semester` = '$semester' && 
                   `session` = '$session' && 
                   `stat` = '0'
                   ")or die(mysqli_error($logs));
           $nrows = mysqli_num_rows($a);
          
      if($grd == "A"){
        $clrg == "#ffb900";
      }elseif($grd == "AB"){
        $clrg = "#6aff00";
      }elseif($grd == "B"){
        $clrg = "#ff4000";
      }elseif($grd == "BC"){
        $clrg = "#0044ff";
      }elseif($grd ==  "C"){ 
        $clrg ="#131c33";
      }elseif($grd == "CD"){ 
        $clrg ="#9cc435";
      }elseif($grd == "D"){ 
        $clrg ="#c035c4";
      }elseif($grd == "E"){ 
        $clrg ="#35c0c4";
    }elseif($grd == "F"){ 
      $clrg ="#263f40";
    }elseif($grd == "EM"){
       $clrg ="#357a30";
    }elseif($grd == "AE"){ 
      $clrg ="#f2edc2";
    }elseif($grd == "AW"){ 
      $clrg ="#f2c2d8";
    }elseif($grd == "PI"){ 
      $clrg ="#c2c2f2";
    }elseif($grd == "MS"){ 
      $clrg ="#a1ad9e";
    }

  //   $clrg = $arr_col["$grd"];
//
           echo "['$grd',     $nrows, '$clrg'],"; 
         }
     
         echo "
         ]);

    

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                          { calc: 'stringify',
                            sourceColumn: 1,
                            type: 'string',
                            role: 'annotation' },
                          2]);

        var options = {
          title: '$c_cod',
          width: 600,
          height: 400,
          bar: {groupWidth: '95%'},
          legend: { position: 'none' },
        };
        var chart = new google.visualization.BarChart(document.getElementById('$hrchart'));
        chart.draw(view, options);
    }
            </script>";

            ?>
<table>
  <tr>
    <td><div id="<?php echo $piechart;?>" style="width: 900px; height: 300px;"></div></td>
    <td><div id="<?php echo $hrchart;?>" style="width: 900px; height: 300px;"></div></td>
  </tr>
</table>
 <?php 
        }

  }



  

    ?>



    

<form action="" method="post" name="grades" id="grade">
<table class="table table-bordered">  
  <tr>
      <td><span style="font-weight: bold">PROGRAMME:</span></td>
      <td >
      <select name="programme" id="programme" class="form-control">
        <option selected="selected" value="">Select Programme</option>
        <?php //include('dptcode.php') ;
        if($forms_choose == 1){
        $queri = 	prog_function($logs); 
        }elseif($forms_choose == 0){
            $sq = mysqli_query($logs,"SELECT * FROM `departments` WHERE code = '$departmentcode'") or die(mysqli_error($logs));
            $did = mysqli_fetch_assoc($sq);
            $queri = mysqli_query($logs,"SELECT * FROM `programmes` WHERE dept_id LIKE '".$did['dept_id']."'") or die(mysqli_error($logs));
        }

        while($pcd = mysqli_fetch_assoc($queri)){
            ?>
        <option value = "<?php echo $pcd['prog_id'];?>"><?php echo $pcd['programme'];?></option>
         <?php }?>
      </select>
      </td>
    </tr>
    <tr>
      <td><span style="font-weight: bold">SEMESTER:</span></td>
      <td >
      <select name="semester" class="form-control">
        <option selected="selected" value="">Select Semester</option>
        <option value="1">First Semester</option>
        <option value="2">Second Semester</option>
        <option value="3">Third Semester</option>
        <option value="4">Fourth Semester</option>
      </select>
      </td>
    </tr>
    <tr>
      <td><span style="font-weight: bold">SESSION:</span></td>
      <td >
      <select name="session" class="form-control">
            <option selected="selected" value="">Select Session</option>
      <option><?php echo ((date('Y')-1)."/".date('Y'));?></option>
        <?php echo include('includes/sessions.php');?>
        <option>2018/2019</option>
      </select>
       
       </td>
    </tr>
    <tr>
      <td colspan="2">
        <input name="Submit1" type="submit" id="Submit" value="Submit"  class="btn btn-gradient-primary mr-2"/>
      </td>
    </tr>
  </table>
</form>
<br>
<hr>
<br>
<hr>

<br>
<hr>
<?php

if (!isset($_SESSION))
{
  session_start();
  require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');
}

if(isset($_POST["Submit"]))
{
        
    $course_code = $_POST["c_code"];
    $semester = $_POST["semester"];
    $session = $_POST["session"];
    $programme = $_POST["programme"];

?>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
      <script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawCharts);

        function drawChart() 
        {
            var data = google.visualization.arrayToDataTable([
            ['Grade', 'Number of Students'],
        
            <?php 
            $grade_array = ["A","AB","B","BC","C","CD","D","E","F","EM","AE","AW","PI","MS","NR"];
                
            foreach($grade_array as $gd)
            {
                $a = mysqli_query($logs,"SELECT * FROM `results` 
                                WHERE grade = '$gd' && 
                                code = '$course_code' &&  
                                `prog_id` ='$programme' && 
                                semester = '$semester' && 
                                `session` = '$session' && 
                                `stat` = '0'") 
                                or die(mysqli_error($logs));

                $nrows = mysqli_num_rows($a);
                echo "['$gd',     $nrows],";
            }
            
            echo "
            ]);

            var options = {
            title: '$course_code'
            };";

            ?>

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }



        function drawCharts() {
      var data = google.visualization.arrayToDataTable([
        ["grade", "Number of Student", { role: "style" } ],
        <?php 
            $grade_array = ["A","AB","B","BC","C","CD","D","E","F","EM","AE","AW","PI","MS","NR"];
                
            foreach($grade_array as $gd)
            {
                $a = mysqli_query($logs,"SELECT * FROM `results` 
                                WHERE grade = '$gd' && 
                                code = '$course_code' &&  
                                `prog_id` ='$programme' && 
                                semester = '$semester' && 
                                `session` = '$session' && 
                                `stat` = '0'") 
                                or die(mysqli_error($logs));

                $nrows = mysqli_num_rows($a);

                echo "['$gd',     $nrows, '#0000'],";
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
        title: '$course_code',";?>
        width: 375,
        height: 200,
        bar: {groupWidth: "auto"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }


    </script>
<?php 
$all_charts = 0;
// call the charts
  include("../chart_layout.php");
// end of callcharts

}
elseif(isset($_POST["Submit1"]))
{
    //$course_code = $_POST[""];
    $semester = $_POST["semester"];
    $session = $_POST["session"];
    $programme = $_POST["programme"];

    $msq = mysqli_query($logs,"SELECT * FROM course 
                              WHERE prog_id = '$programme' && 
                              semester = '$semester' && 
                              `sessions` = '$session'") or die(mysqli_error($logs));
     
?>
<br>
<hr>
<br>
<hr>
<form action="" method="post" name="grades" id="grade">
<table class="table table-bordered">  
  <tr>
      <td><span style="font-weight: bold">Course:</span></td>
      <td >
      <select name="c_code" id="c_code" class="form-control">
            <option selected="selected" value="">Select Course</option>
            <?php while($rw = mysqli_fetch_assoc($msq)){
              ?>
            <option value="<?php echo $rw['code'];?>"><?php echo $rw["title"];?></option>
            <?php
            }?>
      </select>
      </td>
  </tr>
  <tr>
      <td colspan="2">
      <input type="hidden" name="programme" value="<?php echo $programme;?>">
      <input type="hidden" name="semester" value="<?php echo $semester;?>">
      <input type="hidden" name="session" value="<?php echo $session;?>">
        <input name="Submit" type="submit" id="Submit" value="Submit"  class="btn btn-gradient-primary mr-2"/>
      </td>
    </tr>
</table>
</form>
<br>
<hr>
<br>
<hr>
<?php     
}
?>

<hr>
<br>
<hr>
<form action="" method="post" name="grades" id="grade">
<table class="table table-bordered">  
  <tr>
      <td><span style="font-weight: bold">PROGRAMME:</span></td>
      <td >
      <select name="programme" id="programme" class="form-control">
        <option selected="selected" value="">Select Programme</option>
        <?php //include('dptcode.php') ;
        $queri = 	programmess_dept($_SESSION['depts_ids'], $logs); 
        //	$queri = mysqli_query($conn,"SELECT * FROM `dept` WHERE prog = '$departmentcode'") or die(mysqli_error($conn));
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
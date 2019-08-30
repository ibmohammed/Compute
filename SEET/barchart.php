<html>
  <head>
  <?php 

$dataPoints = array( 
	array("y" => $pass, "label" => "PASS" ),
	array("y" => $co, "label" => "CARRYOVER" ),
	array("y" => $abs, "label" => "ABSENT" ),
	array("y" => $atw, "label" => "ATW" )
);
// enf of canvas js 
?>
  <script>
window.onload = function() {
 
 var chart = new CanvasJS.Chart("chartContainer", {
   animationEnabled: true,
   theme: "light2",
   title:{
     text: "Result Summary in Bar Chart"
   },
   axisY: {
     title: "Number of Students"
   },
   axisX: {
     title: "Remarks"
   },
   data: [{
     type: "column",
     yValueFormatString: "#,##0.## students",
     dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chart.render();
  
 }
</script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
   
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

       google.charts.load('current', {packages: ['corechart', 'bar']});
       google.charts.setOnLoadCallback(drawBasic);

       google.charts.load('current', {'packages':['bar']});
       google.charts.setOnLoadCallback(drawStuff);

// 3D Pie chart 
      function drawChart() 
      {
        var data = google.visualization.arrayToDataTable([
          <?php 
          echo "['Rmars', 'Number of Students'],
          ['PASS',     $pass],
          ['CO',      $co],
          ['ABS',  $abs],
          ['ATW', $atw]";
          ?>
        ]);

       var options = {
          title: 'Result Summary in 3D Pie Chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }

    </script>
    </head>
    <body>
<table  class="table table-bordered">
  <tr>
  <td>
    <?php if (@$show_chart !==0){?>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    <?php //   <div id="chart_div"  style="width: 900px; height: 500px;"></div>; ?>
    <?php //echo '<div id="top_x_div" style="width: 900px; height: 500px;"></div>';
    }
    ?>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </td>
  </tr>
</table>
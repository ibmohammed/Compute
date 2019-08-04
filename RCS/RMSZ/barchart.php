



<html>
  <head>
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

// Horizintal Barchart
      function drawBasic() 
      {
        var data = google.visualization.arrayToDataTable([
        <?php 
        echo "['Remarks', 'No of Students', { role: 'style' } ],
        ['PASS', $pass, 'color: #76A7FA'],
        ['CARRY OVER', $co, 'opacity: 0.2'],
        ['ABSENT', $abs, 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'],
        ['ATW', $atw, 'stroke-color: #871B47; stroke-opacity: 0.6; stroke-width: 8; fill-color: #BC5679; fill-opacity: 0.2']";
        ?>
        ]);
        var options = {
        title: 'Result Summary in Bar Chart',
        chartArea: {width: '50%'},
        hAxis: {
            title: 'Number of Student',
            minValue: 0
        },
        vAxis: {
            title: 'Remarks'
        }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

// bar chart 

function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
         <?php 
          echo "['Remarks', 'No of students'],
          ['PASS', $pass],
          ['Carry Over', $co],
          ['Absent', $abs],
          ['ATW', $atw]        
        ]);";
         ?>
        var options = {
          title: 'Chess opening moves',
          width: 900,
          legend: { position: 'none' },
          chart: { title: '',
                   subtitle: '' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Number of Students'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  <div id="chart_div"  style="width: 900px; height: 500px;"></div>
  <?php //echo '<div id="top_x_div" style="width: 900px; height: 500px;"></div>';?>
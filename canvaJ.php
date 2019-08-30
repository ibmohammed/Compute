<?php


if (!isset($_SESSION))
{
  session_start();
  require_once('functions/queries.php');
  require_once('connections/connection.php');
}



$dataPoints = array();


    $grade_array = ["A","AB","B","BC","C","CD","D","E","F","EM","AE","AW","PI","MS","NR"];
                
    foreach($grade_array as $gd)
    {
        $a = mysqli_query($logs,"SELECT * FROM `results` 
                        WHERE grade = '$gd' && 
                        code = 'code122' &&  
                        `prog_id` ='47' && 
                        semester = '1' && 
                        `session` = '2010/2011' && 
                        `stat` = '0'") 
                        or die(mysqli_error($logs));

        $nrows = mysqli_num_rows($a);

        array_push($dataPoints, array("label"=> $gd, "y"=> $nrows));
    }
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "PHP Column Chart from Database"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
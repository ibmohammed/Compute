<?php 
if (isset($_POST['Submit']))
{
  //echo '<h3>'..'</h3>';
  
$dept = $_POST['dept'];
$year=$_POST['year'];
$result =  score_templates($logs, $dept, $year);

$flag = false;
$n=0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    if(!$flag) {
      // display field/column names as first row
      fputcsv($display, array_keys($row), ",", '"');
      $flag = true;
    }
    fputcsv($display, array_values($row), ",", '"');
  }
 
fclose($display);
  exit;
}?>




<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require("includes/header.php");
    //include("includes/thehead.php");//this is common to all
	//require("includes/header.php"); 
   // $time = date("h:i:sa");
    //$name = "Scores_template".$time.".xlsx";
   // $filename = "sampledata".$time.".csv";
  //  header("Content-Disposition: attachment; filename=\"$filename\"");
  //  header("Content-Type: text/csv");
  //  $display = fopen("php://output", 'w');
?>
  <style>
* {
    color: #2b2b2b;
    font-family: "Roboto Condensed";
}

th {
    text-align: left;
    color: #4679bd;
}

tbody > tr:nth-of-type(even) {
    background-color: #daeaff;
}

button {
    cursor: pointer;
    margin-top: 1rem;
}
</style>

<script language ="JavaScript">
function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(html, filename) {
	var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

document.querySelector("button").addEventListener("click", function () {
    var html = document.querySelector("table").outerHTML;
	export_table_to_csv(html, "table.csv");
});

</script>  

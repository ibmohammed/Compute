
<?php 
if (isset($_GET['sreg_temp']))
{
    //echo '<h3>'..'</h3>';
    ?>
    <style>
    #thisTable {
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


    <script>

    function download_csv(csv, filename) 
    {
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

    function export_table_to_csv(filename) 
    {
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

    </script>

    <hr>
    <em style="color:green">Click on "Generate Template" button below to download Students data template</em>
    <table class="table table-bordered" >
    <tr>
    <th>Full Name</th>
    <th>Matric Number</th>
    </tr>
    <tr>
    <td></td>
    <td></td>
    </tr>
    </table>
    <button onClick="export_table_to_csv('table.csv')" class="btn btn-gradient-primary mr-2">Download template</button>

    <?php 
}?>
<hr>    
<br>
<hr>
<?php 

if($templates == 10)
{
    require("template_foem.php");
}
?>
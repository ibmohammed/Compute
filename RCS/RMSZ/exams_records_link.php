<?php 
if(isset($_GET['vwstdr']))
{
    header('location:exams_records.php?vwstdr');
}elseif(isset($_GET['addviewwdit']))
{
    header('location:exams_records.php?addviewwdit');
}if(isset($_GET['viewabm']))
{
    header('location:exams_records.php?viewabm');
}

?>
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

}if(isset($_GET['setting']))
{
    header('location:exams_records.php?setting');
}


?>
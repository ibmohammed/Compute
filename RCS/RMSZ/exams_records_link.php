<?php 
if(isset($_GET['vwstdrx']))
{
    header('location:exams_records.php?vwstdrx');
    
}elseif(isset($_GET['addviewwditx']))
{
    header('location:exams_records.php?addviewwditx');

}if(isset($_GET['viewabm']))
{
    header('location:exams_records.php?viewabm');

}if(isset($_GET['setting']))
{
    header('location:exams_records.php?setting');
}if(isset($_GET['result_analysis']))
{
    header('location:exams_records.php?result_analysis');
}


?>
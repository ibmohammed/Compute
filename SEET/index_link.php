<?php 
if(isset($_GET['csv']))
{
    header('location:index.php?csv');

}elseif(isset($_GET['csvco']))
{
    header('location:index.php?csvco');    
}elseif(isset($_GET['csvspill']))
{
    header('location:index.php?csvspill');

}elseif(isset($_GET['entres']))
{
    header('location:index.php?entres');
}if(isset($_GET['editres']))
{
    header('location:index.php?editres');
}if(isset($_GET['consider']))
{
    header('location:index.php?consider');
}if(isset($_GET['overwrite']))
{
    header('location:index.php?overwrite');
}if(isset($_GET['deleter']))
{
    header('location:index.php?deleter');
}if(isset($_GET['deleterr']))
{
    header('location:index.php?deleterr');
}if(isset($_GET['alloc']))
{
    header('location:index.php?alloc');
}if(isset($_GET['setting']))
{
    header('location:index.php?setting');
}if(isset($_GET['views']))
{
    header('location:index.php?views');
}if(isset($_GET['viewabm']))
{
    header('location:index.php?viewabm');
}if(isset($_GET['result_analysis']))
{
    header('location:index.php?result_analysis');

}if(isset($_GET['samplechart']))
{
    header('location:index.php?samplechart');
}if(isset($_GET['viewsco']))
{
    header('location:index.php?viewsco');
    
}if(isset($_GET['activity']))
{
    header('location:index.php?activity');

}if(isset($_GET['score_temp']))
{
    header('location:index.php?score_temp');
}

?>
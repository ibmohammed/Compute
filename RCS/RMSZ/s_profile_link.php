<?php 
if(isset($_GET['setting']))
{
    header('location:s_profile.php?setting');
}

if(isset($_GET['csvrn']))
{
    header('location:s_profile.php?csvrn');
}
?>
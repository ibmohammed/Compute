<?php 
if (!isset($_SESSION))
{
  session_start();
  require_once('functions/queries.php');
  require_once('connections/connection.php');
}

$sql = ("SELECT a.prog_id as id, b.`programme` as prg FROM `programmes` a, `enteredd` b WHERE a.`programme` = b.`programme`");
$qry = mysqli_query($logs, $sql) or die(mysqli_error());
while($row = mysqli_fetch_assoc($qry)){
    $id = $row['id'];
    $prg = $row['prg']; 
$msql = ("UPDATE `enteredd` SET `programme` = '$id' WHERE `programme` = '$prg'");
$msql =mysqli_query($logs, $msql);
if ($msql){
    echo "Successful";
}
}
?>
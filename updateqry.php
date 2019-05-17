<?php 
if (!isset($_SESSION))
{
  session_start();
  require_once('functions/queries.php');
  require_once('connections/connection.php');
}

$sql = ("SELECT a.prog_id as id, b.`dept` as prg FROM `programmes` a, `studentsnm` b WHERE a.`programme` = b.`dept`");
$qry = mysqli_query($logs, $sql) or die(mysqli_error());
while($row = mysqli_fetch_assoc($qry)){
    $id = $row['id'];
    $prg = $row['prg']; 
$msql = ("UPDATE `studentsnm` SET `dept` = '$id' WHERE `dept` = '$prg'");
$msql =mysqli_query($logs, $msql);
if ($msql){
    echo "Successful";
}
}
?>
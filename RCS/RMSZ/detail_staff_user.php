
<h3>User Type:<?php echo $_GET['tusers'];?></h3>
<form name="form1" action="" method="post">
<table class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Number</th>

<th>Department</th>

<th>Username</th>
<th colspan="2">Actions</th>
</tr>
</thead>
<tbody>
<?php

if( $_GET['tusers']!=="Student"){
$q =mysqli_query($logs,
 "SELECT s.names, s.number, s.contact, s.dept_id, l.username, l.id as logid 
FROM staff s, logintbl l 
WHERE s.number = l.status &&  l.t_user ='".$_GET['utid']."'") 
or die(mysqli_error($logs));

}else{

    $q =mysqli_query($logs,
 "SELECT s.names, s.matno as number, s.prog_id as dept_id, l.matric_no as username, l.id as logid
FROM `studentsnm` s, `students_log` l 
WHERE s.matno = l.matric_no") 
or die(mysqli_error($logs));

}
$ii = 0;
while($usres = mysqli_fetch_assoc($q)){
    $ii++;
    //
     //$_SESSION['laidi'] = $usres['logid'];
?>
<tr>
<td><?php echo $ii;?></td>
<td><?php echo $usres['names'];?></td>
<td><?php echo $usres['number'];?></td>

<td><?php echo $usres['dept_id'];?></td>
<td><?php echo $usres['username'];?></td>
<?php $tuserss = $_GET['tusers'];
$tuserss = preg_replace("/[^a-zA-Z]/", "", $tuserss);
?>
<td><a href="javascript:void(0);" 
NAME="My Window Name" title="Change Password" 
onClick=window.open("useredit.php?id=<?php echo $usres['logid'].'&utyp='.$tuserss;?>","Ratting","width=550,height=170,0,status=0");>Edit</a></td>
<td>Delete</td>
</tr>
<?php }?>
<tbody>
</table>

<a href="smanage_link.php?edituser_staff">Back to user type</a>
<br>
<hr>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for date.." class="form-control">
<table  class="table table-bordered" id="myTable">
<tr>
    <th>#   </th>
    <th>Table id   </th>
    <th>Table name   </th>
    <th>Action   </th>
    <th>User id   </th>
    <th>User name   </th>
    <th>Date   </th>
    <th>Time   </th>
</tr>
<?php 
$n = 0;
$result = the_chronicle($logs);
while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $n++;
     ?>
<tr>
    <td><?php  echo $n;?></td>
    <td><?php  echo $rows["table_id"];?> </td>
    <td><?php  echo $rows["tablename"];?></td>
    <td><?php  echo $rows["action"];?></td>
    <td><?php  echo $rows["whoid"];?></td>
    <td><?php  echo $rows["whoname"];?></td>
    <td><?php  echo $rows["ddate"];?></td>
    <td><?php  echo $rows["dtime"];?></td>
</tr>
<?php 
}
?>
</table>
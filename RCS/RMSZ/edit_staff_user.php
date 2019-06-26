<?php 

 //if(isset($_GET['tusers']))
//{   ?>

<?php 

//}



try {
           // make_change_pass($userid, $password, $lg);
            

             //make_change_spass($userid, $password, $lg);

             function logs_tbl()
             {
               // SELECT 
             }
             

              
    } catch(Exception $e) {
      throw $e;
      }?>

<table class="table table-bordered">
<tr>
<td>#</td>
<td>User Type</td>
</tr>
<?php
$ii=0;
$ut = user_type($logs); 
while($utypes = mysqli_fetch_assoc($ut)){
    $ii++;

    $utype = $utypes['type'];
    //$utype =  preg_replace("/[^a-zA-Z]/", "", $utype)
    ?>
<tr>
<td><?php echo $ii;?></td>
<td><a href="smanage.php?tusers=<?php echo $utype;?>&utid=<?php echo $utypes['status'];?>"><?php echo $utypes['type'];?></a></td>
</tr>
<?php

}

?>
</table>


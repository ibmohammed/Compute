<?php



$n = 0; 
$result = menu_control($logs, $utid);
while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC))
{ 
    $n++;
    $results = sub_menu_control($logs, $rows["menu_id"]);
    ?>

    <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic<?php echo $n;?>" aria-expanded="false" aria-controls="ui-basic<?php echo $n;?>">
        <span class="menu-title"><?php echo $rows ["menu_name"];?></span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-multiple-plus"></i>
    </a>
    <div class="collapse" id="ui-basic<?php echo $n;?>">
        <ul class="nav flex-column sub-menu">
        <?php 
        while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
        {   
            ?>
            <li class="nav-item"> 
                <a class="nav-link" href="<?php echo $links_path.$row["xtension"];?>">
                    <?php echo $row["s_menu_name"];?>
                </a>
            </li>
            <?php 
        }?>
          </ul>
    </div>
    </li>

    <?php 
}


 
if($utid !== 2)
{
?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo $links_path.'setting';?>">
        <span class="menu-title">Settings</span>
        <i class="mdi mdi-settings menu-icon"></i>
      </a>
    </li>
<?php 
}
?>
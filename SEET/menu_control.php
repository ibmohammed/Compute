<?php 
include("includes/thehead.php");//this is common to all
?>
<body>

<style>
button{
    background-color:purple; 
    color:white; 
    border:solid; 
    border-radius:5px; 
    border-color:purple;
}
h4{
    color:purple;
}
h5{
    color:green;
}
</style>

<div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                   
                        <h4> Menu Control Form</h4>
                    <hr>
                    

                    <?php 
// start iset
                    if(isset($_POST["Submit"]))
                    {

                         
                //sub menu 
                        if (!empty($_POST['s_menucheck']))
                        {
                            foreach($_POST['s_menucheck'] as $submenuname)
                            {
                                foreach($_POST['s_menu_id'] as $s_menuid)
                                {
                                    //update query function 
                                    submenu_update($logs, $s_menuid, $submenuname);

                                }

                            }
                        }
                    }
//end isset 
                    ?>




                        
                            <!-- page content -->
                           
                            <?php
                            $utid = $_GET["utid"];
                            $result = the_menu_control($logs, $utid);
                            $m = 0;
                            while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            { 
                                $m++;
                                $results = the_sub_menu_control($logs, $rows["menu_id"]);
                                ?>

                                
                                <?php 
                                if($rows["status"]== 1)
                                {
                                    $check = "checked";
                                }
                                else
                                {
                                    $check = "";
                                }
                                ?>
                                <br>
                                <h5><?php echo $rows ["menu_name"];?> Menu</h5>
                                <hr>
                                <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Sub Menu</th>
                                </tr>
                                <?php 
                                $n = 0; 
                                while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
                                { 
                                    $n++;  

                                    if($row["status"]== 1)
                                    {
                                        $check = "checked";
                                    }
                                    else
                                    {
                                        $check = "";
                                    }
                                    ?>
                                     <form name="smenu_form<?php echo $n;?>" action="" method="post">
                                        <tr>
                                            <td>
                                                <input type="hidden" value="<?php echo $row["s_menu_id"];?>" name="s_menu_id[]">
                                                <input type="hidden" value="0" name="s_menucheck[]">
                                                <input type="checkbox" name="s_menucheck[]" value="1" <?php echo $check;?>>
                                            </td>
                                            <td>
                                                <?php echo $row["s_menu_name"];?>
                                            </td>
                                            <td>
                                                <button name="Submit">Go</button>
                                        
                                            </td>
                                        </tr>   
                                    </form>
                                        <?php 
                                    }?>
                                    </table>
                            
                                <?php 
                            }
                            ?>
                            
                </div>
            </div>
        </div>
    </div>
</div>
<?php 


$deptqry = mysqli_query($logs, "SELECT dept_id, name, schl_id FROM `departments` WHERE code ='".$_SESSION['deptcode']."'") or die(mysqli_error($logs));
$depts = mysqli_fetch_assoc($deptqry);
$_SESSION['deptid'] = $depts['dept_id'];


$schlqry = mysqli_query($logs, "SELECT school, college_id FROM `schools`WHERE schl_id='".$depts['schl_id']."'") or die(mysqli_error($logs));
$schl = mysqli_fetch_assoc($schlqry);

$colgqry = mysqli_query($logs, "SELECT college, collegecode FROM `colleges`") or die(mysqli_error($logs));
$coleg = mysqli_fetch_assoc($colgqry);

$col_dashb = mysqli_query($logs, "SELECT college, collegecode FROM `colleges` WHERE `college_id` = '".$schl['college_id']."'") or die(mysqli_error($logs));
$col_dashb = mysqli_fetch_assoc($col_dashb);


$prgqry2 = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes` WHERE dept_id ='".$depts['dept_id']."'") or die(mysqli_error($logs));
$prg_ids = mysqli_fetch_assoc($prgqry2);
$_SESSION['prgid'] = $prg_ids['prog_id'];

//$prgqry = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes` WHERE dept_id ='".$depts['dept_id']."'") or die(mysqli_error($logs));
$prgqry = mysqli_prepare($logs, 
          "SELECT  prog_id, programme 
          FROM `programmes` 
          WHERE `dept_id`= ?") or die(mysqli_error($logs)."You");
                               

//$prgasc = mysqli_fetch_assoc($prgqry);
  mysqli_stmt_bind_param($prgqry, "s", $deptid);
  $deptid = $depts['dept_id'];// set parameter
  mysqli_stmt_execute($prgqry);
  $prgqry = mysqli_stmt_get_result($prgqry);

  //$msq = mysqli_query($lg, $ssql   '$deptid'
        ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="../imagess/faces/face1.jpg" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"> <?php echo $departmentcode;?></span>
                <span class="text-secondary text-small">Coordinator</span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <?php 
           $links_path = "index_link.php?";
          $utid = $_SESSION["t_user"];
          include("menus_database.php");
          ?>
      </ul>
      </nav>
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
                <img src="../../imagess/faces/face1.jpg" alt="profile">
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



          <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                  <span class="menu-title">Manage Scorse</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-marker"></i>
                </a>
                <div class="collapse" id="ui-basic3">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?csv">Import scores</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?entres">Input score</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?editres">Edit score</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?consider">Consider scores</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?csvco">Import Carry Over scores</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?csvspill">Import Spill Over scores</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?deleter">Delete Records</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?deleterr">Delete Semester scores</a></li>
                   
                  </ul>
                </div>
              </li>
    
    

          <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
                  <span class="menu-title">Manage Resuls</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-alphabetical"></i>
                </a>
                <div class="collapse" id="ui-basic4">
                  <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="index_link.php?views">Notice board result</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?viewabm">Acedemic board result</a></li>
                   <!-- <li class="nav-item"> <a class="nav-link" href="index_link.php?overwrite">Update scores</a></li>
                   <li class="nav-item"> <a class="nav-link" href="index_link.php?result_analysis">Result Analysis</a></li>-->

                  </ul>
                </div>
              </li>


 <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
                  <span class="menu-title">Resuls Analysis</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-chart-bar "></i>
                </a>
                <div class="collapse" id="ui-basic5">
                  <ul class="nav flex-column sub-menu">
                   <li class="nav-item"> <a class="nav-link" href="index_link.php?samplechart">Single Course Analysis</a></li>
                   <li class="nav-item"> <a class="nav-link" href="index_link.php?result_analysis">All courses Analysis</a></li>

                  </ul>
                </div>
              </li>
                                       



              <li class="nav-item">
                      <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic7">
                          <span class="menu-title">Manage Staff</span>
                          <i class="menu-arrow"></i>
                          <i class="mdi mdi-account-multiple"></i>
                      </a>
                      <div class="collapse" id="ui-basic7">
                          <ul class="nav flex-column sub-menu">
                        
                          <li class="nav-item"> <a class="nav-link" href="index_link.php?alloc"  target="_new">Allocate courses</a></li>
                          </ul>
                      </div>
              </li>

                                        
    <li class="nav-item">
            <a class="nav-link" href="index_link.php?setting">
              <span class="menu-title">Settings</span>
              <i class="mdi mdi-settings menu-icon"></i>
            </a>
          </li>

      </ul>
      </nav>
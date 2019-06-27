<?php 


$deptqry = mysqli_query($logs, "SELECT dept_id, name, schl_id FROM `departments` WHERE code ='".$_SESSION['deptcode']."'") or die(mysqli_error($logs));
$depts = mysqli_fetch_assoc($deptqry);
$_SESSION['deptid'] = $depts['dept_id'];
$schlqry = mysqli_query($logs, "SELECT school, college_id FROM `schools`WHERE schl_id='".$depts['schl_id']."'") or die(mysqli_error($logs));
$schl = mysqli_fetch_assoc($schlqry);

$colgqry = mysqli_query($logs, "SELECT college, collegecode FROM `colleges`") or die(mysqli_error($logs));
$coleg = mysqli_fetch_assoc($colgqry);

$prgqry2 = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes` WHERE dept_id ='".$depts['dept_id']."'") or die(mysqli_error($logs));
$prg_ids = mysqli_fetch_assoc($prgqry2);
$_SESSION['prgid'] = $prg_ids['prog_id'];

$prgqry = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes` WHERE dept_id ='".$depts['dept_id']."'") or die(mysqli_error($logs));
//$prgasc = mysqli_fetch_assoc($prgqry);




 /*$return_result = staff_data(@$_SESSION['staffcomfirmed'], $logs);
        $data = mysqli_fetch_assoc($return_result);
        
        $return_dept = departmentss(@$data['dept_id'], $logs);
        $schlid = mysqli_fetch_assoc($return_dept);
        //$schlid = $result1->fetch_array();
        
        
        
        
        $return_schl = schoolss(@$schlid['schl_id'], $logs);
        $clgid = mysqli_fetch_assoc($return_schl);
        //$clgid = $result2->fetch_array();
        $return_college = collegess(@$clgid['college_id'], $logs);
        $clg = mysqli_fetch_assoc($return_college);
        //$clg = $result3->fetch_array();
*/

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
                  <i class="mdi mdi-alphabetical"></i>
                </a>
                <div class="collapse" id="ui-basic3">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?csv">Import scores</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?entres">Input score</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?editres">Edit score</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?consider">Consider scores</a></li>
                   <!-- <li class="nav-item"> <a class="nav-link" href="index_link.php?overwrite">Update scores</a></li>-->
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?deleter">Delete Records</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index_link.php?deleterr">Delete Semester scores</a></li>
                   
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
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
          </li>

      </ul>
      </nav>
<?php 

function dept_function($logs)
{
  $deptqry = mysqli_query($logs, "SELECT dept_id, name, code, schl_id FROM `departments` ") or die(mysqli_error($logs));
  return $deptqry;
  //$depts = mysqli_fetch_assoc($deptqry);
}

function schl_function($logs)
{
  $schlqry = mysqli_query($logs, "SELECT schl_id, school, college_id FROM `schools`") or die(mysqli_error($logs));
  //$schl = mysqli_fetch_assoc($schlqry);
  return $schlqry;
}

function col_function($logs)
{
  $colgqry = mysqli_query($logs, "SELECT college_id, college, collegecode FROM `colleges`") or die(mysqli_error($logs));
  //$coleg = mysqli_fetch_assoc($colgqry);
  return $colgqry;
}


function prog_function($logs)
{
  
  $prgqry = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes`") or die(mysqli_error($logs));
  //$prgasc = mysqli_fetch_assoc($prgqry);
  return $prgqry;
}


function progs_function($logs, $deptsid)
{
$prgqry2 = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes` WHERE dept_id ='".$deptsid."'") or die(mysqli_error($logs));

return $prgqry2;
}

function schls_function($logs, $colid)
{
  $schlqry = mysqli_query($logs, "SELECT school, college_id FROM `schools` WHERE `college_id` = '".$colid."'") or die(mysqli_error($logs));
 
  return $schlqry;
}

function depts_function($logs, $schlid)
{
  $deptqry = mysqli_query($logs, "SELECT dept_id, name, schl_id FROM `departments` WHERE schl_id= '".$schlid."' ") or die(mysqli_error($logs));
  return $deptqry;
  //$depts = mysqli_fetch_assoc($deptqry);
}


function proggpid_function($logs, $deptsid)
{
$prgqry2 = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes` WHERE prog_id ='".$deptsid."'") or die(mysqli_error($logs));

return $prgqry2;
}
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
                <span class="text-secondary text-small">System Manager</span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="smanage.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>




          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Manage Student data</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-multiple-plus"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?csvn">Import student record</a></li>
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?regs">Input student record</a></li>
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?vwstdr">View student record</a></li>
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?edits">Edit student record</a></li>
               
              </ul>
            </div>
          </li>



         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
              <span class="menu-title">Manage Courses</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?csvc">Import courses</a></li>
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?courser">Input courses</a></li>
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?updtcourse">Edit courses</a></li>
                <li class="nav-item"> <a class="nav-link" href="smanage_link.php?addviewwdit">View Courses</a></li>
                
              </ul>
            </div>
          </li>

                        <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
                                    <span class="menu-title">Manage programme</span>
                                    <i class="menu-arrow"></i>
                                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                                </a>
                                <div class="collapse" id="ui-basic6">
                                    <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="smanage_link.php?newpro">Import new Department</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="smanage_link.php?newcourse">Input new Department</a></li>                
                                    
                                    <li class="nav-item"> <a class="nav-link" href="smanage_link.php?importpro">Import new programme</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="smanage_link.php?inputpro">Input new programme</a></li>                
                                    <!--<li class="nav-item"> <a class="nav-link" href="smanage_link.php?group">Group programmes</a></li>-->
                                    <li class="nav-item"> <a class="nav-link" href="smanage_link.php?editgroup">Edit Deparments</a></li>                
                                    <li class="nav-item"> <a class="nav-link" href="smanage_link.php?editprog">Edit Programme</a></li>                
                                    </ul>
                                </div>
                                </li>
                        


                                <li class="nav-item">
                                        <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic7">
                                            <span class="menu-title">Manage Users/Staff</span>
                                            <i class="menu-arrow"></i>
                                            <i class="mdi mdi-account-multiple"></i>
                                        </a>
                                        <div class="collapse" id="ui-basic7">
                                            <ul class="nav flex-column sub-menu">
                                            <li class="nav-item"> <a class="nav-link" href="smanage_link.php?staff_user">Add new user/staff</a></li>
                                            <li class="nav-item"> <a class="nav-link" href="smanage_link.php?edituser_staff" >View/Edit user/staff</a></li>                
                                          <!--  <li class="nav-item"> <a class="nav-link" href="smanage.php?alloc"  target="_new">Allocate courses</a></li>-->
                                            </ul>
                                        </div>
                                        </li>
          
        </ul>
      </nav>
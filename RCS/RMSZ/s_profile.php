            <!-- page content -->

<?php if(isset($_POST['Submitff']) || isset($_GET['csvrn']))
        {
          ?>
            <br>
            <h4>Manage Scores </h4><br>
            <h6 class="w3-opacity"> </h6>
            <hr class="w3-clear">
            <?php 
            $compute_co = 0;
            require_once('csvresn.php');
      	}
  require_once('menus.php');
?>
      <!-- End of page content -->

      <!---dashboard -->
       <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>                 
              </span>
              Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
         
          <div class="row">

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">College
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h3 class="mb-5"><?php echo $clg['college'];?></h3>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">School 
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h3 class="mb-5"><?php echo $clgid['school'];?></h3>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Department 
                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h3 class="mb-5"><?php echo $schlid['name'];?></h3>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
          </div>
      <!-- - End of Dashboard -->
      <!--- course allocation -->
       <h4>Courses</h4>
                            
        <?php
        //require_once('RCS/courses.php');

				$msql = "SELECT * FROM `course` WHERE staff_id = '".$_SESSION['id_staff']."'";
        $msqls = mysqli_query($logs, $msql);
        
				?>
    	<h4 style="color:red">Courses Allocated to <?php echo @$_SESSION['names']." (".@$_SESSION['number'].")";?></h4>
		
			<table  class="table table-bordered" style="width:100%">
        <thead>
          <tr>
          <th>#</th>  
          <th>CourseCode</th>
          <th>Course Tile</th>
          <th>Course Unit</th>
        </tr>
        </thead>
        <tbody>	
        <?php 
        $in = 0;
        while($col = mysqli_fetch_assoc($msqls))
        { 
          $in++;
          $_SESSION['semester']= $col['semester'];
          $_SESSION['sessions']= $col['sessions'];
          $_SESSION['prog_id'] = $col['prog_id'];
          ?>
          <form name="form<?php echo $in;?>" method="post" action="">
            <tr>
              <td><?php echo $in;?></td>
              <td><button class="btn btn-gradient-primary mr-2" style="width:150px"  name="Submitff"><?php echo $col['code'];?></button></td>
              <td><?php echo $col['title'];?></td>
              <td><?php echo $col['unit'];?>
              <input type="hidden" value="<?php echo $col['semester'];?>" name="semester"> 
              <input type="hidden" value="<?php echo $col['sessions'];?>" name="session">
              <input type="hidden" value="<?php echo $col['prog_id'];?>" name="dept_id">
              <input type="hidden" value="<?php echo $col['code'];?>" name="code">
              </td>
            </tr>
          </form>
          <?php 
        }?>
        </tbody>
			</table>
      <br>
            
<!--- End of course allocation -->
    </div>
    </div>
    </div>
    </div>
        <!-- content-wrapper ends -->


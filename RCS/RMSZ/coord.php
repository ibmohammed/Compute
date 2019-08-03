
            <!-- page content -->
            
            <?php  
            $forms_choose = 0;
                include('menus.php');
                include('grpedit.php');

                if(isset($_GET['create'])){
                   include('idexcreate.php');
                }
                ?>
<!-- Enf of page content -->
      
  <?php  
  if(isset($_GET['dashdept']))
  {
    ?>
    <h2>Programme</h2>
    <table  class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Programmes</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0;  
        //query from newmenu line 21
        while($prgasc = mysqli_fetch_array($prgqry, MYSQLI_ASSOC))
        { 
          $i++; 
          ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $prgasc['programme'];?></td>
          </tr>
          <?php
        }
        ?>
      <tbody>
    </table>
    <?php 
 }
    ?>  
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
                  <h5 class="mb-5"><?php echo $col_dashb['college'];?></h5>
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
                  <h5 class="mb-5"><?php echo $schl['school'];?></h5>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            
            <div class="col-md-4 stretch-card grid-margin">
              
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                <a href="index.php?dashdept">  <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                
                  <h4 class="font-weight-normal mb-3">Department 
                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h5 class="mb-5"><?php echo $depts['name'];?></h5>
                  <h6 class="card-text"></h6>
                  </a>  
                </div>
              </div>
            </div>
              
          </div>
          
     <!-- - End of Dashboard -->          

       </div>
    </div>
</div>

        </div>
        <!-- content-wrapper ends -->



        
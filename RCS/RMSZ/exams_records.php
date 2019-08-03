            <!-- page content -->

            
            <?php  
            $forms_choose = 1;
                include('menus.php');
                include('grpedit.php');

                if(isset($_GET['create'])){
                   include('idexcreate.php');
                }
                ?>
<!-- Enf of page content -->
  
<?php   
     $prgqry =  dept_function($logs);
     $schlsqry = schl_function($logs);
    $colgqry = col_function($logs);
      prog_function($logs);
            
  if(isset($_GET['dashdept']))
        {
          ?>
            <h2>Departments</h2>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Number.." class="form-control">
            <table  class="table table-bordered" id="myTable">
            <thead>
            <tr>
            <th>#</th>
            <th>Names of Department</th>
            <th>No. of Programmes</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0;                      
            while($prgasc = mysqli_fetch_assoc($prgqry))
            { 
                $i++; 
                ?>
                <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $prgasc['name'];?></td>
                <td><?php 
                
                //$deptsid = $prgasc['dept_id']; 
                $progno =  progs_function($logs, $prgasc['dept_id']);             
               $progno = mysqli_num_rows($progno);
               echo $progno;
                ?></td>
                </tr>
                <?php
            }
            ?>
            <tbody>
            </table>

 <?php }
      elseif(isset($_GET['dashcolg']))
      {?>
            <h2>Colleges</h2>
            
            <table  class="table table-bordered">
            <thead>
            <tr>
            <th>#</th>
            <th>Names of Colleges</th>
            <th>No. of Schools</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0;  
           
            while($colgs = mysqli_fetch_assoc($colgqry))
            { 
                $i++; 
                ?>
                <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $colgs['college'];?></td>
                <td><?php 
                //$colid = $colgs['college_id'];  
                $schlgeno = schls_function($logs, $colgs['college_id']);        
                $schlgeno = mysqli_num_rows($schlgeno);
                echo $schlgeno;
                ?></td>
                </tr>
                <?php
            }
            ?>
            <tbody>
            </table>
  <?php }
      elseif(isset($_GET['dashschl']))
      {?>
            <h2>Schools</h2>
            <table  class="table table-bordered">
            <thead>
            <tr>
            <th>#</th>
            <th>Names of Schools</th>
            <th>No. of Departments</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0;  
      
            while($schls = mysqli_fetch_assoc($schlsqry))
            { 
                $i++; 
                ?>
                <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $schls['school'];?></td>
                <td><?php 
                //$schlid = $schls['schl_id'];  
                $depteno = depts_function($logs, $schls['schl_id']);        
                $depteno = mysqli_num_rows($depteno);
                echo $depteno;
                ?></td>
                </tr>
                <?php
            }
            ?>
            <tbody>
            </table>

  <?php }
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
               <a href="index.php?dashcolg"> 
                 <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                 <h4 class="font-weight-normal mb-3">College
                   <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                 </h4>
                 <h3 class="mb-5"><?php //echo $coleg['college'];?></h3>
                 <h6 class="card-text"></h6>
                 </a>
               </div>
             </div>
           </div>

           <div class="col-md-4 stretch-card grid-margin">
             <div class="card bg-gradient-info card-img-holder text-white">
               <div class="card-body">
               <a href="index.php?dashschl"> 
                 <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                 <h4 class="font-weight-normal mb-3">School 
                   <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                 </h4>
                 <h3 class="mb-5"><?php //echo $schl['school'];?></h3>
                 <h6 class="card-text"></h6>
                 </a>
               </div>
             </div>
           </div>
           
           <div class="col-md-4 stretch-card grid-margin">            
             <div class="card bg-gradient-success card-img-holder text-white">
               <div class="card-body">
               <a href="index.php?dashdept">  
               <img src="../../imagess/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                
                 <h4 class="font-weight-normal mb-3">Departments 
                   <i class="mdi mdi-diamond mdi-24px float-right"></i>
                 </h4>
                 <h3 class="mb-5"><?php //echo $depts['name'];?></h3>
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
<?php 
/*

 if(isset($_GET['Cancel']))
      {
        echo "The Staff Number you entered is incorrect, please Check for the correct Staff number and try again ";
        echo "<a href='logins.php'> Back</a>";
        exit();
      }
      */
$return_result = staff_data(@$_SESSION['username'], $logs);
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

$_SESSION['MM_Username'] = $data['number'];
$_SESSION['programme'] = $data['dept_id'];
$_SESSION['number'] = $data['number'];
$_SESSION['id_staff'] = $data['id'];
//$_SESSION['session'] = $data['session'];


/*

 if(isset($_GET['Ok']))
      {
        echo   '
        <div class="w3-col m7">

            <div class="w3-row-padding">
              <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                  <div class="w3-container w3-padding">
                    <h4>Comfirmation</h4>';

        echo "<a href='../../Login_v3/index.php'>Click here </a> if the Name, and Matric Number is not correct about you please verify your matric number and try login again  " ;

             echo '
             </div>
             </div>
             </div>
             </div>

             <div class="w3-col m7">

                 <div class="w3-row-padding">
                   <div class="w3-col m12">
                     <div class="w3-card w3-round w3-white">
                       <div class="w3-container w3-padding">
                         <h4>Change Your Password</h4>';

             echo "You need to change your passowrd" ;
             //echo "<a href=''></a>";
             echo '<a href="javascript:void(0);"
                  NAME="My Window Name"  title=" Change Password "
                  onClick=window.open("childpass.php","Ratting","width=550,height=170,0,status=0,");>
                  Click here to change your password</a>';

                  echo '</div></div></div></div>';


        exit();
      }
        */  ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
         <!-- <img src="../../imagess/faces/face1.jpg" alt="profile">-->
          <span class="login-status online"></span> <!--change to offline or busy as needed-->              
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2" style="font-size:small"> <?php  echo $data['names'];?></span>
          <span class="text-secondary text-small">Staff</span>
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
          $links_path = "s_profile_link.php?";
          $utid = $_SESSION["t_user"];
          include("menus_database.php");
          ?>
<!--

    <li class="nav-item">
      <a class="nav-link" href="s_profile_link.php?csvrn">
        <span class="menu-title">Import scores</span>
        <i class="mdi mdi-marker menu-icon"></i>
      </a>
    </li>
-->

  </ul>
</nav>
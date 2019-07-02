<?php
if (!isset($_SESSION))
{
  session_start();
  require_once('../../functions/queries.php');
  require_once('../../connections/connection.php');
}


$MM_restrictGoTo = "../../Login_v3/index.php";

if (!((isset($_SESSION['staffcomfirmed']))))
{
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
    if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
    $MM_referrer .= "?" . $QUERY_STRING;
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: ". $MM_restrictGoTo);
    exit;
  }


?>
<!DOCTYPE html>
<html>
<title>NSPZ Student Profile</title>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html;" />
<meta http-equiv="refresh" content="20; url='s_profile.php'" />
<link rel="icon" href="../../images/img2A.jpg" type="image/x-jpg">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../w3/w3.css">
<link rel="stylesheet" href="../../w3/w3-theme-blue-grey.css">
<link rel='stylesheet' href='../../w3/family.css'>
<link rel="stylesheet" href="../../w3/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <!--<a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><img src="images/img2A.jpg"></a>-->
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><img src="../../images/img2A.png"></a>
<span style="font-size:12pt" >Niger State Polytechnic,<br/> Zungeru</span>
  <div class="w3-dropdown-hover w3-hide-small" >


  </div>

  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="../../w3images/user.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
<span style="color:gold"><?php
if(@$_SESSION['staffcomfirmed'] == True){
  echo $_SESSION['staffcomfirmed'];
}
?>(Staff) </span> </a><br>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>
<br>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      
      <?php
      if(isset($_GET['Cancel']))
      {
        echo "The Staff Number you entered is incorrect, please Check for the correct Staff number and try again ";
        echo "<a href='logins.php'> Back</a>";
        exit();
      }
        $return_result = staff_data(@$_SESSION['staffcomfirmed'],$logs);
        $data = mysqli_fetch_assoc($return_result);

        ?>
      <div class="w3-card w3-round w3-white">
        <div class="w3-container" style="font-size:small">
         <h4 class="w3-center">My Profile</h4>
          <?php echo $data['names'];
                    $_SESSION['MM_Username'] = $data['number'];
                    $_SESSION['programme'] = $data['dept'];
                    $_SESSION['number'] = $data['number'];
                    $_SESSION['id_staff'] = $data['id'];
                    //$_SESSION['session'] = $data['session'];
          ?>
         <hr>

         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $data['number'];?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $data['dept'];?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo @$data['session'];?></p>
        </div>

      </div>
      <br>
      <?php
      if(isset($_GET['Ok']))
      {
        echo   ' </div>
        <div class="w3-col m7">

            <div class="w3-row-padding">
              <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                  <div class="w3-container w3-padding">
                    <h4>Comfirmation</h4>';

        echo "<a href='Login_v3/index.php'>Click here </a> if the Name, and Matric Number is not correct about you please verify your matric number and try login again  " ;

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
    ?>
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">

        <!--  <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Courses</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>
              <ul>
                <li><a href="stdprofile.php?Courses=1" src="">Semester 1</a></li>
                <li><a href="stdprofile.php?Courses=2" src="">Semester 2</a></li>
                <li><a href="stdprofile.php?Courses=3" src="">Semester 3</a></li>
                <li><a href="stdprofile.php?Courses=4" src="">Semester 4</a></li>
                <li><a href="stdprofile.php?Courses=0" src="">All Semester</a></li>
              </ul>
            </p>
          </div>
        -->
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Menu</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p><p>
              <ul>
                <li><a href="s_profile.php?importscore=1" src="">Import Scores</a></li>
                <li><a href="s_profile.php?Results=2" src="">Semester 2</a></li>
                <li><a href="s_profile.php?Results=3" src="">Semester 3</a></li>
                <li><a href="s_profile.php?Results=4" src="">Semester 4</a></li>
                <!--<li><a href="stdprofile.php?Results=0" src="">All Semester</a></li>-->
              </ul>
            <p></p>
          </div>

          <button onclick="myFunction('Demo4')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> <a href="../../Login_v3/logout.php?logout1">SignOut</a> </button>
          <div id="Demo4" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="../../w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="../../w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="../../w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/../../w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/../../w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>
      </div>
      <br>



      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Put somthing in here </strong></p>
        <!--<p>People are looking at your profile. Find out who.</p>-->
      </div>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">


      <!-- Set Result -->
        <?php if(isset($_POST['Submitf']))
        {
          ?>
          <div class="w3-container w3-card w3-white w3-round w3-margin">
            <br>
            <!--<img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            <span class="w3-right w3-opacity">16 min</span>-->
            <?php
          //if(isset($_GET['Results']))
          //{
              ?>
            <h4>Import Results </h4><br>
            <h6 class="w3-opacity"> </h6>
            <hr class="w3-clear">
        <?php
             
       		require_once('csvresn.php');
	      ?>
          </div>
        <?php
      }
      ?>
      <!-- End of Set Result -->

      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">

              <h4>Courses</h4>
              <h6 class="w3-opacity">Latest Result</h6>
              
              <?php
                           
              //require_once('RCS/courses.php');
				$msql = "SELECT * FROM `course` WHERE staff_id = '".$_SESSION['id_staff']."'";
				$msqls = mysqli_query($logs, $msql);
				?>
	<h4 style="color:red">Courses Allocated to <?php echo @$_SESSION['names']." (".@$_SESSION['number'].")";?></h4>
	
		<div>
			<table style="width:100%">
				
						
			<?php 
			$in = 0;
			while($col = mysqli_fetch_assoc($msqls)){ $in++;?>
				<tr>
				<td colspan="4">
					<form name="form<?php echo $in;?>" method="post" action="">
								<div>
									<?php echo $in;?>
										&nbsp;&nbsp;<button style="width:70px; font-size:8pt" name="Submitf"><?php echo $col['code'];?></button>
										&nbsp;&nbsp;<input type="text" value="<?php echo $col['title'];?>" style="width:250px; font-size:8pt" disabled="disabled">
										&nbsp;&nbsp;<input type="text" value="<?php echo $col['unit'];?>" style="width:40px; font-size:8pt" disabled="disabled">
										<input type="hidden" value="<?php echo $col['semester'];?>" name="semester"> 
										<input type="hidden" value="<?php echo $col['sessions'];?>" name="session">
										<input type="hidden" value="<?php echo $col['Programme'];?>" name="programme">
										<input type="hidden" value="<?php echo $col['code'];?>" name="code">

								</div>
					</form>
				</td>
				</tr>
				<?php }?>
			</table>
			<br>
		<div>
			<!--<button name="Resets">Reset</button>--></div>
		</div>
	

            
           
              <hr class="w3-clear">


            </div>
          </div>
        </div>
      </div>

      <!-- Set Courses -->
      <?php if(@$_GET['Courses']==True){?>
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
      <!--  <img src="/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">1 min</span>-->

        <h4>Courses  </h4><br>
        <hr class="w3-clear">
      </div>
    <?php }?>
      <!-- End of Set Courses -->



      <!-- End Middle Column -->
    </div>

    <!-- Right Column -->

    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">

        <div class="w3-container">
			<?php //require_once('RCS/calculate_gp.php') ?>

          <p>Updates</p>
          <!--<img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">-->
          <div class="w3-half">
           <!-- <button class="w3-button w3-block w3-blue-grey w3-section" title="Accept"><i class="fa"><?php echo @$unit; ?></i></button>-->
          </div>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Scedules </p>
          <!--<img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>-->
          <div class="w3-half">
            <!--<button class="w3-button w3-block w3-blue-grey w3-section" title="Decline"><i class="fa"><?php echo @$gp;?></i></button>-->
          </div>
          <div class="w3-row w3-opacity">


          </div>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Todo List</p>
          <!--<img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>-->
          <div class="w3-half">
            <!--<button class="w3-button w3-block w3-blue-grey w3-section" title="Decline"><i class="fa"><?php echo @$gpa;?></i></button>-->
          </div>
          <div class="w3-row w3-opacity">


          </div>
        </div>
      </div>
      <br>
      <!-- End Right Column -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Page Container -->
  <br>
</div>
<br>
<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else {
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className =
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>

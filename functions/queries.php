<?php
         function students_login($username, $password, $lg) {
           //require_once('connection.php');
           $query = "SELECT * FROM nigerpol_consultdbsnw.students_log WHERE matric_no='".$username."' && password='".$password."'";
           $result = mysqli_query($lg, $query)or die(mysqli_error($logs)."query error");

          return $result;
           }
           
           // student login confirmation 
           
           function login_comfirm($username, $password,$lg) {
             //require_once('connection.php');
             $query = "SELECT * FROM nigerpol_consultdbsnw.studentsnm WHERE matno='".$username."'";
             $result_comfirm = mysqli_query($lg, $query)or die(mysqli_error($lg)."query error");
             //function login_comfirm($username, $lg) {
            // $query = "SELECT * FROM nigerpol_consultdbsnw.studentsnm WHERE matno='".$username."'";
            // $result_comfirm = mysqli_query($lg, $query)or die(mysqli_error($logs)."query error");
            return $result_comfirm;
             }
             
             // staff login confirmation
             
  			 function login_scomfirm($username, $password,$lg) {
             //require_once('connection.php');
             $query = "SELECT * FROM nigerpol_consultdbsnw.staff WHERE number='".$username."'";
             $result_comfirm = mysqli_query($lg, $query)or die(mysqli_error($lg)."query error");
             return $result_comfirm;
             }



           function students_data($username,$lg) {
             //require_once('connection.php');
             $query = "SELECT * FROM nigerpol_consultdbsnw.studentsnm WHERE matno = '".$username."'";
             $result_data = mysqli_query($lg, $query) or die(mysqli_error($lg)."query error");

            return $result_data;
             }

             function students_result($programme,$lg) {
               //require_once('connection.php');
               $query = "SELECT * FROM nigerpol_consultdbsnw.course; WHERE Programme='".$programme."'";
               $result_data = mysqli_query($lg, $query)or die(mysqli_error($lg)."query error");

              return $result_data;
               }

               function students_accom($rgn,$lg)
               {
                 //require_once('connection.php');
                 $gnd = mysqli_query($lg, "SELECT * FROM `students` WHERE regno ='".$rgn."'") or die(mysqli_error($lg));
                 //$gend = mysqli_fetch_assoc($gnd);
                 return $gnd;
               }


              function current_session($lg)
              {
                $qq = mysqli_query($lg, "SELECT * FROM `session`") or die(mysql_error());
                return $qq;

              }



              function calculate_gp($conn, $course, $sem, $mat)
              {
                $gqry = "SELECT * FROM results WHERE programme='$course' && semester='$sem' && matric_no='$mat'";
                $sql= mysqli_query($conn,$gqry) or die (mysqli_error());
                return $sql;

              }

              function calculate_gp_all($conn, $course, $mat)
              {
                $gqry = "SELECT * FROM results WHERE programme='$course' && matric_no='$mat'";
            		$sql= mysqli_query($conn,$gqry) or die (mysqli_error());
                return $sql;

              }

try {
              function make_change_pass($userid, $password, $lg)
              {
                //$query = mysqli_query($lg, "update students_log set passowrd = ? where username = ?") or die(mysql_error());

                $sql = "UPDATE `students_log` SET `password` = ? WHERE `students_log`.`id` = ?";
                $stmt = mysqli_prepare($lg, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $password, $userid);
                $stmts = mysqli_stmt_execute($stmt);

                return $stmts;

              }
              
              //change staff password
               function make_change_spass($userid, $password, $lg)
              {
                
                $sql = "UPDATE `logintbl` SET `password` = ? WHERE `logintbl`.`id` = ?";
                $stmt = mysqli_prepare($lg, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $password, $userid);
                $stmts = mysqli_stmt_execute($stmt);

                return $stmts;

              }

              
    } catch(Exception $e) {
      throw $e;
      }




 		 function staff_data($username,$lg) {
             //require_once('connection.php');
             $query = "SELECT * FROM nigerpol_consultdbsnw.staff WHERE number = '".$username."'";
             $result_data = mysqli_query($lg, $query) or die(mysqli_error($lg)."query error");

            return $result_data;
             }

// allocation page 

         function staff_alloc($departmentcode, $lg) {
           //require_once('connection.php');
        	$qry = "SELECT * FROM `staff` WHERE `dept` = '$departmentcode'";
			$result = mysqli_query($lg, $qry) or die(mysqli_error($lg)."query error");
         	return $result;
           }
// get all courses   
           function t_courses($course, $lg) {
            $ssql = "SELECT *  FROM course WHERE `programme` LIKE '$course'";
			$msq = mysqli_query($lg, $ssql) or die(mysqli_error());
			return $msq;
           }
// get the department name
		   function programme($departmentcode, $lg) {
           $ssql = "SELECT * FROM `dept` WHERE	 `prog` = '$departmentcode'";
			$msq = mysqli_query($lg, $ssql) or die(mysqli_error());
			return $msq;
           }


      ?>

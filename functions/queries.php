<?php
//studentnm data 

function the_menu_control($logs, $programme, $year)
{
  $query = "SELECT * FROM `studentsnm` 
            WHERE prog_id = ? &&  year = ?  && Withdrwan ='0' 
            ORDER BY length(matno),matno ASC";

  $stmt = mysqli_prepare($logs,$query) or die(mysqli_error($logs). "menu control Error");

  mysqli_stmt_bind_param($stmt, "ss", $programme, $year);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  return $result;
}


// the chronocle 
function the_chronicle($logs)
{
  $query = "SELECT * 
            FROM `chronicle`";

  $stmt = mysqli_prepare($logs,$query) or die(mysqli_error($logs). "the chronicle error");
  //mysqli_stmt_bind_param($stmt, "s", $utid);
  mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
  return $result;
}

// menu control 

function the_menu_control($logs, $utid)
{
  $query = "SELECT `menu_id`, `menu_name`, `status` 
            FROM `menu_control`  
            WHERE  `user_type_id` = ?";
  $stmt = mysqli_prepare($logs,$query) or die(mysqli_error($logs). "menu control Error");
  mysqli_stmt_bind_param($stmt, "s", $utid);
  mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);


  return $result;


}

// submneu control 

function the_sub_menu_control($logs, $menu_id)
{
  $query = "SELECT s_menu_id, s_menu_name, xtension, `status` 
            FROM sub_menu_control 
            WHERE menu_id = ?";
  $stmt = mysqli_prepare($logs, $query) or die(mysqli_error($logs). "menu control Error");
  mysqli_stmt_bind_param($stmt, "s", $menu_id);
  mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);


  return $result;

}

// menu control 

function menu_control($logs, $utid)
{
  $query = "SELECT `menu_id`, `menu_name`, `status` 
            FROM `menu_control`  
            WHERE  `user_type_id` = ? && `status` != 0";
  $stmt = mysqli_prepare($logs,$query) or die(mysqli_error($logs). "menu control Error");
  mysqli_stmt_bind_param($stmt, "s", $utid);
  mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);


  return $result;


}

// submneu control 

function sub_menu_control($logs, $menu_id)
{
  $query = "SELECT s_menu_id, s_menu_name, xtension, `status` 
            FROM sub_menu_control 
            WHERE menu_id = ?  && `status` != 0";
  $stmt = mysqli_prepare($logs, $query) or die(mysqli_error($logs). "menu control Error");
  mysqli_stmt_bind_param($stmt, "s", $menu_id);
  mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);


  return $result;

}

// menu update 

function menu_update($logs, $menu_id, $mencheck)
{
   $sql = "UPDATE `menu_control` SET `status` = ? WHERE `menu_id` = ?";
   $stmt = mysqli_prepare($logs, $sql);
   mysqli_stmt_bind_param($stmt, "ii", $mencheck, $menu_id);
   $stmts = mysqli_stmt_execute($stmt);
   return $stmts;
 
}

// sub menu update 

function submenu_update($logs, $s_menu_id, $s_mencheck)
{

  $sql = "UPDATE `sub_menu_control` SET `status` = ? WHERE `s_menu_id` = ?";
  $stmt = mysqli_prepare($logs, $sql);
  mysqli_stmt_bind_param($stmt, "ii", $s_mencheck, $s_menu_id);
  $stmts = mysqli_stmt_execute($stmt);
  return $stmts;
}

function students_login($username, $password, $lg) 
{
  $query = "SELECT id, matric_no, password, status FROM students_log WHERE matric_no=?";
  $stmt = mysqli_prepare($lg, $query) or die(mysqli_error($logs)."query error");
  /* bind parameters for markers */
  mysqli_stmt_bind_param($stmt, "s", $username);
  /* execute query */
  //mysqli_stmt_store_result($stmt);
  return $stmt;
}

// student login confirmation 
function login_comfirm($username, $password, $lg) 
{
  //require_once('connection.php');
  $query = "SELECT sn, names, matno, prog_id, year, session, status FROM studentsnm WHERE matno=?";
  $stmt = mysqli_prepare($lg, $query) or die(mysqli_error($lg)."query error");
  mysqli_stmt_bind_param($stmt, "s", $username);
  /* execute query */
  // mysqli_stmt_bind_result($stmt);
  mysqli_stmt_store_result($stmt);
  return $stmt;
}

// staff login confirmation
function login_scomfirm($username, $logs) 
{
  //require_once('connection.php');
  $query = "SELECT id, names, number, contact, dept_id 
  FROM staff WHERE number=?";
  $stmt = mysqli_prepare($logs, $query) or die(mysqli_error($logs)."query error");
  mysqli_stmt_bind_param($stmt, "s", $username);
  /* execute query */
  mysqli_stmt_store_result($stmt);
  //mysqli_execute($stmt);
  return $stmt;
}

function students_data($username,$lg) 
{
  //require_once('connection.php');
  $query = "SELECT * FROM studentsnm WHERE matno = '".$username."'";
  $result_data = mysqli_query($lg, $query) or die(mysqli_error($lg)."query error");

  return $result_data;
}

function students_result($programme,$lg) 
{
  //require_once('connection.php');
  $query = "SELECT * FROM course; WHERE Programme='".$programme."'";
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
  $gqry = "SELECT * FROM results WHERE prog_id='$course' && semester='$sem' && matric_no='$mat'";
  $sql= mysqli_query($conn,$gqry) or die (mysqli_error());
  return $sql;
}

function calculate_gp_all($conn, $course, $mat)
{
  $gqry = "SELECT * FROM results WHERE prog_id='$course' && matric_no='$mat'";
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

function staff_data($username,$lg) 
{
  //require_once('connection.php');
  $query = "SELECT * FROM staff WHERE number = '".$username."'";
  $result_data = mysqli_query($lg, $query) or die(mysqli_error($lg)."query error");

  return $result_data;
}

// allocation page 

function staff_alloc($departmentcode, $lg)
{
  //require_once('connection.php');
  $qry = "SELECT * FROM `staff` WHERE `dept_id` = '$departmentcode'";
  $result = mysqli_query($lg, $qry) or die(mysqli_error($lg)."query error");
  return $result;
}
// get all courses   
function t_courses($course, $lg) 
{
  $ssql = "SELECT * FROM course WHERE `prog_id` = '$course'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error($lg));
  return $msq;
}
// get the department name
function programme($departmentcode, $lg) 
{
  $ssql = "SELECT * FROM `dept` WHERE	 `prog` = '$departmentcode'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error($lg));
  return $msq;
}

function departments($deptid, $lg) 
{

  $stmt1 = $lg->prepare("SELECT * FROM `departments` WHERE `dept_id` = ?");
  $stmt1->bind_param("s", $deptid);
  $stmt1->execute();
  $result1 = $stmt1->get_result();
  //$msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  $schlid = $result1->fetch_assoc();
  return $schlid;
} 

function schools($schlid, $lg) 
{
 

$stmt2 = $lg->prepare("SELECT * FROM `schools` WHERE schl_id = ?");
$stmt2->bind_param("s", $schlid);
$stmt2->execute();
$result2 = $stmt2->get_result();
$clgid = $result2->fetch_assoc();
//$msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  return $clgid;
}

function colleges($collegeid, $lg) 
{
  
$stmt3 = $lg->prepare("SELECT * FROM `colleges` WHERE college_id = ?");
$stmt3->bind_param("s", $collegeid);
$stmt3->execute();
$result3 = $stmt3->get_result();
$clg = $result3->fetch_assoc();
 // $msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  return $clg;
}


function programmes($deptid, $lg) 
{
  $ssql = "SELECT * FROM `programmes` WHERE `prog_id` = '$deptid'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  return $msq;  
}

function departmentss($deptid, $lg) 
{
  $ssql = "SELECT * FROM `departments` WHERE `dept_id` = '$deptid'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  return $msq;  
}

function schoolss($schlid, $lg) 
{
  $ssql = "SELECT * FROM `schools` WHERE schl_id = '$schlid'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  return $msq;  
}

function collegess($collegeid, $lg) 
{
  $ssql = "SELECT * FROM `colleges` WHERE college_id = '$collegeid'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  return $msq;  
}


function user_type($lg)
{
  $utype = "SELECT * FROM `usertype`";
  $msq = mysqli_query($lg, $utype) or die(mysqli_error($lg));
  return $msq;  
}


function departments_code($code, $lg) 
{
 

  $msq = mysqli_prepare($lg, "SELECT * FROM `departments` WHERE `code` = ?")
  or die(mysqli_error($lg));
  mysqli_stmt_bind_param($msq, "s", $code);
  
  mysqli_stmt_execute($msq);
  $result = mysqli_stmt_get_result($msq);

  return $result;  
}

function programmess_dept($deptid, $lg) 
{
  $ssql = "SELECT * FROM `programmes` WHERE `dept_id` = '$deptid'";
  $msq = mysqli_query($lg, $ssql) or die(mysqli_error());
  /*
  $msq = mysqli_prepare($lg, "SELECT * FROM `programmes` WHERE `dept_id` = ?") 
  or die(mysqli_error());
  mysqli_stmt_bind_param($msq, "s", $deptid);
  mysqli_stmt_execute($msq);
  $result = mysqli_stmt_get_result($msq);
  //$msq = mysqli_query($lg, $ssql   '$deptid'
  */
  return $msq;  
}


function prog_function($logs)
{
  
  $prgqry = mysqli_query($logs, "SELECT prog_id, programme FROM `programmes`") or die(mysqli_error($logs));
  //$prgasc = mysqli_fetch_assoc($prgqry);
  return $prgqry;
}

// keep logs 

function chronicles($logs, $table_id, $tablename, $action, $whoid, $whoname)
{

  $chronic = mysqli_prepare($logs, "INSERT INTO `chronicle` (`table_id`, `tablename`, `action`, `whoid`, `whoname`, `ddate`, `dtime`) VALUES (?,?,?,?,?,?,?)");
  if (!$chronic)
  {
    die(mysqli_error($logs));
  }else{ 
  mysqli_stmt_bind_param($chronic, "ississs", $table_id, $tablename, $action, $whoid, $whoname, $ddate, $dtime);
  
  $ddate = date("d-m-Y");
  $dtime = date("H:i:sa");
  $chronics = mysqli_stmt_execute($chronic);
  }
  return $chronics;
}

function select_logintbl($conn, $username)
{
  $stmt = mysqli_prepare($conn, "SELECT `status` FROM `logintbl` WHERE `username` = ?");
  if(!$stmt)
  {
    die(mysqli_error($conn));
  }
  else
  {
   // $stmt = mysqli_stmt_bind_param($stmt, "s", $username);
     //mysqli_stmt_execute($stmt);
  }
  return $stmt;
}

function select_entered($conn, $code, $unit, $prog_id, $semester, $session)
{
  $stmt = mysqli_prepare($conn, "SELECT * FROM `entered` 
  WHERE `code` = ? && `unit`=? && `prog_id`=? & `semester`=? && `session`=?");
  if(!$stmt)
  {
    die(mysqli_error($conn));
  }
  else
  {
    mysqli_stmt_bind_param($stmt, "sisss", $code, $unit, $prog_id, $semester, $session);
    mysqli_stmt_execute($stmt);

  }
  return $stmt;
}

  ?>
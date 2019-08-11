<?php 


            $the_user = $_SESSION['MM_Usernames'];

             $stmt = select_logintbl($conn, $the_user);
             mysqli_stmt_bind_param($stmt, "s", $the_user);
  //$stmt = mysqli_prepare($conn, "SELECT `status` FROM `logintbl` WHERE `username` = ?");
  //mysqli_stmt_bind_param($stmt, "s", $username);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $status);
              mysqli_stmt_store_result($stmt);
              mysqli_stmt_fetch($stmt);
//            if (mysqli_insert_id($logs))
            //{//
                $stff = login_scomfirm($status, $logs);
                //mysqli_stmt_bind_param($stff, "s", $uname);
                mysqli_stmt_execute($stff);
                mysqli_stmt_bind_result($stff, $stfid, $name, $number, $contact, $dept_id);
                mysqli_stmt_store_result($stff);
                mysqli_stmt_fetch($stff);

              $table_id = $lids;
              $tablename = "results";
              $whoid = $stfid;
              $whoname = $number;
              $ddate = date("Y-m-d");
              $dtime = date("h:i:sa");
             chronicles($logs, $table_id, $tablename, $action, $whoid, $whoname);

 //$chronic = mysqli_query($logs, "INSERT INTO `chronicle` (`table_id`, `tablename`, `action`, `whoid`, `whoname`, `ddate`, `dtime`) 
 //VALUES ('$table_id', '$tablename', '$action', '$whoid', '$whoname','$ddate','$dtime')") or  die(mysqli_error($logs));
  //}//
         //   }
            ?>
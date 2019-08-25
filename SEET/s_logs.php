<?php

if (!isset($_SESSION))
{
  session_start();
}

$studentdata = login_comfirm($loginUsername, $password,$logs);
mysqli_stmt_execute($studentdata);
mysqli_stmt_bind_result($studentdata, $sn, $names, $matno, $prog_id, $year, $session, $status);
mysqli_stmt_store_result($studentdata);
mysqli_stmt_fetch($studentdata);



$Myquery = "SELECT id, matric_no, password, status FROM students_log WHERE matric_no='$loginUsername'";
$mystmt = mysqli_query($logs, $Myquery) or die(mysqli_error($logs)."query error");


  $test_password = mysqli_fetch_assoc($mystmt);
  $test_p = $test_password["password"];
  $id = $test_password["id"];
  
$_SESSION['stid'] = $id;
$_SESSION['myaidi'] =  $id;
$_SESSION['utyp'] =  "Student";

if (password_verify($password, $test_p)) 
{

  if($password == "Eeasy0123")
  {
    $return_comfirm = login_comfirm($loginUsername, $password, $logs);
    mysqli_stmt_execute($return_comfirm);
    mysqli_stmt_bind_result($return_comfirm, $sn, $names, $matno, $prog_id, $year, $session, $status);
    mysqli_stmt_store_result($return_comfirm);
    mysqli_stmt_fetch($return_comfirm);

    echo $loginUsername."<br>";

    echo $names;
    // $comfirm = mysqli_fetch_assoc($return_comfirm);
    //echo ;
    //      javascript function to comfirm new user entry
    echo '<p>Click the button to Comfirm that ('.$names.') is your name</p>';

    echo '<button onclick="myFunction()">Comfirm</button>
    <p id="demo"></p>
    <script>
    var fname ;
    var othername;
    function myFunction() {
    var txt;
    var fname = "'.$names.'";
    var r = confirm("is this your name? \n " + fname + "\nclick OK for Yes and Cancel for No");
    if (r == true) {
    txt = "";
    window.location.href = "../stdprofile2.php?Ok";
    } else {
    txt = "";
    alert("The Matric Number you entered is incorrect, \nPlease Check for the correct matric number and try again");
    window.location.href = "index.php";

    }
    document.getElementById("demo").innerHTML = txt;
    }
    </script>';
    //$loginUsername, $password
    $_SESSION['comfirmuser'] = $loginUsername;
    exit();
  }
  else
  {

    $_SESSION['usercomfirmed'] = $loginUsername;
    //keep user logs
    $table_id = $id;
    $tablename = "students_log";
    $action = "Login";
    $whoid = $sn;
    $whoname = $matric_no;
    
    $ddate = date("Y-m-d");
    $dtime = date("h:i:sa");

    $chronic = mysqli_query($logs, "INSERT INTO `chronicle` 
    (
      `table_id`, 
      `tablename`, 
      `action`, 
      `whoid`, 
      `whoname`, 
      `ddate`, 
      `dtime`
    ) VALUES 
    (
    '$table_id',
    '$tablename',
    '$action',
    '$whoid',
    '$whoname',
    '$ddate',
    '$dtime'
    )
    ") or  die(mysqli_error($logs));

   if (mysqli_insert_id($logs)){
     
      header("location:../stdprofile.php");

   }else{
      die ("Temporary Out of service");
    }
   
  }

}
else 
{
	echo '<script type="text/javascript">
	alert("incorrect login");
	location.replace("logins.php");
	</script>';
}
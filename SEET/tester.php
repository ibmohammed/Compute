
<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>
<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_logs = "localhost";
$database_logs = "nigerpol_consultdbsnw";
$username_logs = "nigerpol_root";
$password_logs = "number012345@";


$logs = mysqli_connect($hostname_logs, $username_logs, $password_logs, $database_logs);
// Check connection
if (!$logs) {
    die("Connection failed: " . mysqli_connect_error());
}

//SELECT id, username, password , progs FROM  `logintbl` 
$sql = "SELECT id, username, password , progs FROM  `logintbl`";
$result = mysqli_query($logs, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - UserName / password: " . $row["username"]. " " . $row["password"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($logs);
?> 


</body>

</html>

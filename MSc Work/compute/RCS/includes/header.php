<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_logs = "localhost";
$database_logs = "nigerpol_consultdbsnw";
$username_logs = "nigerpol_root";
$password_logs = "number012345@";


$conn = mysqli_connect($hostname_logs, $username_logs, $password_logs, $database_logs);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
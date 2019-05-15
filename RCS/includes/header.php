<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_logs = "localhost";
$database_logs = "nigerpol_consultdbsnw";
$username_logs = "root";
$password_logs = "";


$conn = mysqli_connect($hostname_logs, $username_logs, $password_logs, $database_logs);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
 
/* Attempt to connect to MySQL database *
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
*/



?>
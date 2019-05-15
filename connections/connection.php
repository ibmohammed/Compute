<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_logs = "localhost";
$database_logs = "nigerpol_consultdbsnw";
$username_logs = "root";
$password_logs = "";

//$logs = mysqli_connect($hostname_logs, $username_logs, $password_logs, $database_logs)or trigger_error(mysql_error(),E_USER_ERROR);
//$logs = mysql_connect($hostname_logs, $username_logs, $password_logs) or trigger_error(mysql_error(),E_USER_ERROR);

$logs = new mysqli($hostname_logs, $username_logs, $password_logs, $database_logs);
// Check connection
if ($logs->connect_error) {
    die("Connection failed: " . $logs->connect_error);
}


/* Attempt to connect to MySQL database 

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'nigerpol_consultdbsnw');
 

$logs = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

*/

?>

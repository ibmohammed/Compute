<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cosreg = "localhost";
$database_cosreg = "consultdbsnw";
$username_cosreg = "root";
$password_cosreg = "";
$cosreg = mysql_pconnect($hostname_cosreg, $username_cosreg, $password_cosreg) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php

// Set database access information as constants:
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');
define('DB_NAME','squashr');

// Make connection
$dbLink = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or 
        die('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding
mysqli_set_charset($dbLink,'utf8');
?>
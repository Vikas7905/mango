<?php

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'root');
define('DB_NAME', 'mangodb');


// define('DB_SERVER','localhost');
// define('DB_USER','glintqnj_gauriaam');
// define('DB_PASS' ,'12qw!@QW2024');
// define('DB_NAME', 'glintqnj_gauriaam');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
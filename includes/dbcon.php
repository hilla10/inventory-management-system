<?php
if (!defined('HOSTNAME')) define('HOSTNAME', 'localhost');
if (!defined('USERNAME')) define('USERNAME', 'root');
if (!defined('PASSWORD')) define('PASSWORD', '');
if (!defined('DATABASE')) define('DATABASE', 'inventory');

// Database connection
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

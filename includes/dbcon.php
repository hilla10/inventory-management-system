<?php
// Database configuration
if (!defined('HOSTNAME')) define('HOSTNAME', 'localhost');
if (!defined('USERNAME')) define('USERNAME', 'root');
if (!defined('PASSWORD')) define('PASSWORD', '');
if (!defined('DATABASE')) define('DATABASE', 'inventory');

// Attempt to connect to the database
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Optionally, you can set character set and collation
mysqli_set_charset($connection, 'utf8mb4');

// You can now use $connection for database queries
?>

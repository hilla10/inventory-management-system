<?php

    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
define("PASSWORD", "");
    define("DATABASE", "inventory");

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if(!$connection) {
    die("Connection Failed: " .mysqli_connect_error());
}

?>
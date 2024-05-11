<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "login_form");

$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if(!$con) {
    die("Connection Failed");
}

?>
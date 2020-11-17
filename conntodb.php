<?php

$config = parse_ini_file('../../private/db-config.ini');
$link = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

if ($link->connect_error) {
    $errorMsg = "Connection failed: " . $link->connect_error;
    echo $errorMsg;
    $success = false;
} 
?>
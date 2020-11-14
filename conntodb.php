<?php

$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], "project1004");

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    echo $errorMsg;
    $success = false;
} 
?>
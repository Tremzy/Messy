<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);    
    $conn = new mysqli("host", "username", "password", "db_name", "port");
    $conn->set_charset("utf8mb4");

    if($conn->connect_errno) {
        echo "<h1>Error: ".$conn->connect_error."</h1>";
        exit();
    }
    else {
        //
    }
?>
<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if(isset($_POST["user"])) {
        include "database.php";
        $user = $_POST["user"];
        $ip = $_POST["ip"];
        $delete = $conn->query("DELETE FROM users WHERE username = \"{$user}\"");
        $insert = $conn->query("INSERT INTO banned_ips (ip) VALUES (\"{$ip}\")");
        $deletemessages = $conn->query("DELETE FROM chat WHERE user = \"{$user}\"");
    }
    else {
        echo "error";
    }
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "database.php";
if(!isset($_COOKIE["username"])) {
    $timenow = time();
    $userpassword = rand(100, 100000).date("Ymd");
    $usernameid = "user".rand(10, 10000);
    $ip = $_POST["ip"];
    $insert = $conn->query("INSERT INTO users (username, password, ip, admin) VALUES (\"{$usernameid}\", \"{$userpassword}\", \"{$ip}\", 0)");
    $select = $conn->query("SELECT * FROM users");
    setcookie("username", "{$usernameid}", 0);
}
?>
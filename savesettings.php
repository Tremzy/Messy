<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //savesettings.php
    if (isset($_POST["username"])) {
        $username = htmlspecialchars($_POST["username"]);
        include "database.php";
        $userpassword = rand(100, 100000).date("Ymd");
        $usernameid = $_POST["username"];
        $lastusername = $_COOKIE["username"];
        $insert = $conn->query("UPDATE users SET username = \"{$usernameid}\" WHERE username = \"{$lastusername}\"");
        setcookie("username", $username, 0, "/");
        echo "ok";
    }
    else {
        echo "error";
    }
?>
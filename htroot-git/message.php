<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if(isset($_POST["user_message"])){
        $message = htmlspecialchars($_POST["user_message"]);
        $messageuser = $_COOKIE["username"];
        $timenow = time();
        $datenow = date("Y/M/D/H:i");
        include "database.php";
        $insert = $conn->query("INSERT INTO chat (user, text, date, time) VALUES (\"{$messageuser}\", \"{$message}\", \"{$datenow}\", \"{$timenow}\")");
        echo "ok";
    }
    else{
        echo "error";
    }
?>
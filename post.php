<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if(isset($_POST["posttitle"])) {
        $posttitle = htmlspecialchars($_POST["posttitle"]);
        $postdesc = htmlspecialchars($_POST["postdesc"]);
        $postuser = $_COOKIE["username"];
        $timenow = time();
        $datenow = date("Y/M/D/H:i");
        include "database.php";
        $insert = $conn->query("INSERT INTO posts (user, title, description, date, time) VALUES (\"{$postuser}\", \"{$posttitle}\", \"{$postdesc}\", \"{$datenow}\", {$timenow})");
        echo "ok";
    }
    else {
        echo "error";
    }
?>
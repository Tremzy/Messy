<?php
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["ip"])) {
        include "database.php";
        $username = $_POST["username"];
        $password = $_POST['password'];
        $ip = $_POST["ip"];
        $select = $conn->query("SELECT username, password FROM users");
        $found = false;
        while ($selected = $select->fetch_assoc()) {
            if ($username == $selected["username"] && $password == $selected["password"]) {
                $found = true;
            }
        }
        if ($found == true) {
            setcookie("username", $username, 0, "/");
            echo "logged_in";
        }
        else {
            echo "invalid";
        }
    }
    else {
        echo "error";
    }
?>
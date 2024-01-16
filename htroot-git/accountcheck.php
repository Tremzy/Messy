<?php
include "database.php";
if ($_COOKIE) {
    if (isset($_POST["ip"])) {
        $select = $conn->query("SELECT * FROM users");
        while ($selected = $select->fetch_assoc()) {
            if ($selected["username"] == $_COOKIE["username"]) {
                if ($selected["ip"] == $_POST["ip"]) {
                    die();
                } else {
                    $update = $conn->query("UPDATE users SET ip = \"{$_POST["ip"]}\" WHERE username = \"{$_COOKIE["username"]}\"");
                }
            }
        }
    } else {
        echo "error";
    }
} else {
    include "cookie.php";
}


?>
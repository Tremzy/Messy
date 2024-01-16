<?php
include "database.php";
    if (isset($_POST["ip"])){
        $ipaddr = $_POST["ip"];
        $insert = $conn->query("SELECT * FROM banned_ips");
        while($selected = $insert->fetch_assoc()) {
            if ($selected["ip"] == $ipaddr) {
                echo "banned";
                die();
            }
        }
    }
    else {
        echo "error";
    }
?>
<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    function banCheck($ip) {
        include "database.php";
        $select = $conn->query("SELECT * FROM users");
        while($selected = $select->fetch_assoc()) {
            if ($selected["ip"] == $ip) {
                return true;
            }
        }
        return false;
    }
?>
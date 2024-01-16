<?php
    include "database.php";
    $select = $conn->query("SELECT * FROM users");
    while($selected = $select->fetch_assoc()){
        if ($_COOKIE["username"] == $selected["username"]) {
            if ($selected["admin"] == 1) {
                echo $selected["username"];
                echo $_COOKIE["username"];
                echo $selected["admin"];
                header("Location: indexadmin.php");
            }
        }
    }
?>
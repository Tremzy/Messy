<?php
    include "database.php";
    $conn->set_charset("utf8mb4");
    $select = $conn->query("SELECT * FROM posts ORDER BY time DESC");
    while ($selected = $select->fetch_assoc()) {
        //print_r($selected);
        echo "<div style='margin: 2rem; padding: 3rem; border: 2px solid #fff; border-radius: 0.3rem; width: 10rem'><h2>".$selected["user"]." -> ".$selected["title"]."</h2>".$selected["description"]."<p style='font-size: 15px; margin-bottom: 0.3rem; position: relative; top: 2rem; left: 3rem'>({$selected['date']})</p></div>";
        echo "<br>";
    }
?>
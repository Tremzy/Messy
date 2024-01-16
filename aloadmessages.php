<?php
    include "database.php";
    $select = $conn->query("SELECT * FROM chat ORDER BY time DESC");
    while ($selected = $select->fetch_assoc()) {
        echo $selected["user"].": ".$selected["text"]."<button style='margin-left: 1rem' onclick='banUser(\"".$selected['user']."\")'>Ban</button>"."<p style='font-size: 15px; margin-bottom: 0.3rem; margin-top: 0.1rem'>({$selected['date']})</p>";
        echo "<br>";
    }
?>
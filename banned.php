<?php   

    include "database.php";
    $select = $conn->query("SELECT * FROM banned_ips");
    $found = false;
    while($selected = $select->fetch_assoc()) {
        if ($_POST["ip"] == $selected["ip"]) {
            $found = true;
        }
    }
    if ($found != true) {
        header("Location: index.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #6699ff;
        }
    </style>
</head>
<body>
    <div style="justify-content: center; align-items: center; display: flex; flex-direction: column; font-size: 30px">
        <h1>You have been banned from this site</h1>
    </div>
</body>
</html>
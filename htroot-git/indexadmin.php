<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    include "database.php";
    //include "admincheck" ->
    $select = $conn->query("SELECT * FROM users");
    while($selected = $select->fetch_assoc()){
        if ($_COOKIE["username"] == $selected["username"]) {
            if ($selected["admin"] == 0) {
                echo $selected["username"];
                echo $_COOKIE["username"];
                echo $selected["admin"];
                header("Location: index.php");
            }
        }
    }
?>
<script>       
    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => sendIP(data.ip));
    function sendIP(ip) {
        console.log(ip);
        var xhr = new XMLHttpRequest();
        var xhr1 = new XMLHttpRequest();
        var xhr2 = new XMLHttpRequest();

        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                if (this.responseText == "banned") {
                    window.location.href = "banned.php"
                }
            }
        };

        xhr1.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
            }
        };

        xhr2.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
            }
        };

        var params = "ip="+encodeURIComponent(ip);
        xhr.open("POST", "/bancheck.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
        xhr1.open("POST", "/cookie.php", true);
        xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr1.send(params);
        xhr2.open("POST", "/accountcheck.php", true);
        xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr2.send(params);
    }
</script>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MessY</title>
    <style>
        body {
            background-color: #6699ff;
        }
    </style>
</head>
<body>
    <div style="justify-content: center; align-items: center; display: flex; flex-direction: column; font-size: 30px">
        <?php
        include "database.php";
        echo "<h1>Global chat</h1>";
        echo "Date: ".date("Y/d/m h:i")."<br><br>";
        $currentuser = $_COOKIE["username"];
        echo "<h3>Current user: {$currentuser}</h3>";
        ?>
    </div>
    <div style="font-size: 25px; padding: 1rem">
        <button type="submit" name="settings" onclick="window.location.href='settings.php'">Settings</button>
        <button type="submit" name="forum" onclick="window.location.href='forum.php'">Forum</button>
        <form action="" id="submitbtn">
                <input type="text" name="user_message" id="user_message">
                <input type="submit" value="Submit" onclick="sendPost()">
        </form>
        <div style="padding: 1rem" id="chat">
            <?php
            /*
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $message = $_POST["user_message"];
                $timenow = time();
                $datenow = date("Y/M/D/H:i");
                $conn->query("INSERT INTO chat (user, text, date, time) VALUES (\"{$_COOKIE['username']}\", \"{$message}\", \"{$datenow}\", \"{$timenow}\")");
                */
                $select = $conn->query("SELECT * FROM chat ORDER BY time DESC");
                while ($selected = $select->fetch_assoc()) {
                    //print_r($selected);
                    echo $selected["user"].": ".$selected["text"]."<button style='margin-left: 1rem' onclick='banUser(\"".$selected['user']."\")'>Ban</button>"."<p style='font-size: 15px; margin-bottom: 0.3rem; margin-top: 0.1rem'>({$selected['date']})</p>";
                    echo "<br>";
                }
                /*

                //echo "<h4>{$_COOKIE['username']}: {$message}</h4>";
            }      
            */  
            ?>
        </div>
        <script>
            function loadChat() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('chat').innerHTML = xhr.responseText;
                    }
                };
                xhr.open("GET", 'aloadmessages.php', true);
                xhr.send();
            }

            loadChat();
            setInterval(loadChat, 3000);
        function banUser(usertoban) {
            console.log(usertoban);
            fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => sendXHR(data.ip));
            function sendXHR (ip){
                var user = usertoban;
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                    }
                };

                var params = "user="+encodeURIComponent(usertoban)+"&ip="+encodeURIComponent(ip);
                xhr.open("POST", "/banuser.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send(params);
            }
        }
        function sendPost() {
            var message = document.getElementById("user_message").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                }
            };

            var params = "user_message="+encodeURIComponent(message);
            xhr.open("POST", "/message.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(params);
        }
    </script>
    </div>
</body>
</html>
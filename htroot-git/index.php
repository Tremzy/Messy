<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include "database.php";
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
        var params = "ip="+encodeURIComponent(ip);
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                if (this.responseText == "banned") {
                    window.location.href = "banned.php"
                }
            }
        };

        xhr.open("POST", "/bancheck.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);

        xhr1.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
            }
        };

        xhr1.open("POST", "/cookie.php", true);
        xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr1.send(params);

        xhr2.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
            }
        };

        xhr2.open("POST", "/accountcheck.php", true);
        xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr2.send(params);
    }
</script>
<?php
    include "admincheck.php";
    
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MessY</title>
    <style>
        @font-face {
            font-family: roboto;
            src: url("roboto.ttf");
        }
        @font-face {
            font-family: kanit;
            src: url("kanit.ttf");
        }
        body {
            background-color: #6699ff;
            font-family: "roboto";
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .content {
            display: flex;
            flex-direction: column;
            font-size: 30px;
            width: 70%;
        }
        .discord-widget {
            width: 100%;
            height: 300px;
        }
        .small-button {
            width: 200px;
            margin-bottom: 1rem;
        }
        .ad-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            justify-content: center;
        }
        .ad {
            margin-top: 20px;
            margin-right: 1rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
    <script src="https://kit.fontawesome.com/e996caaea2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="content">
            <?php
            include "database.php";
            echo "<h1 style='font-family: kanit'>Global chat</h1>";
            echo "Date: ".date("Y/d/m h:i")."<br><br>";
            /*
            $ip = $_SERVER['REMOTE_ADDR'];
            $select1 = $conn->query("SELECT username FROM users WHERE ip = \"{$ip}\"");
            $selected1 = $select1->fetch_assoc();
            $currentuser = $selected1["username"];
            */
            $currentuser = $_COOKIE["username"];
            echo "<h3 style='font-family: kanit'>Current user: {$currentuser}</h3>";
            ?>
            <button class="small-button" type="submit" name="settings" onclick="window.location.href='settings.php'">Settings</button>
            <button class="small-button" type="submit" name="forum" onclick="window.location.href='forum.php'">Forum</button>
            <form action="" id="submitbtn">
                <input type="text" name="user_message" id="user_message">
                <input type="submit" value="Submit" onclick="sendPost()">
            </form>
            <div style="padding: 1rem" id="chat">
                <?php
                    $select = $conn->query("SELECT * FROM chat ORDER BY time DESC");
                    while ($selected = $select->fetch_assoc()) {
                        echo $selected["user"].": ".$selected["text"]."<p style='font-size: 15px; margin-bottom: 0.3rem; margin-top: 0.1rem'>({$selected['date']})</p>";
                        echo "<br>";
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
        function loadChat() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('chat').innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", 'loadmessages.php', true);
            xhr.send();
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

        loadChat();
        setInterval(loadChat, 3000);
    </script>
</body>
</html>

<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

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


<!--
    TODO:
    - Update to new UI
    - Fix common bugs

-->



<!--
    this shit
-->
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
        @font-face {
            font-family: kdam;
            src: url("kdam.ttf");
        }
        body {
            background-color: #6699ff;
            font-family: "roboto";
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap; /* Allow items to wrap to the next line */
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
            width: 200px; /* Adjust the width as needed */
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
            echo "<h1 style='font-family: kanit'>Global forum</h1>";
            echo "Date: ".date("Y/d/m h:i")."<br><br>";
            $currentuser = $_COOKIE["username"];
            echo "<h3 style='font-family: kanit'>Current user: {$currentuser}</h3>";
            ?>
            <button class="small-button" style="margin-bottom: 0.5rem" type="submit" name="settings" onclick="window.location.href='settings.php'">Settings</button>
            <button class="small-button" type="submit" name="chat" onclick="window.location.href='index.php'">Chat</button>
            <form action="" id="submitbtn">
                <h5 style="font-family: kdam">Post title</h3>
                <input style="margin-top: -2rem" type="text" name="post_title" id="posttitle">
                <br>
                <h5 style="font-family: kdam">Post description</h3>
                <textarea style="margin-top: -2rem" type="text" name="post_description" id="postdesc" rows="6" cols="50"></textarea>
                <input type="submit" value="Submit" onclick="sendPost()">
            </form>
            <div style="padding: 1rem" id="chat">
                <?php
                include "database.php";
                $conn->set_charset("utf8mb4");
                $select = $conn->query("SELECT * FROM posts ORDER BY time DESC");
                while ($selected = $select->fetch_assoc()) {
                    //print_r($selected);
                    $message = nl2br(htmlspecialchars($selected["description"], ENT_QUOTES, "UTF-8"));
                    echo "<div style='margin: 2rem; padding: 3rem; border: 2px solid #fff; border-radius: 0.3rem; width: 15rem; height: auto'><h2>".$selected["user"]." -> ".$selected["title"]."</h2>".$message."<p style='font-size: 15px; margin-bottom: 0.3rem; position: relative; top: 2rem; left: 3rem'>({$selected['date']})</p></div>";
                    echo "<br>";
                }
                ?>
            </div>
        </div>
        <div class="ad-container">
            <div class="ad">
                <a href="https://www.youtube.com/channel/UC5YWarSqrDf91eJrDEc5efQ"><img src="ytprofile.jpg" width="200" heigth="200" style="border-radius: 1rem"></img></a>
                <br>
                <a href="https://www.youtube.com/channel/UC5YWarSqrDf91eJrDEc5efQ"><i class="fa-brands fa-youtube" style="transform: scale(1.3)"></i> tremzye youtube</a>
            </div>
            <div class="ad">
                <a href="https://discord.gg/XACH66kTAq"><img src="pm2000.png"></a></img>
                <br>
                <br>
                <a href="https://discord.gg/XACH66kTAq"><i class="fa-brands fa-discord" style="transform: scale(1.3)"> PM2000 discord</i></a>
                <br>
                <br>
                <iframe src="https://discord.com/widget?id=1062119190296789072&theme=dark" width="300" height="300" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
            </div>
            <div class="ad">
                <a href="https://discord.gg/ayuSRAUs2y"><img src="stako.png"></img></a>
                <br>
                <br>
                <a href="https://discord.gg/ayuSRAUs2y"><i class="fa-brands fa-discord" style="transform: scale(1.3)"> Stako's spot</i></a>
            </div>

        </div>

    </div>
    <script>
        function loadForum() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('chat').innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", 'loadposts.php', true);
            xhr.send();
        }
        function sendPost() {
            var postTitle = document.getElementById("posttitle").value;
            var postDesc = document.getElementById("postdesc").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                }
            };

            var params = "posttitle="+encodeURIComponent(postTitle)+"&postdesc="+encodeURIComponent(postDesc);
            xhr.open("POST", "/post.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(params);
        }

        loadChat();
        setInterval(loadChat, 3000);
    </script>
</body>
</html>

<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
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
    <div id="language-text"></div>
    <button onclick="window.location.href='index.php'">Back to main page</button>
    <h1>Temporary</h1>
    <h2>Name:</h2>
    <form action="">
        <input type="text" name="textinput" id="textinput">
        <input type="submit" name="submitbtn" onclick="updateName()">
    </form>
    <h1>Account</h1>
    <h2>Username:</h2>
        <input type="text" name="textinput" id="username">
    <h2>Password:</h2>
        <input type="text" name="textinput" id="password">
        <input type="submit" name="submitbtn" onclick="createAccount()">
    <h1>Language</h1>
    <h2>Available languages:</h2>
    <label class="radio"><input type="radio" value="eng" name="lang" onclick="setLanguage('eng');">eng</label>
    <br>
    <br>
    <label class="radio"><input type="radio" value="hun" name="lang" onclick="setLanguage('hun');">hun</label>

    <script>
        function setLanguage(lang) {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    updateUIText(lang);
                }
            };

            var params = "language="+encodeURIComponent(lang);
            xhr.open("POST", "/setlanguage.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(params);
        }
        function updateName() {
            var username = document.getElementById("textinput").value;
            if(!username.includes("admin")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                    }
                };

                var params = "username="+encodeURIComponent(username);
                xhr.open("POST", "/savesettings.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send(params);
            }
        }
        function createAccount() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            console.log("Correct input format")
            console.log("Fetching IP...");
            fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => {
                    ip = data.ip;
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function(){
                            if (this.readyState == 4 && this.status == 200){
                                if(this.response == "logged_in") {
                                    console.log("Successfully logged in");
                                }
                                else if(this.response == "invalid") {
                                    console.log("Invalid account");
                                }
                                else {
                                    console.log("Unexpected error")
                                }
                            }
                        };
                        var params = "username="+encodeURIComponent(username)+"&password="+encodeURIComponent(password)+"&ip="+encodeURIComponent(ip);
                        console.log("Sending data...");
                        xhr.open("POST", "/createaccount.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send(params);
            });
        }
        function updateUIText(lang) {
            var textDiv = document.getElementById("language-text");
            var text = languageText[lang];

            if (text) {
                var html = `
                    <h2>${text['welcome']}</h2>
                    <h3>${text['nameLabel']}</h3>
                    <h2>${text['accountLabel']}</h2>
                    
                `;

                textDiv.innerHTML = html;
            }
        }

        
    </script>
</body>
</html>


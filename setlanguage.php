<?php
if (isset($_POST["language"])) {
    $language = $_POST["language"];
    setcookie("language", $language, time() + 43200, "/");
} else {
    echo "error";
}
?>

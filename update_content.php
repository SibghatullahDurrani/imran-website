<?php
session_start();
if (!isset($_SESSION['admin']) && !isset($_COOKIE["Type"])) {
    header("location: index.php");
    exit;
} else {
    require "partials/_dbConnectUsers.php";
    $content = $_POST['content'];
    if (strpos($content, "'")) {
        $content = str_replace("'", "\'", $content);
    }
    $update = "UPDATE `details` SET `content`= '$content' WHERE `type` = " . $_COOKIE['Type'] . "";
    $query = mysqli_query($connect, $update);
    header("location: index.php");
    exit;
}

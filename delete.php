<?php
session_start();
if (!isset($_SESSION['admin'])) {
    //no bya ye kwana ka
    header("location: index.php");
    exit;
}
if (isset($_GET['delete-item']) && isset($_GET['type'])) {
    $path = $_GET['delete-item'];
    if ($_GET['type'] == "event") {
        $delete = "DELETE FROM `event-images` WHERE `path`= '$path'";
    } elseif ($_GET['type'] == "members") {
        $delete = "DELETE FROM `member_details` WHERE `image_path`= '$path'";
    } else {
        $delete = "DELETE FROM `images` WHERE `path`= '$path'";
    }
    require 'partials/_dbConnectUsers.php';
    $run_query = mysqli_query($connect, $delete);
    unlink($path);
    header("location: index.php");
}

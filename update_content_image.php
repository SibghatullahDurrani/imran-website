<?php
session_start();
if (!isset($_SESSION['admin'])) {
    //no bya ye kwana ka
    header("location: index.php");
    exit;
} else {

    if (isset($_FILES["content_image"]["name"]) && isset($_COOKIE['Type'])) {
        require "partials/_dbConnectUsers.php";
        $get_images = "SELECT * FROM `images` WHERE `type`=" . $_COOKIE['Type'] . "";
        $images_query = mysqli_query($connect, $get_images);
        $result = mysqli_fetch_array($images_query);
        $path = $result['path'];
        unlink($path);

        $target_dir = "uploads/";
        $target_file = $target_dir . $_COOKIE['Type'] . basename($_FILES["content_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["content_image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                setcookie("UploadError", "NotImage", time() + 86400, "/");
                header("location: index.php");
                exit;
            }
        }
        // See if file already exists
        if (file_exists($target_file)) {
            setcookie("UploadError", "FileExists", time() + 86400, "/");
            header("location: index.php");
            exit;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            setcookie("UploadError", "IncorrectFileType", time() + 86400, "/");
            header("location: index.php");
            exit;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["content_image"]["tmp_name"], $target_file)) {
                setcookie("UploadSuccess", "Success", time() + 86400, "/");
                $insert_query = "UPDATE `images` SET `path` = '$target_file' WHERE `type` = " . $_COOKIE['Type'] . "";
                $insert_data = mysqli_query($connect, $insert_query);
                header("location: index.php");
                exit;
            } else {
                setcookie("UploadError", "UploadError", time() + 86400, "/");
                header("location: index.php");
                exit;
            }
        }
    } else {
        header("location: index.php");
    }
}
// require 'partials/_dbConnectUsers.php';
// $path = $_GET['delete-item'];
// $delete = "DELETE FROM `images` WHERE `path`= '$path'";
// $run_query = mysqli_query($connect, $delete);
// unlink($path);
// header("location: index.php");

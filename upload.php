<?php
if (isset($_FILES["fileToUpload"]["name"]) || isset($_FILES["event-image"]["name"]) || isset($_FILES["members-image"]["name"]) && isset($_COOKIE['Type'])) {
    if (isset($_FILES["fileToUpload"]["name"])) {
        $file = $_FILES["fileToUpload"];
    } elseif (isset($_FILES["event-image"]["name"])) {
        $file = $_FILES["event-image"];
    } elseif (isset($_FILES["members-image"]["name"])) {
        $file = $_FILES["members-image"];
    }
    $target_dir = "uploads/";
    $target_file = $target_dir . $_COOKIE['Type'] . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            setcookie("UploadError", "NotImage", time() + 86400, "/");
            header("location: index.php");
            exit;
        }
    }
    //See if file already exists
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
    //Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            setcookie("UploadSuccess", "Success", time() + 86400, "/");
            require 'partials/_dbConnectUsers.php';
            if (isset($_FILES["event-image"]["name"])) {
                $caption = $_POST['caption'];
                if (strpos($caption, "'")) {
                    $caption = str_replace("'", "\'", $caption);
                }
                $insert_query = "INSERT INTO `event-images` (`path`, `caption`, `type`) VALUES ('$target_file', '$caption','" . $_COOKIE['Type'] . "')";
                $insert_data = mysqli_query($connect, $insert_query);
                header("location: index.php");
                exit;
            } elseif (isset($_FILES["fileToUpload"]["name"])) {
                $insert_query = "INSERT INTO `images` (`path`, `type`) VALUES ('$target_file', '" . $_COOKIE['Type'] . "')";
                $insert_data = mysqli_query($connect, $insert_query);
                header("location: index.php");
                exit;
            } elseif (isset($_FILES["members-image"]["name"])) {
                $description = $_POST['description'];
                if (strpos($description, "'")) {
                    $description = str_replace("'", "\'", $description);
                }
                $insert_query = "INSERT INTO `member_details` (`image_path`, `member_info`) VALUES ('$target_file', '$description')";
                echo $insert_query;
                $insert_data = mysqli_query($connect, $insert_query);
                header("location: index.php");
                exit;
            }
        } else {
            setcookie("UploadError", "UploadError", time() + 86400, "/");
            header("location: index.php");
            exit;
        }
    }
} else {
    header("location: index.php");
}

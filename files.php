<?php
// if (!isset($_COOKIE['Type'])) {
//     header("location: index.php");
// }
// if (isset($_COOKIE['UploadSuccess'])) {
//     if ($_COOKIE['UploadSuccess'] == 'Success') {
//         echo "Image Successfully Uploaded";
//     }
//     setcookie("UploadSuccess", "", time() - 86400, "/");
// }
// if (isset($_COOKIE['UploadError'])) {
//     if ($_COOKIE['UploadError'] == 'FileExists') {
//         echo "Image already exists";
//     } else if ($_COOKIE['UploadError'] == 'NotImage') {
//         echo "file is not an image";
//     } else if ($_COOKIE['UploadError'] == 'IncorrectFileType') {
//         echo "Sorry, only JPG, JPEG & PNG files are allowed.";
//     } else if ($_COOKIE['UploadError'] == 'UploadError') {
//         echo "Image failed to upload";
//     }
//     setcookie("UploadError", "", time() - 86400, "/");
// }
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/files.css">
    <title>upload</title>
</head>

<body>
    <form action="upload.php" method="post" id="upload-form" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" required style="display:none">
        <label for="fileToUpload"><img class="upload-label" src="icons/upload-svgrepo-com.svg" alt=""></label>
        <label>
            <input type="submit" />
            <img class="done-label" src="icons/todo-done-svgrepo-com.svg" alt="">
        </label>
    </form>

    <?php
    if ($_COOKIE['Type'] == '1') {
        echo '<table>
                <tr>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                
            </table>';
    }
    ?>
</body>
<script type="text/javascript" src="js/files.js"></script>

</html> -->
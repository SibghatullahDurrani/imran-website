<?php
$success = false;
$exist_error = false;
$not_image = false;
$incorrect_format = false;
$upload_error = false;

if (isset($_COOKIE['UploadSuccess'])) {
    if ($_COOKIE['UploadSuccess'] == 'Success') {
        $success = True;
    }
    setcookie("UploadSuccess", "", time() - 86400, "/");
}
if (isset($_COOKIE['UploadError'])) {
    if ($_COOKIE['UploadError'] == 'FileExists') {
        $exist_error = true;
    } else if ($_COOKIE['UploadError'] == 'NotImage') {
        $not_image = true;
    } else if ($_COOKIE['UploadError'] == 'IncorrectFileType') {
        $incorrect_format = true;
    } else if ($_COOKIE['UploadError'] == 'UploadError') {
        $upload_error = true;
    }
    setcookie("UploadError", "", time() - 86400, "/");
}
setcookie('Type', '', time() - 86400, '/');
require 'partials/_dbConnectUsers.php';
$get_content_2 = "SELECT * FROM `details` WHERE `type` = '2'";
$content_2_query = mysqli_query($connect, $get_content_2);
$get_content_3 = "SELECT * FROM `details` WHERE `type` = '3'";
$content_3_query = mysqli_query($connect, $get_content_3);
$get_images = "SELECT * FROM `images` WHERE `type`= '1'";
$images_query = mysqli_query($connect, $get_images);
$get_images_3 = "SELECT * FROM `images` WHERE `type`= '3'";
$images_query_3 = mysqli_query($connect, $get_images_3);
$get_event_images = "SELECT * FROM `event-images`";
$event_images_query = mysqli_query($connect, $get_event_images);
$event_images_query2 = mysqli_query($connect, $get_event_images);
// $event_images_result = mysqli_fetch_array($event_images_query);
$result_images_query_3 = mysqli_fetch_array($images_query_3);
$rows = mysqli_num_rows($images_query);
$event_rows = mysqli_num_rows($event_images_query);
$get_members_info = "SELECT * FROM `member_details`";
$members_info_query = mysqli_query($connect, $get_members_info);
$members_rows = mysqli_num_rows($members_info_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imran Khan Enterprises</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    require 'partials/_navbar.php';
    ?>
    <div class="edit-content-modal">
        <div class="modal-body">
            <form action="update_content.php" method="post" id="modal-form">
                <div class="modal-header">
                    <label for="content">Content</label>
                    <img src="icons/cancel-svgrepo-com.svg" alt="" id="modal-close">
                </div>

                <textarea name="content" id="" cols="30" rows="15" style="resize: none" required></textarea>
                <input type="submit" value="Done" id="submit-modal-form">
            </form>
        </div>
    </div>
    <div class="edit-events-modal">
        <div class="event-modal-body">
            <form action="upload.php" method="post" id="event-modal-form" enctype="multipart/form-data">
                <div class="event-modal-header">
                    <label for="caption">Caption</label>
                    <img src="icons/cancel-svgrepo-com.svg" alt="" id="event-modal-close">
                </div>
                <input id="event-caption-textbar" type="text" name="caption" required>
                <div>
                    <input type="file" name="event-image" id="event-image" style="display:none" required>
                    <label for="event-image"><img class="event-upload-label" src="icons/upload-svgrepo-com.svg" alt=""></label>
                    <label>
                        <input type="submit" />
                        <img class="done-label" src="icons/todo-done-svgrepo-com.svg" alt="">
                    </label>
                </div>

                <!-- <input type="submit" value="Done" id="submit-modal-form"> -->
            </form>
        </div>
    </div>
    <div class="edit-members-modal">
        <div class="members-modal-body">
            <form action="upload.php" method="post" id="members-modal-form" enctype="multipart/form-data">
                <div class="members-modal-header">
                    <label for="description">Description</label>
                    <img src="icons/cancel-svgrepo-com.svg" alt="" id="members-modal-close">
                </div>
                <textarea name="description" id="members-textarea" cols="30" rows="10" required></textarea>
                <div>
                    <input type="file" name="members-image" id="members-image" style="display:none" required>
                    <label for="members-image"><img class="members-upload-label" src="icons/upload-svgrepo-com.svg" alt=""></label>
                    <label>
                        <input type="submit" />
                        <img class="done-label" src="icons/todo-done-svgrepo-com.svg" alt="">
                    </label>
                </div>

                <!-- <input type="submit" value="Done" id="submit-modal-form"> -->
            </form>
        </div>
    </div>

    <div class="main-page">
        <div class="left-pane">
            <!-- SlideShow Container -->
            <div class="slideshow-container">
                <?php
                $i = 0;
                while ($results = mysqli_fetch_array($images_query)) {
                    $i++;
                    echo '
                <div class="mySlides fade">
                    <div class="numbertext">' . $i . '/' . $rows . '</div>
                    <div id="success" style="display:none">
                        <div class = "message">
                            File Uploaded Successfully
                        </div>
                        <img id ="cancel-prompt" src="icons/cancel-svgrepo-com.svg" alt="" onClick="hidePrompt()">
                    </div>
                    <div id="exists-error" style="display:none">
                        <div class = "message">
                            File Already Exists
                        </div>
                        <img id ="cancel-prompt" src="icons/cancel-svgrepo-com.svg" alt="" onClick="hidePrompt()">
                    </div>
                    <div id="not-image-error" style="display:none">
                        <div class = "message">
                            File Selected is not an image
                        </div>
                        <img id ="cancel-prompt" src="icons/cancel-svgrepo-com.svg" alt="" onClick="hidePrompt()">               
                    </div>
                    <div id="incorrect-format-error" style="display:none">
                        <div class = "message">
                            Sorry, only JPG, JPEG & PNG files are allowed
                        </div>
                        <img id ="cancel-prompt" src="icons/cancel-svgrepo-com.svg" alt="" onClick="hidePrompt()"> 
                    </div>
                    <div id="upload-error" style="display:none">
                        <div class = "message">
                            Image Upload Failed
                        </div>
                        <img id ="cancel-prompt" src="icons/cancel-svgrepo-com.svg" alt="" onClick="hidePrompt()"> 
                    </div>
                    <img class = "slideshow-images" src="' . $results['path'] . '" alt="" style="width:100%">
                    <div class="slideshow-actions" style = "display:none">
                        <a class="delete-slideshow-a" href="delete.php?delete-item=' . $results['path'] . '&type=slideshow"><img class="delete-image-slideshow" src="icons/delete-svgrepo-com.svg" alt=""></a>
                    </div>
                </div>';
                }
                if ($i != 0) {
                    echo '                
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>';
                }
                ?>
                <form action="upload.php" method="post" id="upload-form" enctype="multipart/form-data" style="display:none">
                    <input type="file" name="fileToUpload" id="fileToUpload" style="display:none" required>
                    <label for="fileToUpload"><img class="upload-label" src="icons/upload-svgrepo-com.svg" alt=""></label>
                    <label>
                        <input type="submit" />
                        <img class="done-label" src="icons/todo-done-svgrepo-com.svg" alt="">
                    </label>
                </form>

            </div>
            <!-- <div style="text-align:center">
                <?php
                // for ($i = 1; $i <= $rows; $i++) {
                //     echo '<span class="dot" onclick="currentSlide(' . $i . ')"></span>';
                // }
                ?>
            </div> -->
            <div class="details">
                <div class="about_company">
                    <div class="heading">
                        ABOUT THE COMPANY
                        <div id="edit2">Edit</div>
                    </div>
                    <div class="content">
                        <?php
                        while ($results = mysqli_fetch_array($content_2_query)) {
                            echo $results["content"];
                        }
                        ?>
                    </div>
                </div>
                <div class="details-seperator"></div>
                <div class="ceo">
                    <div class="heading">
                        C.E.O
                        <div id="edit3-actions">
                            <div id="edit3">Edit Content</div>
                            <div id="edit3-upload">
                                <form action="update_content_image.php" method="post" id="update_content_image" enctype="multipart/form-data">
                                    <input type="file" name="content_image" id="content_image" style="display:none" required>
                                    <label for="content_image"><img id="edit_image_btn" class="update-image-label" src="icons/upload-svgrepo-com.svg" alt=""></label>
                                    <label>
                                        <input type="submit" />
                                        <img class="done-image-label" src="icons/todo-done-svgrepo-com.svg" alt="">
                                    </label>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="ceo-content">
                        <div class="ceo-image">
                            <img <?php echo "src =' " . $result_images_query_3['path'] . "'" ?> alt="">
                        </div>
                        <div class="content">
                            <?php
                            while ($results = mysqli_fetch_array($content_3_query)) {
                                echo $results["content"];
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="event-heading">
                EVENTS
            </div>
            <div class="event-container">
                <?php
                $i = 0;
                while ($event_images_result = mysqli_fetch_array($event_images_query)) {
                    $i++;
                    echo '
                <div class="event-mySlides">
                    <div class="event-numbertext">' . $i . '/' . $event_rows . '</div>
                    <img class = "event-slideshow-images" src="' . $event_images_result['path'] . '" alt="" style="width:100%">
                    <div class="event-slideshow-actions" style="display:none">
                        <a class="event-delete-slideshow-a" href="delete.php?delete-item=' . $event_images_result['path'] . '&type=event"><img class="event-delete-image-slideshow" src="icons/delete-svgrepo-com.svg" alt=""></a>
                    </div>
                </div>';
                }
                if ($i != 0) {
                    echo '                
                    <a class="event-prev" onclick="event_plusSlides(-1)">&#10094;</a>
                    <a class="event-next" onclick="event_plusSlides(1)">&#10095;</a>
                    <div class="caption-container">
                        <p id="caption"></p>
                    </div>';
                }
                ?>

                <div class="row">
                    <?php
                    $i = 0;
                    while ($event_images_result2 = mysqli_fetch_array($event_images_query2)) {
                        $i++;
                        echo '
                    <div class="event-column">
                        <img class="demo cursor" src="' . $event_images_result2['path'] . '" style="width:100%" onclick="event_currentSlide(' . $i . ')" alt="' . $event_images_result2['caption'] . '">
                    </div>';
                    }
                    ?>
                </div>
                <img class="events-upload-label" src="icons/upload-svgrepo-com.svg" alt="" id="update-events" style="display:none">
            </div>
        </div>
        <div class="right-pane">
            <div class="services-details">
                <div class="services-heading">
                    SERVICES
                </div>
                <div class="services-links">
                    <a href="">Transportation</a>
                    <div class="underline"></div>
                    <a href="">Real Estate & Construction</a>
                    <div class="underline"></div>
                    <a href="">Events Management</a>
                    <div class="underline"></div>
                    <a href="">Custom Appraisment</a>
                    <div class="underline"></div>
                    <a href="">Sports Management</a>
                    <div class="underline"></div>
                    <a href="">Sawab Foundation</a>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="enterprise-members">
                <div class="members-heading">
                    ENTERPRISE MEMBERS
                </div>
                <!-- Slideshow container -->
                <div class="members-slideshow-container">
                    <?php
                    while ($members_result = mysqli_fetch_array($members_info_query)) {
                        echo '
                            <div class="members-mySlides">
                                <img src="' . $members_result['image_path'] . '" alt="" class="member-image">
                                <div class="member-info">
                                ' . $members_result['member_info'] . '
                                </div>
                                <div class="members-slideshow-actions">
                                    <a class="members-delete-slideshow-a" href="delete.php?delete-item=' . $members_result['image_path'] . '&type=members"><img class="members-delete-image-slideshow" src="icons/delete-svgrepo-com.svg" alt=""></a>
                                </div>
                            </div>
                        ';
                    }
                    ?>
                    <!-- Next/prev buttons -->
                    <a class="members-prev" onclick="members_plusSlides(-1)">&#10094;</a>
                    <a class="members-next" onclick="members_plusSlides(1)">&#10095;</a>
                </div>

                <!-- Dots/bullets/indicators -->
                <div class="members-dot-container">
                    <?php
                    for ($i = 1; $i <= $members_rows; $i++) {
                        echo '<span class="members-dot" onclick="currentSlide(' . $i . ')"></span>';
                    }
                    ?>
                </div>
                <img id="members-upload-label" src="icons/upload-svgrepo-com.svg" alt="">
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script>
    const slideshow_actions = document.querySelectorAll(".slideshow-actions")
    const event_slideshow_actions = document.querySelectorAll(".event-slideshow-actions")
    var success = '<?= $success ?>'
    var exist_error = '<?= $exist_error ?>'
    var not_image = '<?= $not_image ?>'
    var incorrect_format = '<?= $incorrect_format ?>'
    var upload_error = '<?= $upload_error ?>'
    var adminCheck = '<?= $admin ?>'
    if (success) {
        upload_success_div.forEach(action => {
            action.style.display = "flex";
        });
    } else if (exist_error) {
        exist_error_div.forEach(action => {
            action.style.display = "flex";
        });
    } else if (not_image) {
        not_image_div.forEach(action => {
            action.style.display = "flex";
        });
    } else if (incorrect_format) {
        incorrect_format_div.forEach(action => {
            action.style.display = "flex";
        });
    } else if (upload_error) {
        upload_error_div.forEach(action => {
            action.style.display = "flex";
        });
    }
    if (adminCheck) {
        document.querySelector("#upload-form").style.display = "flex";
        document.querySelector("#edit2").style.display = "block";
        document.querySelector("#edit3").style.display = "block";
        document.querySelector("#edit3-upload").style.display = "block";
        document.querySelector("#edit3-actions").style.display = "flex";
        document.querySelector(".events-upload-label").style.display = "flex";

        slideshow_actions.forEach(action => {
            action.style.display = "flex";
        });
        event_slideshow_actions.forEach(action => {
            action.style.display = "flex";
        });
    }
</script>

</html>
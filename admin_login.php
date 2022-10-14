<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location: index.php");
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    require 'partials/_dbConnectUsers.php';
    $select = "select * from users where username='$user'";
    $query = mysqli_query($connect, $select);
    $results = mysqli_fetch_array($query);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        $hash = $results['password'];
        $checkpass = password_verify($pass, $hash);
        if ($checkpass) {
            $_SESSION['admin'] = true;
            header("location: index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Admin Login</title>
</head>

<body>
    <div class="logo">Logo</div>
    <div class="container">
        <form action="admin_login.php" method="post" class="login-form">
            <div class="u_container">
                <label for="username" class="heading">Username:</label>
                <Input type="text" id="username" name="username" require></Input>
            </div>
            <div class="p_container">
                <label for="password" class="heading">Password:</label>
                <Input type="password" id="password" name="password" require></Input>
            </div>
            <input type="submit" class="submit_btn" value="login">
        </form>
    </div>
</body>

</html>
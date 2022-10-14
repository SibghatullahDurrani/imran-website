<?php
$server = "eu-cdbr-west-03.cleardb.net";
$username = "b48bf0586d111b";
$password = "9a4561fc";
$database = "heroku_f848ce884e918c9";

$active_group = 'default';
$query_builder = TRUE;

$connect = mysqli_connect($server, $username, $password, $database);

if (!$connect) {
    die("Error" . mysqli_connect_error());
}

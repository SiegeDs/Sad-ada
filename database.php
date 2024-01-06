<?php
//database.php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "jobhunter";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}
$conn->set_charset("utf8mb4");
?>
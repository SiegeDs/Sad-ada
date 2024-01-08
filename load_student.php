<?php
include 'database.php';
//sign_up_student.php

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM `users` WHERE `StudentNo` = '" . $_GET['id'] . "'";
    $result = mysqli_query($conn, $sql);
    echo json_encode(mysqli_fetch_assoc($result));
}

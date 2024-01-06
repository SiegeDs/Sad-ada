<?php
include 'database.php';
//sign_up_student.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newsID = $_POST['newsID'];
    $notificationId = $_POST['notificationId'];
    $status = $_POST['status'];
    echo $status;
    echo $notificationId;
    echo $status;

if($status === "approved" ){
    $sql = "UPDATE `newsfeed` SET status_nf = '$status' WHERE news_id =' $newsID' AND user_id = '$notificationId'" ;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}else if($status === "delete" ){
    $sql ="DELETE FROM `newsfeed` WHERE news_id =' $newsID' AND user_id = '$notificationId'";
    // $sql = "UPDATE `newsfeed` SET status_nf = '$status' WHERE news_id =' $newsID' AND user_id = '$notificationId'" ;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data delete successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
}

?>

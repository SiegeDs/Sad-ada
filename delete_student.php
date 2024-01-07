<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_no = $_POST['student_no'];

    $sql = "DELETE FROM `users` WHERE StudentNo = '$student_no'";
              
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }            
}
?>
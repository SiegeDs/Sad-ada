<?php
include 'database.php';
//sign_up_student.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sexSelect'];
    $date_of_birth = $_POST['date_of_birth'];
    $contact_no = $_POST['contact_no'];
    $year_graduated = $_POST['year_graduated'];
    $current_address = $_POST['current_address'];
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];

    echo "Data inserted successfully First_name" . $first_name;

        $sql = "INSERT INTO `users` 
                (`StudentNo`, `First_Name`, `Last_Name`, `Sex`, `DateBirth`, `ContactNo`, `YearGraduate`, `CurrentAddress`, `Password`) 
                VALUES 
                ('$student_no', '$first_name', '$last_name', '$sex', '$date_of_birth', '$contact_no', '$year_graduated', '$current_address', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

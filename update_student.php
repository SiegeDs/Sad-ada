<?php
include 'database.php';

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

    $sql = "UPDATE users SET First_Name = '$first_name',
                                Last_Name = '$last_name',
                                DateBirth = '$date_of_birth',
                                ContactNo = '$contact_no',
                                YearGraduate = '$year_graduated',
                                CurrentAddress = '$current_address',
                                password = '$password',
                                Sex = '$sex'
              WHERE StudentNo = '$student_no'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }            
}
?>
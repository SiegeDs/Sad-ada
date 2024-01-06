<?php
// signin.php

include 'database.php';
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_no = mysqli_real_escape_string($conn, $_POST['student_no']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database to check if the user exists
    $sql = "SELECT * FROM `users` WHERE `StudentNo` = '$student_no'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            // Verify the password
            if ($password === $row['Password']) {
                // Passwords match, user authenticated
                echo "Authentication successful!";
                session_start();
                $_SESSION["user"] = "yes";
                if($student_no == 1){
                    $_SESSION["user_type"] = 'admin';
                }else{
                    $_SESSION["user_type"] = 'student';
                }
                $_SESSION["Login_id"] = $student_no;
                header("Location: sscreen.php");
                

                // You can include additional logic or display a success message here
            } else {
                // echo "Incorrect password. Please try again.";
            }
        } else {
            // echo "User not found. Please check your Student No.";
        }
    } else {
        // echo "Error: " . mysqli_error($conn);
    }
}
?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Features</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .text {
            color: #f1f2e8;
            font-size: 24px;
            font-weight: 700;
            word-wrap: break-word;
            text-align: center;
        }

        .texts {
            color: #000000;
            font-size: 32px;
            font-weight: 700;
            word-wrap: break-word;
            text-align: center;
        }
    </style>
</head>

<body style="background: #f1f2e8">
    <!-- This is the HTML-->
    <nav class="navbar navbar-expand-lg border-bottom bg-dark">
        <div class="container-fluid">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="text">
                        GRADUATES’ TRACING <br />
                        SYSTEM <img src="./images/snowflake.png" class="w-5%" />
                    </div>
                    <nav class="nav">
                        <a class="nav-link active text-warning" aria-current="page" href="signin.php">Home
                        </a>
                        <a class="nav-link text-light" href="Front1.html">Features</a>
                        <a class="nav-link text-light" href="about.html">About</a>
                    </nav>
                    <div>
                    <a href=signin.php class="btn btn-light"  href="signin.php">Sign In</a>
                        <a href=signup.php class="btn btn-dark"  href="signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col"><img src="./images/profile.png" /></div>
            <div class="col">
                <div class="card p-3 m-3" style="width: 80%">
                    <div class="card-body">
                        <p class="fs-3 fw-bold text-center">
                            Sign In |
                            <span class="fs-6 fw-normal">Don't have an Account yet?</span><span class="fs-6 bold"> Sign
                                Up here.</span>
                        </p>
                        <form action="signin.php" method="POST">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col">
                                        <input class="my-3 form-control" type="text" name="student_no"
                                            placeholder="Student No." />
                                        <input class="my-3 form-control" type="password" name="password"
                                            placeholder="Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a class="nav-link d-flex flex-row-reverse" href="#">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center m-3">
                                <button type="submit" class="btn btn-dark m-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
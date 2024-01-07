<?php
include 'database.php';
$title = "Sign in";

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
                if ($student_no == 1) {
                    $_SESSION["user_type"] = 'admin';
                } else {
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
ob_start();
?>
<div class="container mt-5 pt-5">
    <div class="row gap-2 justify-content-around">
        <div class="col text-center"><img src="./images/profile.png" /></div>
        <div class="col">
            <div class="card p-3 md-3 m-md-5">
                <div class="card-body">
                    <p class="fs-3 fw-bold text-center">
                        Sign In |
                        <span class="fs-6 fw-normal">Don't have an Account yet?</span>
                        <span class="fs-6 bold">Sign up here.</span>
                    </p>
                    <form action="signin.php" method="POST" class="container">
                        <div class="row">
                            <div class="col">
                                <input class="my-3 form-control" type="text" name="student_no" placeholder="Student No." />
                                <input class="my-3 form-control" type="password" name="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                            <a class="nav-link d-flex flex-row-reverse" href="#">Forgot Password?</a>
                        </div>
                </div>
                <div class="d-flex justify-content-center m-3">
                    <button type="submit" class="btn btn-dark">Sign In</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/auth_layout.php';
?>
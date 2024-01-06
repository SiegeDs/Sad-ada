
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
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
                    <a href=signin.php class="btn btn-dark">Sign In</a>
                        <a href=signup.php class="btn btn-light">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-5 pt-5">
        <div class="row">
            <!-- Sign Up Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="fs-3">
                            Sign Up | <span class="fs-6">Don't have an Account?</span><span class="fs-5 bold"> Sign In</span>
                        </p>
                        <div class="container text-center">
                           
                                <div class="row">
                                    <div class="col">
                                        <input class="my-3 form-control" type="text" id="first_name" placeholder="First Name" required/>
                                        <input class="my-3 form-control" type="date" id="date_of_birth" placeholder="Date of Birth" required/>
                                        <input class="my-3 form-control" type="number" id="contact_no" placeholder="Contact No." required/>
                                        <input class="my-3 form-control" type="text" id="year_graduated" placeholder="Year Graduated" required/>
                                        <!-- <input class="my-3 form-control" type="text" name="password" id="password" placeholder="Password" /> -->
                                        <div class="input-group">
                                            <input type="password" class="form-control"  name="password"  id="password" placeholder="Password" autocomplete="current-password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility('password', 'togglePasswordBtn')">Show</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <input class="my-3 form-control" type="text" id="last_name" placeholder="Last Name" required/>
                                        <div class="my-3">
                                            <select class="form-select" id="sexSelect" name="sex">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <input class="my-3 form-control" type="text" id="current_address" placeholder="Current Address" required/>
                                        <input class="my-3 form-control" type="number" id="student_no" placeholder="Student No." required/>
                                        <!-- <input class="my-3 form-control" type="text" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" /> -->
                                        <div class="input-group">
                                            <input type="password" class="form-control"  name="confirm_password" id="confirmPassword" placeholder="Confirm Password" autocomplete="current-password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn2" onclick="togglePasswordVisibility('confirmPassword', 'togglePasswordBtn2')">Show</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark m-3" id="signup">Sign Up</button>
                         
                        </div>
                    </div>
                </div>
            </div>
            <!-- Additional Content -->
            <div class="col-md-6">
                <div class="texts">
                    WELCOME TO GRADUATES’ <br />
                    TRACING SYSTEM
                </div>
                <img src="./images/chart.png" style="width: 60%" class="m-5" />
                <!-- Placeholder content; replace with your own content -->
                <p class="fs-3">Additional Content Goes Here</p>
            </div>
        </div>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        
        document.getElementById('signup').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default form submission

        var first_name = document.getElementById('first_name').value;
        var date_of_birth = document.getElementById('date_of_birth').value;
        var contact_no = document.getElementById('contact_no').value;
        var year_graduated = document.getElementById('year_graduated').value;
        var password = document.getElementById('password').value;
        var last_name = document.getElementById('last_name').value;
        var sexSelect = document.getElementById('sexSelect').value;
        var current_address = document.getElementById('current_address').value;
        var student_no = document.getElementById('student_no').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        console.log('SIGN UP year_graduated' + year_graduated);
        if (password !== confirmPassword) {
        alert("Passwords do not match. Please enter matching passwords.");
        return; // Stop the form submission
    }

    if (first_name === "" || 
    date_of_birth === "" || 
    contact_no === "" || 
    year_graduated === "" || 
    password === "" || 
    confirmPassword === "" || 
    last_name === "" || 
    sexSelect === "" || 
    current_address === "" || 
    student_no === "" 
        ) {
        // Do something if first_name is empty
        return;
    }
        var formData = new FormData();
			formData.append('first_name', first_name);
            formData.append('date_of_birth', date_of_birth);
            formData.append('contact_no', contact_no);
            formData.append('year_graduated', year_graduated);
            formData.append('password', password);
            formData.append('last_name', last_name);
            formData.append('sexSelect', sexSelect);
            formData.append('current_address', current_address);
            formData.append('student_no', student_no);
            formData.append('confirmPassword', confirmPassword);
            var xhr = new XMLHttpRequest();
			xhr.open('POST', 'sign_up_student.php', true);
			xhr.onload = function () {
				if (xhr.status === 200) {
                    console.log("User registration successful!");
                     window.location.href = "signin.php";
                }else {
                    console.log("Error Password: ");
                }
            };
			xhr.send(formData);
    });
    
</script>

    <script>
    function togglePasswordVisibility(passwordFieldId, toggleButtonId) {
        var passwordField = document.getElementById(passwordFieldId);
        var toggleButton = document.getElementById(toggleButtonId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.textContent = "Hide";
        } else {
            passwordField.type = "password";
            toggleButton.textContent = "Show";
        }
    }
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>

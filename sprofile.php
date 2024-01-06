<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
}
$Login_id = $_SESSION["Login_id"];
// echo $Login_id;

include 'database.php';

$sql = "SELECT * FROM `users` WHERE `StudentNo` = '$Login_id'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $First_Name = $row['First_Name'];
        $Last_Name = $row['Last_Name'];
        $Sex = $row['Sex'];
        $DateBirth = $row['DateBirth'];
        $ContactNo = $row['ContactNo'];
        $YearGraduate = $row['YearGraduate'];
        $CurrentAddress = $row['CurrentAddress'];
        $status = $row['status'];
        $image = $row['image'];
        // Generate a data URI for the image
        if ($image !== null) {
            $image = $row['image'];
        } else {
            // Use a default image path
            $image = "Images/pfp.png";
        }
        
    }
} else {
    echo 'User not found';
}


if (isset($_POST['upload'])){
    $file = $_FILES['image']['name'];
    $query = "UPDATE users SET image = '$file' WHERE StudentNo = '$Login_id'";
    $res = mysqli_query($conn,$query);
    if($res){
        move_uploaded_file($_FILES['image']['tmp_name'],"$file");
    }
    
}

if (isset($_POST['update'])){
    $first_name_modal = $_POST['first_name_modal'];
    $last_name_modal = $_POST['last_name_modal'];
    $date_of_birth_modal = $_POST['date_of_birth_modal'];
    $contact_no_modal = $_POST['contact_no_modal'];
    $year_graduated_modal = $_POST['year_graduated_modal'];
    $current_address_modal = $_POST['current_address_modal'];
    $employeStatus_modal = $_POST['employeStatus_modal'];
    $password_modal = $_POST['password_modal'];
    $sexStatus_modal = $_POST['sexStatus_modal'];

    // Corrected SQL query
    $query = "UPDATE users SET First_Name = '$first_name_modal',
                                Last_Name = '$last_name_modal',
                                DateBirth = '$date_of_birth_modal',
                                ContactNo = '$contact_no_modal',
                                YearGraduate = '$year_graduated_modal',
                                CurrentAddress = '$current_address_modal',
                                status = '$employeStatus_modal',
                                password = '$password_modal',
                                Sex = '$sexStatus_modal'
              WHERE StudentNo = '$Login_id'";
              
    $res = mysqli_query($conn, $query);

    if ($res){
        // Success
        header("Location: sprofile.php");
    } else {
        // Handle error, e.g., display mysqli_error($conn) for debugging
        echo "Error: " . mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Job Chart</title>
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

        .time {
            color: #f1f2e8;
            font-size: 14px;
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
                    <nav class="nav m-2">
                        <a class="nav-link text-light" aria-current="page" href="sscreen.php">Chart
                        </a>
                        <a class="nav-link text-light" href="newsfeed.php">Newsfeed</a>
                    </nav>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="text-end">
                            <span class="time" id="date"></span> <br />
                            <span class="time" id="time"></span>
                        </div>
                        <div class="">
                            <div class="dropdown">
                                <button class="btn btn-link" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $image; ?>" class="mx-auto" style="width: 50px; height: 50px; border-radius: 50%;" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                        <img src="<?php echo $image; ?>" class="mx-auto" style="width: 50px; height: 50px; border-radius: 50%;" /><?php echo $First_Name . ' ' . $Last_Name?></a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">
                                            <img src="./images/logout.png" class="me-3" />Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="card mx-auto mt-5 py-4" style="width: 75%">
        <div class="text-center">
            <div class="row">
                <div class="col-2">
                <img src="<?php echo $image; ?>" class="mx-auto" style="width: 100px; height: 100px; border-radius: 50%;" />
<div style="margin: 20px">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="image" >
                    
                    <input  style="margin: 20px" type="submit" name="upload" value="Upload">
                </form>
                </div>

                </div>
                <div class="col">
                    <p style="text-align: left; font-size: 18px; font-weight: bold">
                    <?php echo $First_Name . ' ' . $Last_Name?>
                    </p>
                    <!-- <p style="text-align: left">michelleraagasabrahan@gmail.com</p> -->
                    <p style="text-align: left">
                        <img src="./images/employed.png" style="width: 25px" /><?php echo $status?>
                    </p>
                </div>
            
                <div class="col">
                    <p style="text-align: left">Batch: <?php echo $YearGraduate?></p>
                    <p style="text-align: left">Brgy Address: <?php echo $CurrentAddress?></p>
                    <p style="text-align: left">Contact No. : <?php echo $ContactNo?></p>
                </div>
                <div class="col " style="
              position: relative;
            ">
                    <p style="text-align: left">Birth date: <?php echo $DateBirth?></p>

                    <a href="#"><img id="editModal" type="" src="./images/edit.png"
                        style="width: 25px; position: absolute; bottom: -24px; right: 13px" /></a>


                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
           
            <div class="col">
                

                           <!-- Success Modal -->
            <div class="modal" id="success_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form method="post">
                    <div class="modal-header"
                        style="background-color: #0A0876; color: #fff;">
                        <h5 class="modal-title" id="title">Update information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="First Name" value="<?php echo $First_Name?>" required/>
                         <input class="my-3 form-control" type="text" name="last_name_modal" placeholder="Last Name" value="<?php echo $Last_Name?>" required/>
                        <input class="my-3 form-control" type="date" name="date_of_birth_modal" placeholder="Date of Birth" value="<?php echo $DateBirth?>" required/>
                        <input class="my-3 form-control" type="number" name="contact_no_modal" placeholder="Contact No." value="<?php echo $ContactNo?>" required/>
                        <input class="my-3 form-control" type="text" name="year_graduated_modal" placeholder="Year Graduated" value="<?php echo $YearGraduate?>" required/>
                        <input class="my-3 form-control" type="text" name="current_address_modal" placeholder="Current Address" value="<?php echo $CurrentAddress?>" required/>

                        <div class="my-3">
                            <select class="form-select" name="employeStatus_modal" value="<?php echo $CurrentAddress?>">
                                <option value="Employed">Employed</option>
                                <option value="Unemployed">Unemployed</option>
                            </select>
                        </div>
                        <div class="my-3">
                            <select class="form-select" name="sexStatus_modal" value="<?php echo $CurrentAddress?>">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control"  name="password_modal"  id="password" placeholder="Password" autocomplete="current-password" value="<?php echo $CurrentAddress?>">
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility('password', 'togglePasswordBtn')">Show</button>
                        </div>
                    </div>
                    <div class="modal-footer">
						<!-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confim_success"  style="display: none;">Confirm</button> -->
                        <button type="submit" name="update" value="update" class="btn btn-primary" onclick="reloadPage()">Save changes</button>

						<button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="dismiss_modal">Cancel</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <script>
          function reloadPage() {
            location.reload();
            }
        </script>  
        <script>
            document.getElementById('editModal').addEventListener('click', function () {
                let successModal = new bootstrap.Modal(document.getElementById('success_modal'));
                    successModal.show();
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

                <script>
    function updateDateTime() {
      var currentDate = new Date();
      var optionsDate = { 
        month: 'long',
        day: 'numeric',
        year: 'numeric'
      };

      var optionsTime = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
      };

      var formattedDate = currentDate.toLocaleDateString('en-US', optionsDate);
      var formattedTime = currentDate.toLocaleTimeString('en-US', optionsTime);

      document.getElementById('date').textContent = formattedDate;
      document.getElementById('time').textContent = formattedTime;
    }

    // Update the date and time initially
    updateDateTime();

    // Update the date and time every minute (60000 milliseconds)
    setInterval(updateDateTime, 60000);
  </script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                    crossorigin="anonymous"></script>
</body>

</html>
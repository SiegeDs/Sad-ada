<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
}
$user_login = $_SESSION["user_type"];
$Login_id = $_SESSION["Login_id"];

// echo $user_login;

include 'database.php';

// Get distinct years from the employed table
$sqlYears = "SELECT DISTINCT year FROM employed";
$resultYears = mysqli_query($conn, $sqlYears);
$years = array();
while ($rowYears = mysqli_fetch_assoc($resultYears)) {
    $years[] = $rowYears['year'];
}

$sql = "SELECT * FROM `users` WHERE `StudentNo` = $Login_id";
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
        $status= $row['status'];
        // $Password = $row['Password'];
        $image = $row['image'];
        // Generate a data URI for the image
        if ($image !== null) {
            $image = $row['image'];
        } else {
            // Use a default image path
            $image = "Images/pfp.png";
        }
    }
}else{
    echo 'User not found';
}


$sql_YearGraduate = "SELECT YearGraduate, 
               COUNT(CASE WHEN status = 'Employed' THEN 1 END) AS user_employed,
               COUNT(CASE WHEN status = 'Unemployed' THEN 1 END) AS user_unemployed
        FROM users 
        GROUP BY YearGraduate";

$result = mysqli_query($conn, $sql_YearGraduate);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $year = $row['YearGraduate'];
        $countEmployed = $row['user_employed'];
        $countUnemployed = $row['user_unemployed'];

        // Check if the row exists in the employed table
        $checkRowQuery = "SELECT * FROM employed WHERE year = '$year'";
        $rowExists = mysqli_query($conn, $checkRowQuery);

        if (mysqli_num_rows($rowExists) > 0) {
            // Row exists, perform an update
            $updateQuery = "UPDATE employed SET user_employed = '$countEmployed', user_unemployed = '$countUnemployed' WHERE year = '$year'";
            mysqli_query($conn, $updateQuery);
        } else {
            // Row does not exist, proceed with the insert
            $insertQuery = "INSERT INTO employed (year, user_employed, user_unemployed) 
                            VALUES ('$year', '$countEmployed', '$countUnemployed')";
            mysqli_query($conn, $insertQuery);
        }
    }

    // echo "Data inserted or updated in the employed table successfully";
} else {
    // echo "Error: " . mysqli_error($conn);
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

        .notification-container {
      
    }

    .notification-item {
      padding: 10px;
        
    }
    .notification-item:not(:last-child) {
  border-bottom: 1px solid #ccc;
}

    .notification-item img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    .notification-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .notification-buttons {
      display: flex;
      gap: 5px; /* Adjust the gap as needed */
    }

    .notification-item:hover {
  background-color: #f0f0f0; /* Add your desired background color */
  cursor: pointer; /* Change cursor to a pointer to indicate interactivity */
}

.notification-list {
  max-height: 300px; /* Set the maximum height for the container */
  overflow-y: auto; /* Add a vertical scrollbar when content overflows */
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
                        <a class="nav-link active text-warning" aria-current="page" href="sscreen.php">Chart
                        </a>
                        <a class="nav-link text-light" href="newsfeed.php">Newsfeed</a>
                    </nav>
                    
                    <div class="d-flex gap-3 align-items-center">

               

                    <?php if($user_login === 'admin'): ?>
                         
                    <div class="notification-container ">
    <div class="dropdown">
        <button class="btn btn-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./images/notification.png" style="width: 30px; height: 30px;" alt="Notification" />
        </button>
        <ul class="dropdown-menu dropdown-menu-end notification-list" aria-labelledby="dropdownMenuButton1">
        <h4 style="margin-left: 10px">Notifications</h4>
        <?php 
            $sql_notif = "SELECT * FROM `newsfeed`
                            JOIN users ON users.`user_id` = newsfeed.`user_id`";
            $result_notif = mysqli_query($conn, $sql_notif);
            if ($result_notif->num_rows > 0) {  
                while ($row = $result_notif->fetch_assoc()) {
                    $profileImage = $row['image_nf'];
                    if ($profileImage !== null) {
                        $profileImage = $row['image_nf'];
                    } else {
                        // Use a default image path
                        $profileImage = "Images/pfp.png";
                    }
                    echo '<li class="notification-item">
                        <div class="notification-content">
                            
                            <img src="' . $profileImage . '" class="mx-auto" alt="User Avatar" />
                            <div style="margin-left: 10px">
                                <b>' . $row['First_Name'] .' ' . $row['Last_Name'] .'</b>';
                                
                                if ($row['status_nf'] === 'pending') {
                                    echo '<br> is requesting your approval.';
                                    echo '<div class="notification-buttons">
                                        <button class="btn btn-success" name="Approve" id="Approve" onclick="approveRequest(' . $row['news_id'] . ', ' . $row['user_id'] . ',  \'approved\');">Approve</button>
                                        <button class="btn btn-danger" name="Decline" id="Decline" onclick="approveRequest(' . $row['news_id'] . ', ' . $row['user_id'] . ',  \'decline\');">Decline</button>
                                        <button class="btn btn-primary" name="View" id="View" onclick="showModal(\'' . $row['image'] . '\', \'' . $row['First_Name'] . '\', \'' . $row['Last_Name'] . '\', \'' . $row['message'] . '\', \'' . $row['image_nf'] . '\');">View</button>
                                        </div>';
                                   
                                } else if ($row['status_nf'] === 'approved') {
                                    echo '<br> Post has been approved.';
                                    echo '<div class="notification-buttons">
                                        <button class="btn btn-success" name="Approve" id="Approve" disabled>Approve</button>
                                        <button class="btn btn-danger" name="Decline" id="Delete" onclick="approveRequest(' . $row['news_id'] . ', ' . $row['user_id'] . ',  \'delete\');">Delete</button>
                                        <button class="btn btn-primary" name="View" id="View" onclick="showModal(\'' . $row['image'] . '\', \'' . $row['First_Name'] . '\', \'' . $row['Last_Name'] . '\', \'' . $row['message'] . '\', \'' . $row['image_nf'] . '\');">View</button>
                
                                        </div>';
                                        
                                } else if ($row['status_nf'] === 'decline') {
                                    echo '<br> Post has been declined.';
                                    echo '<div class="notification-buttons">
                                        <button class="btn btn-success" name="Approve" id="Approve" disabled>Approve</button>
                                        <button class="btn btn-danger" name="Decline" id="Delete" onclick="approveRequest(' . $row['news_id'] . ', ' . $row['user_id'] . ',  \'delete\');">Delete</button>
                                        <button class="btn btn-primary" name="View" id="View" onclick="showModal(\'' . $row['image'] . '\', \'' . $row['First_Name'] . '\', \'' . $row['Last_Name'] . '\', \'' . $row['message'] . '\', \'' . $row['image_nf'] . '\');">View</button>
                
                                        </div>';
                                }
                                echo '
                            </div>
                        </div>
                    </li>';
                }
            }
        ?>
            
        </ul>
    </div>
</div>
                    <?php else: ?>
                        <!-- Add code for non-admin users if needed -->
                    <?php endif; ?>


                  

                        <div class="text-end">
                            <span class="time" id="date"></span> <br />
                            <span class="time" id="time"></span>
                        </div>
                        <div class="">
                            <div class="dropdown">
                                <button class="btn btn-link" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./images/pfp.png" style="width: 80%" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="sprofile.php">
                                        <img src="<?php echo $image; ?>" class="mx-auto" style="width: 50px; height: 50px; border-radius: 50%;" />
                                            <?php echo $First_Name . ' ' . $Last_Name?></a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">
                                            <img src="./images/logout.png" class="me-3" />Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                
                <div style="
              width: 8%;
              background: linear-gradient(
                180deg,
                #d9d9d9 0%,
                rgba(217, 217, 217, 0) 100%
              );
              border-radius: 20px;
            " class="m-5">
                
                <!-- <div id="piechart" style="width: 500px; height: 500px; background: linear-gradient(180deg, #d9d9d9 0%, rgba(217, 217, 217, 0) 100%); border-radius: 20px;"></div> -->
                <div id="piechart" style="width: 500px; height: 500px; background: linear-gradient(180deg, #3498db 0%, rgba(53, 152, 219, 0) 100%); border-radius: 20px;"></div>

                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <form>
                <label class="mt-5" for="year">Select Year:</label>
                <select class="form-select align-self-end " id="year" name="year" onchange="drawChart(this.value)">
                    <option value="">Select</option>
                    <?php foreach ($years as $year) { ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Submit">
            </form>
                <div style="
              background: linear-gradient(
                180deg,
                #d9d9d9 0%,
                rgba(217, 217, 217, 0) 100%
              );
              border-radius: 20px;
            " class="mt-3 pt-3">
                    <h6>
                        This pie chart visually represents the employment distribution of
                        Bachelor of Science in Information Technology graduates. The chart
                        is divided into segments, with each segment representing the
                        proportion of employed and unemployed individuals within the
                        cohort.
                    </h6>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">View Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="padding: 10px; display: flex;">
                        <img src="" id="modalImage" style="width: 50px; height: 50px; border-radius: 50%;  margin-right: 10px" />
                        <p><strong>Name: </strong><span id="modalName"></span></p>
                    </div>

                    <p><strong>Message: </strong><span id="modalMessage"></span></p>
                    <center>
                        <img src="" alt="User Image" id="modalImage_nf" class="img-fluid " />
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
function approveRequest(newsID, notificationId, status) {
    console.log('as');
    // Send an AJAX request to update the status to 'approved'
    console.log(newsID);
    console.log(notificationId);
    console.log(status);
    // let successModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    //         successModal.show();
    $.ajax({
        type: 'POST',
        url: 'update_status.php', // Replace with the actual server-side script
        data: { 
            newsID: newsID,
            notificationId: notificationId,
            status: status

        },
        success: function(response) {
            // Handle the response if needed
            console.log(response);
        },
        error: function(error) {
            // Handle the error if needed
            console.error(error);
        }
    });

    
}

// function showModal(image, First_Name, Last_Name, message, image_nf) {
//         console.log(image);
//         console.log(First_Name);
//         console.log(Last_Name);
//         console.log(message);
//         console.log(image_nf);

//         let successModal = new bootstrap.Modal(document.getElementById('exampleModal'));
//         successModal.show();
//         console.log('modal showed');
//     }

function showModal(image, firstName, lastName, message, image_nf) {
        document.getElementById('modalImage').src = image;
        document.getElementById('modalName').innerText = firstName + ' ' + lastName;
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('modalImage_nf').src = image_nf;
        $('#exampleModal').modal('show');
    }
</script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart(selectedYear) {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Status');
            data.addColumn('number', 'Count');

            <?php
            if (isset($_GET['year'])) {
                $selectedYear = $_GET['year'];
                $sqlData = "SELECT user_employed, user_unemployed FROM employed WHERE year = $selectedYear";
                $resultData = mysqli_query($conn, $sqlData);
                $row = mysqli_fetch_assoc($resultData);
                $employedCount = $row['user_employed'];
                $unemployedCount = $row['user_unemployed'];
                echo "data.addRows([['Employed', $employedCount], ['Unemployed', $unemployedCount]]);";
            }
            ?>

            var options = {
                title: 'List of Students has already have a job'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

<script type="text/javascript">
    var Tawk_API = Tawk_API || {};
    var Tawk_LoadStart = new Date();

    // Set visitor attributes
    var visitorAttributes = {
        'name': '<?php echo $First_Name . ' ' . $Last_Name?>',  // Set the desired visitor name dynamically
        'hash': 'hash-value'
    };

    var s1 = document.createElement("script");
    var s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/6577255607843602b800e41c/1hhcmjmjo';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s1.onload = function () {
        // Set attributes after the Tawk.to script has loaded
        Tawk_API = Tawk_API || {};
        Tawk_API.onLoad = function () {
            Tawk_API.setAttributes(visitorAttributes, function (error) {
                if (error) {
                    console.error('Error setting attributes:', error);
                }
            });
        };
    };

    s0.parentNode.insertBefore(s1, s0);
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
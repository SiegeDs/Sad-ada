<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <!-- This is the HTML-->
    <nav class="navbar navbar-expand-lg border-bottom bg-dark">
        <div class="container-fluid">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text">
                        GRADUATES' TRACING <br />
                        SYSTEM <img src="./images/snowflake.png" width="20" />
                    </div>
                    <nav class="nav m-2">
                        <a class="nav-link <?= (($title == 'Manage Account') ? 'active text-warning' : "text-light") ?>" aria-current="page" href="manage_acc.php">
                            Manage Account
                        </a>
                        <a class="nav-link <?= (($title == 'Newsfeed') ? 'active text-warning' : "text-light") ?>" href="newsfeed.php">
                            Newsfeed
                        </a>
                    </nav>
                    <div class="d-flex gap-3 align-items-center">
                        <?php if ($user_login === 'admin') : ?>
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
                                <b>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</b>';

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
                        <?php else : ?>
                            <!-- Add code for non-admin users if needed -->
                        <?php endif; ?>




                        <div class="text-end">
                            <span class="time" id="date"></span> <br />
                            <span class="time" id="time"></span>
                        </div>
                        <div class="">
                            <div class="dropdown">
                                <button class="btn btn-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./images/pfp.png" style="width: 80%" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="sprofile.php">
                                            <img src="<?php echo $image; ?>" class="mx-auto" style="width: 50px; height: 50px; border-radius: 50%;" />
                                            <?php echo $First_Name . ' ' . $Last_Name ?></a>
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
    <?php echo $content; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
</body>

</html>
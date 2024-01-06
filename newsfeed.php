<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
}
$user_login = $_SESSION["user_type"];
$login_user = $_SESSION["Login_id"];
// echo $user_login;
include 'database.php';
$sql = "SELECT * FROM `users` WHERE `StudentNo` = '$login_user'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
        $First_Name = $row['First_Name'];
        $Last_Name = $row['Last_Name'];
        $Sex = $row['Sex'];
        $DateBirth = $row['DateBirth'];
        $ContactNo = $row['ContactNo'];
        $YearGraduate = $row['YearGraduate'];
        $CurrentAddress = $row['CurrentAddress'];
        $status= $row['status'];
        $Password = $row['Password'];
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

if (isset($_POST['upload'])){
    $file = $_FILES['image']['name'];
     $post_text = $_POST['post_text'];
    $query = "INSERT INTO `newsfeed`(`user_id`, `message`, `status_nf`, `image_nf`) VALUES ('$user_id','$post_text','pending','$file')";
    
    $res = mysqli_query($conn,$query);
    if($res){
        move_uploaded_file($_FILES['image']['tmp_name'],"$file");
        header("Location: newsfeed.php");
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
                        <a class="nav-link active text-warning" href="newsfeed.php">Newsfeed</a>
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
                                    <img src="./images/pfp.png" style="width: 80%" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="sprofile.php">
                                            <img src="<?php echo $image; ?>" class="me-3" style="width: 50px; height: 50px; border-radius: 50%;"/>
                                            <?php echo $First_Name . ' ' . $Last_Name?></a>
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
    <div class="container text-center pt-5">
        <div class="row">
            <div class="col-2">
                <div style="
              background: #fffdfd;
              box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              border-radius: 15px;
            " class="align-baseline">
                    <button type="button" class="p-3 btn">
                        <img src="./images/upload.png" style="width: 25px" />
                        Upload Job Offer</button><br />
                    <button type="button" class="p-3 btn">
                        <img src="./images/add.png" style="width: 25px" />
                        Job Preferences
                    </button>
                </div>
            </div>
            <div class="col">
                <div style="
              background: white;
              box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              border-radius: 10px;
            ">
                    <button type="button" class="p-1 mx-5 btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="./images/gallery.png" style="width: 25px" />
                        Media
                    </button>
                    <button type="button" class="p-1 mx-5 btn">
                        <img src="./images/calendar.png" style="width: 25px" />
                        Events
                    </button>
                    <button type="button" class="p-1 mx-5 btn">
                        <img src="./images/newspaper.png" style="width: 25px" />
                        Article 
                    </button>
                </div>
                


<?php 
$sql_post = "SELECT * FROM `newsfeed` 
JOIN users ON newsfeed.`user_id` = users.`user_id`
WHERE newsfeed.`status_nf` = 'approved' ORDER by news_id DESC";
$result = mysqli_query($conn, $sql_post);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $profileImage = $row['image_nf'];

        if ($profileImage !== null) {
            $profileImage = $row['image_nf'];
        } else {
            // Use a default image path
            $profileImage = "Images/pfp.png";
        }

    // $profileImage = $row['image'] !== null ? $row['image'] : "Images/pfp.png";
    $message = $row['message'] !== null ? '<p style="font-size: 16px; margin-bottom: 10px; text-align: justify;">' . $row['message'] . '</p>' : '';

    echo '<div style="background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px; margin: 20px auto; overflow: hidden; max-height: 500px">

    <!-- Upper Section with Image and Name -->
    <div style="padding: 10px; display: flex; align-items: center; border-bottom: 1px solid #ddd;">
        <img src="'. $image .'" alt="Profile Image" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
        <span style="font-weight: bold;">'. $row['First_Name'] . ' ' .$row['Last_Name'].'</span>
    </div>

    <!-- Center Section with Message and Image -->
    <div style="text-align: center; padding: 10px;">
        ' . $message . '
        <img src="'. $profileImage .'" alt="Center Image" style="max-width: 100%; border-radius: 8px; margin: 0; max-height: 300px;     ">
    </div>

    </div>';
    }
}    
?>
                
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <dixv class="modal-content">
    <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h5 class="modal-title">Upload Job Offer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input class="my-3 form-control" type="text" id="post_text" name="post_text" placeholder="Type a Job offer.">
            <input type="file" name="image">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="upload" value="Upload" class="btn btn-primary" onclick="reloadPage()">Save changes</button>

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
<!--End of Tawk.to Script-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
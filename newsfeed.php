<?php
$title = "Newsfeed";
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
        $status = $row['status'];
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
} else {
    echo 'User not found';
}

if (isset($_POST['upload'])) {
    $file = $_FILES['image']['name'];
    $post_text = $_POST['post_text'];
    $query = "INSERT INTO `newsfeed`(`user_id`, `message`, `status_nf`, `image_nf`) VALUES ('$user_id','$post_text','pending','$file')";

    $res = mysqli_query($conn, $query);
    if ($res) {
        move_uploaded_file($_FILES['image']['tmp_name'], "$file");
        header("Location: newsfeed.php");
    }
}
ob_start();
?>
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
        <img src="' . $image . '" alt="Profile Image" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
        <span style="font-weight: bold;">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</span>
    </div>

    <!-- Center Section with Message and Image -->
    <div style="text-align: center; padding: 10px;">
        ' . $message . '
        <img src="' . $profileImage . '" alt="Center Image" style="max-width: 100%; border-radius: 8px; margin: 0; max-height: 300px;     ">
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

<script>
    function reloadPage() {
        location.reload();
    }
</script>



<script type="text/javascript">
    var Tawk_API = Tawk_API || {};
    var Tawk_LoadStart = new Date();

    // Set visitor attributes
    var visitorAttributes = {
        'name': '<?php echo $First_Name . ' ' . $Last_Name ?>', // Set the desired visitor name dynamically
        'hash': 'hash-value'
    };

    var s1 = document.createElement("script");
    var s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/6577255607843602b800e41c/1hhcmjmjo';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s1.onload = function() {
        // Set attributes after the Tawk.to script has loaded
        Tawk_API = Tawk_API || {};
        Tawk_API.onLoad = function() {
            Tawk_API.setAttributes(visitorAttributes, function(error) {
                if (error) {
                    console.error('Error setting attributes:', error);
                }
            });
        };
    };

    s0.parentNode.insertBefore(s1, s0);
</script>
<!--End of Tawk.to Script-->
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/student_layout.php';
?>
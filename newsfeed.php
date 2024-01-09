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

// get logged in user's info
$sqlYears = "SELECT DISTINCT year FROM employed";
$resultYears = mysqli_query($conn, $sqlYears);
$years = array();
while ($rowYears = mysqli_fetch_assoc($resultYears)) {
    $years[] = $rowYears['year'];
}
$sqlemploymentLength = "SELECT DISTINCT length_firstjob FROM employment_data";
$resultemploymentLength = mysqli_query($conn, $sqlemploymentLength);
$emloyementLength = array();
while ($rowLength = mysqli_fetch_assoc($resultemploymentLength)) {
    $emloyementLength[] = $rowLength['length_firstjob'];
}


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

// upload post
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

// load posts
$sql_post = "SELECT * FROM `newsfeed` JOIN users ON newsfeed.`user_id` = users.`user_id` WHERE newsfeed.`status_nf` = 'approved' ORDER by news_id DESC";
$post_results = mysqli_query($conn, $sql_post);

ob_start();
?>
<div class="container p-5">
    <div class="row">
        <div class="col-3">
            <div class="align-baseline bg-white shadowed rounded-4 d-flex flex-column align-items-start">
                <a type="button" class="p-3 btn btn-iconed d-flex gap-2 align-items-center " href="JobPreferences.php">
                    <img src="./images/add.png" />
                    <span>Job Preferences</span>

                </a>
                <form class="w-100">
                    <div class="p-4">
                        <label for="year"> Graduates</label>
                    </div>
                    <div id="piechart_graduate" class="w-100"></div>
                </form>
                <form class="w-100">
                    <div class="p-4">
                        <label for="year"> Employment Status</label>
                    </div>
                    <div id="piechart_status" class="w-100"></div>
                </form>
            </div>
        </div>
        <div class="col m-4">
            <div class="shadowed bg-white rounded-3 d-flex justify-content-around">
                <button type="button" class="p-1 btn btn-iconed" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="./images/gallery.png" />
                    Media
                </button>
                <button type="button" class="p-1 btn btn-iconed">
                    <img src="./images/calendar.png" />
                    Events
                </button>
                <button type="button" class="p-1 btn btn-iconed">
                    <img src="./images/newspaper.png" />
                    Article
                </button>
            </div>
            <?php while ($post = $post_results->fetch_assoc()) : ?>
                <div class="bg-white shadowed rounded-3 my-4 d-flex flex-column">
                    <!-- Upper Section with Image and Name -->
                    <div class="p-2 d-flex align-items-center border-bottom gap-2">
                        <img src="<?= $image ?>" alt="Profile Image" class="rounded-circle avatar-post">
                        <span class="fw-bold"><?= $post['First_Name'] . ' ' . $post['Last_Name'] ?></span>
                    </div>
                    <!-- Center Section with Message and Image -->
                    <div class="p-2">
                        <?php if ($post['message']) : ?>
                            <p><?= $post['message'] ?></p>
                        <?php endif ?>
                        <?php if ($post['image_nf']) : ?>
                            <img src="<?= $post['image_nf'] ? $post['image_nf'] : "https://placehold.co/300x200"; ?>" alt="Center Image" class="rounded-2 w-100">
                        <?php endif ?>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
        <div class=" col-3">
            <div class="align-baseline bg-white shadowed rounded-4 d-flex flex-column align-items-start">
                <p class="h5 p-4">
                <form class="w-100">
                    <div id="piechart" class="w-100"></div>
                    <div class="p-4">
                        <label for="year">Select Year:</label>
                        <div class="d-flex">
                            <select class="form-select align-self-end" id="year" name="year" onchange="drawChart(this.value)">
                                <option value=""> Select</option>
                                <?php foreach ($years as $year) { ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php } ?>
                            </select>
                            <input class="btn btn-success" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
                <form class="w-100">
                    <div id="piechart_firstjob" class="w-100"></div>
                    <div class="p-4">
                        <label for="year"> Length of First Job</label>
                    </div>
                </form>
                </p>
            </div>
        </div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
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
            title: 'Students and their contribution'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Count');


        <?php
        $sqlData = "SELECT length_firstjob, COUNT(*) AS length_first FROM employment_data GROUP BY length_firstjob";
        $resultData = mysqli_query($conn, $sqlData);
        while ($row = $resultData->fetch_assoc()) {
            $firstjob_label = $row['length_firstjob'];
            $firstjob_count = $row['length_first'];
            echo "data.addRow(['$firstjob_label', $firstjob_count]);";
            echo "console.log('$firstjob_label $firstjob_count');";
            //done2
        }
        ?>

        var options = {
            title: 'Length to find First Job '
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart_firstjob'));

        chart2.draw(data, options);
    }
    drawChart2();
</script>
<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Count');


        <?php
        $sqlData = "SELECT YearGraduate, COUNT(*) AS grad FROM users GROUP BY YearGraduate";
        $resultData = mysqli_query($conn, $sqlData);
        while ($row = $resultData->fetch_assoc()) {
            $yearGraduate_label = $row['YearGraduate'];
            $yearGraduate_count = $row['grad'];
            echo "data.addRow(['$yearGraduate_label', $yearGraduate_count]);";
            echo "console.log('$yearGraduate_label $yearGraduate_count');";
            //done2
        }
        ?>

        var options = {

        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart_graduate'));

        chart2.draw(data, options);
    }
    drawChart3();
</script>
<script type="text/javascript">
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart4() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Count');


        <?php
        $sqlData = "SELECT employment_status, COUNT(*) AS stat FROM employment_data GROUP BY employment_status";
        $resultData = mysqli_query($conn, $sqlData);
        while ($row = $resultData->fetch_assoc()) {
            $status_label = $row['employment_status'];
            $status_count = $row['stat'];
            echo "data.addRow(['$status_label', $status_count]);";
            echo "console.log('$status_label $status_count');";
            //done2
        }
        ?>

        var options = {

        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart_status'));

        chart2.draw(data, options);
    }
    drawChart4();
</script>

<!--End of Tawk.to Script-->
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/student_layout.php';
?>
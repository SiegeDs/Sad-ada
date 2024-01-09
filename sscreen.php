<?php
$title = "Job Charts";
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
        $status = $row['status'];
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
} else {
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
ob_start();
?>
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
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/student_layout.php';
?>
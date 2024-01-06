<?php
include 'database.php';

// Get distinct years from the employed table
$sqlYears = "SELECT DISTINCT year FROM employed";
$resultYears = mysqli_query($conn, $sqlYears);
$years = array();
while ($rowYears = mysqli_fetch_assoc($resultYears)) {
    $years[] = $rowYears['year'];
}

?>

<html>
<head>
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
                title: 'Students and their contribution'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <form>
        <label for="year">Select Year:</label>
        <select class="form-select align-self-end mt-5" id="year" name="year" onchange="drawChart(this.value)">
            <option value="">Select</option>
            <?php foreach ($years as $year) { ?>
                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Submit">
    </form>

    <div id="piechart" style="width: 500px; height: 500px;"></div>
</body>
</html>

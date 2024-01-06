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
    <nav class="navbar navbar-expand-lg border-bottom bg-dark">
        <div class="container-fluid">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text">
                        GRADUATES' TRACING <br />
                        SYSTEM <img src="./images/snowflake.png" width="20" />
                    </div>
                    <div class="nav">
                        <a class="nav-link <?= (($title == 'Features') ? 'active text-warning' : "text-light") ?>" href="features.php">Features</a>
                        <a class="nav-link <?= (($title == 'About') ? 'active text-warning' : "text-light") ?>" href="about.php">About</a>
                    </div>
                    <div class="nav">
                        <a class="btn <?= (($title == 'Sign in') ? 'btn-light"' : "btn-dark") ?>" href="signin.php">Sign In</a>
                        <a class="btn <?= (($title == 'Sign up') ? 'btn-light"' : "btn-dark") ?>" href="signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <?php echo $content; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>
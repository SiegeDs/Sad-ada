<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
}
$user_login = $_SESSION["user_type"];
$login_user = $_SESSION["Login_id"];
// echo $user_login;
include 'database.php';


$sql_post = "SELECT * FROM `users` ";
$post_results = mysqli_query($conn, $sql_post); 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />    
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
    <nav class="navbar fixed-top navbar-expand-lg border-bottom bg-dark">
      <div class="container-fluid">
        <div class="container">
          <div class="d-flex justify-content-between">
            <div class="text">
              GRADUATES’ TRACING <br />
              SYSTEM <img src="./images/snowflake.png" class="w-5%" />
            </div>
            <nav class="nav m-2">
              <a class="nav-link text-light" aria-current="page" href="#"
                >Chart
              </a>
              <a class="nav-link text-light" href="#">Newsfeed</a>
            </nav>
            <div class="d-flex gap-3 align-items-center">
              <div class="dropdown">
                <button
                  class="btn btn-link"
                  type="button"
                  id="dropdownMenuButton1"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img src="./images/notification.png" style="width: 30px" />
                </button>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="dropdownMenuButton1"
                >
                  <li style="width: 300px" class="container">
                    <p style="text-align: left; font-weight: bold">
                      Notifications
                    </p>
                    <p style="text-align: center">No new notifications</p>
                  </li>
                </ul>
              </div>
              <div class="text-end">
                <span class="time"> December 11, 2023</span> <br />
                <span class="time"> 11:20am </span>
              </div>
              <div class="">
                <div class="dropdown">
                  <button
                    class="btn btn-link"
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <img src="./images/pfp.png" style="width: 80%" />
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="dropdownMenuButton1"
                  >
                    <li>
                      <a class="dropdown-item" href="#">
                        <img src="./images/pfpopt.png" class="me-3" />Michelle
                        Abrahan</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <img src="./images/logout.png" class="me-3" />Log Out</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <button type="button" class="btn btn-warning mb-2" style="margin-top: 150px; margin-left: 1100px;" id="create" data-toggle="modal"
              data-target="#CreateModal">Create</button>
    <table class="table" style=" max-width: 800px; margin-left: 390px">
                  <thead>
                    <tr class="table-dark">
                      <th scope="col">User ID   </th>
                      <th scope="col">Name</th>
                      <th scope="col">Student No.</th>
                      <th scope="col">Year Graduated</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($post = $post_results->fetch_assoc()) : ?>
                    <tr>
                      <td>
                        <p> <?= $post['user_id'] ?>  </p>
                      </td>
                      <td>
                        <p> <?= $post['First_Name'] . ' ' . $post['Last_Name'] ?> </p>
                      </td>
                      <td>
                        <p> <?= $post['StudentNo'] ?> </p>
                      </td>
                      <td>
                        <p> <?= $post['YearGraduate'] ?> </p>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
              data-target="#EventModal">Edit</button>
                      <button type="button" class="btn btn-danger" > Delete</button>
                      </td>
                    </tr>
                    <?php endwhile?>
                  </tbody>
                </table>
                
    <div
      class="modal fade modal-m"
      id="CreateModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <p style="font-weight: bold; font-size: 35px">
                Create User
              </p>
              
            </h5>
            <buttons
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              style="width: 50px;"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
            <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="First Name"/>
            <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="Last Name"/>
            <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="Student Number"/>
            <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="Year Graduated"/>
            <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="Password"/>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" name="create" value="create" id="create" class="btn btn-primary">Create</button>

            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="dismiss_modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container text-center">
    <div class="row">
        <div class="col">
            <div class="modal" id="EventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header" style="background-color: #0A0876; color: #fff;">
                                <h5 class="modal-title" id="title">Update information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input class="my-3 form-control" type="text" name="first_name_modal" placeholder="First Name" value="<?php echo $First_Name ?>" required />
                                <input class="my-3 form-control" type="text" name="last_name_modal" placeholder="Last Name" value="<?php echo $Last_Name ?>" required />
                                <input class="my-3 form-control" type="text" name="year_graduated_modal" placeholder="Year Graduated" value="<?php echo $YearGraduate ?>" required />
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_modal" id="password" placeholder="Password" autocomplete="current-password" value="<?php echo $CurrentAddress ?>">
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
        </div>
    </div>
</div>
<script>
    document.getElementById('EventModal').addEventListener('click', function() {
        let successModal = new bootstrap.Modal(document.getElementById('success_modal'));
        successModal.show();
    });
</script>
    <script>
    document.getElementById('create').addEventListener('click', function(event) {   
        event.preventDefault(); // Prevent the default form submission

        var first_name = document.getElementById('first_name').value;
        var year_graduated = document.getElementById('year_graduated').value;
        var last_name = document.getElementById('last_name').value;
        var student_no = document.getElementById('student_no').value;

        console.log('SIGN UP year_graduated' + year_graduated);

        if (first_name === "" ||
            year_graduated === "" ||
            last_name === "" ||
            student_no === ""
        ) {
            // Do something if first_name is empty
            return;
        }
        var formData = new FormData();
        formData.append('first_name', first_name);
        formData.append('year_graduated', year_graduated);
        formData.append('last_name', last_name);
        formData.append('student_no', student_no);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'sign_up_student.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log("User registration successful!");
                window.location.href = "manage_acc.php";
            } else {
                console.log("Error Password: ");
            }
        };
        xhr.send(formData);
    });
</script> 
                <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

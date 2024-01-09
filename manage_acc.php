<?php
$title = "Manage Accounts";
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

$sql_post = "SELECT * FROM `users` ";
$post_results = mysqli_query($conn, $sql_post);

ob_start();
?>
<div class="container">
  <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-warning mb-2 mt-5" data-bs-toggle="modal" data-bs-target="#CreateModal" onclick="setModalMode('create')">Create</button>
  </div>
  <table class="table">
    <thead>
      <tr class="table-dark">
        <th scope="col">User ID </th>
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
            <p> <?= $post['user_id'] ?> </p>
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
          <td class="d-flex gap-1">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#CreateModal" onclick="setModalMode('update', '<?= $post['StudentNo'] ?>')">Edit</button>
            <button type="button" class="btn btn-danger" onclick="deleteAcc('<?= $post['StudentNo'] ?>')"> Delete</button>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<div class="modal fade modal-m" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label">Create User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container text-center">
          <div class="row">
            <div class="col">
              <input class="my-3 form-control" type="text" id="first_name" placeholder="First Name" required />
              <input class="my-3 form-control" type="date" id="date_of_birth" placeholder="Date of Birth" required />
              <input class="my-3 form-control" type="text" id="contact_no" placeholder="Contact No." required />
              <input class="my-3 form-control" type="text" id="year_graduated" placeholder="Year Graduated" required />
              <!-- <input class="my-3 form-control" type="text" name="password" id="password" placeholder="Password" /> -->
              <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="current-password">
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility('password', 'togglePasswordBtn')">Show</button>
              </div>
            </div>
            <div class="col">
              <input class="my-3 form-control" type="text" id="last_name" placeholder="Last Name" required />
              <div class="my-3">
                <select class="form-select" id="sexSelect" name="sex">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <input class="my-3 form-control" type="text" id="current_address" placeholder="Current Address" required />
              <input class="my-3 form-control" type="text" id="student_no" placeholder="Student No." required />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" name="create" value="create" id="create" class="btn btn-primary">Create</button>
        <button type="button" name="update" value="update" id="update" class="btn btn-primary">Update</button>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-target="#CreateModal" id="dismiss_modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<script>
  function setModalMode(state, stud_no = 0) {
    switch (state) {
      case "update":
        document.getElementById('update').style.display = "inline-block";
        document.getElementById('create').style.display = "none";
        document.getElementById('modal-label').textContent = "Update User";
        loadAcc(stud_no)
        break;
      case "create":
        document.getElementById('update').style.display = "none";
        document.getElementById('create').style.display = "inline-block";
        document.getElementById('modal-label').textContent = "Create User";
        break;
      default:
        break;
    }
  }
</script>
<script>
  function deleteAcc(stud_no) {
    var formData = new FormData();
    formData.append('student_no', stud_no);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_student.php', true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        console.log("Delete successful!");
        window.location.href = "manage_acc.php";
      } else {
        console.log("Error Password: ");
      }
    };
    xhr.send(formData);
  }

  function newAcc() {

    $('#first_name').val("");
    $('#date_of_birth').val("");
    $('#contact_no').val("");
    $('#year_graduated').val("");
    $('#password').val("");
    $('#last_name').val("");
    $('#current_address').val("");
    $('#student_no').val("");
  }

  function loadAcc(stud_no) {
    $.ajax({
      url: 'load_student.php',
      method: 'GET',
      dataType: 'json',
      data: {
        id: stud_no
      },
      success: function(student) {
        $('#first_name').val(student.First_Name);
        $('#date_of_birth').val(student.DateBirth);
        $('#contact_no').val(student.ContactNo);
        $('#year_graduated').val(student.YearGraduate);
        $('#password').val(student.Password);
        $('#last_name').val(student.Last_Name);
        $('#sexSelect').val(student.Sex).change();
        $('#current_address').val(student.CurrentAddress);
        $('#student_no').val(student.StudentNo);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }
  // creates an account for another user
  document.getElementById('create').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    var first_name = document.getElementById('first_name').value;
    var date_of_birth = document.getElementById('date_of_birth').value;
    var contact_no = document.getElementById('contact_no').value;
    var year_graduated = document.getElementById('year_graduated').value;
    var password = document.getElementById('password').value;
    var last_name = document.getElementById('last_name').value;
    var sexSelect = document.getElementById('sexSelect').value;
    var current_address = document.getElementById('current_address').value;
    var student_no = document.getElementById('student_no').value;

    if (first_name === "" ||
      date_of_birth === "" ||
      contact_no === "" ||
      year_graduated === "" ||
      password === "" ||
      last_name === "" ||
      sexSelect === "" ||
      current_address === "" ||
      student_no === ""
    ) {
      // Do something if first_name is empty
      return;
    }
    var formData = new FormData();
    formData.append('first_name', first_name);
    formData.append('date_of_birth', date_of_birth);
    formData.append('contact_no', contact_no);
    formData.append('year_graduated', year_graduated);
    formData.append('password', password);
    formData.append('last_name', last_name);
    formData.append('sexSelect', sexSelect);
    formData.append('current_address', current_address);
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

  document.getElementById('update').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    var first_name = document.getElementById('first_name').value;
    var date_of_birth = document.getElementById('date_of_birth').value;
    var contact_no = document.getElementById('contact_no').value;
    var year_graduated = document.getElementById('year_graduated').value;
    var password = document.getElementById('password').value;
    var last_name = document.getElementById('last_name').value;
    var sexSelect = document.getElementById('sexSelect').value;
    var current_address = document.getElementById('current_address').value;
    var student_no = document.getElementById('student_no').value;

    if (first_name === "" ||
      date_of_birth === "" ||
      contact_no === "" ||
      year_graduated === "" ||
      password === "" ||
      last_name === "" ||
      sexSelect === "" ||
      current_address === "" ||
      student_no === ""
    ) {
      // Do something if first_name is empty
      return;
    }
    var formData = new FormData();
    formData.append('first_name', first_name);
    formData.append('date_of_birth', date_of_birth);
    formData.append('contact_no', contact_no);
    formData.append('year_graduated', year_graduated);
    formData.append('password', password);
    formData.append('last_name', last_name);
    formData.append('sexSelect', sexSelect);
    formData.append('current_address', current_address);
    formData.append('student_no', student_no);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_student.php', true);
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
</body>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/student_layout.php';
?>
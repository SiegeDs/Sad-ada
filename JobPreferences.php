<?php
$title = "Job Preferences";
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
<div class="container mt-5">
  <div class="row">
    <div class="col" style="padding-top: 100px">
      <div>
        <img src="./images/job.jpeg" style="border-radius: 10%; margin-bottom: 100px" />
      </div>
    </div>
    <div class="col" style="padding-top: 100px">
      <div style="
              background: #fff8f8;
              border-radius: 20px;
              max-height: 450px;
              overflow: auto;
            ">
        <div class="container">
          <div class="row p-4">
            <p style="font-size: 30px; text-align: left">
              General Information
            </p>
            <div class="col">
              <input class="my-3 form-control" type="text" placeholder="Name" />
              <input class="my-3 form-control" type="text" placeholder="Permanent Address" />
              <input class="my-3 form-control" type="text" placeholder="Email Address" />
              <input class="my-3 form-control" type="text" placeholder="Contact No." />
            </div>
            <div class="col">
              <select class="form-select form-select-m mt-3" aria-label="Large select example">
                <option selected>Civil Status</option>
                <option value="1">Single</option>
                <option value="2">Married</option>
                <option value="3">Separeted</option>
                <option value="3">Single Parent</option>
                <option value="3">Widow or Widower</option>
              </select>
              <select class="form-select form-select-m mt-3" aria-label="Large select example">
                <option selected>Region of Origin</option>
                <option value="1">Region 1</option>
                <option value="1">Region 2</option>
                <option value="1">Region 3</option>
                <option value="1">Region 4</option>
                <option value="1">Region 5</option>
                <option value="1">Region 6</option>
                <option value="1">Region 7</option>
                <option value="1">Region 8</option>
                <option value="1">Region 9</option>
                <option value="1">Region 10</option>
                <option value="1">Region 11</option>
                <option value="1">Region 12</option>
                <option value="1">NCR</option>
                <option value="1">CAR</option>
                <option value="1">ARMM</option>
                <option value="1">CARAGA</option>
              </select>
              <input class="my-3 form-control" type="text" placeholder="Province" />
              <select class="form-select form-select-m mt-3" aria-label="Large select example">
                <option selected>Location of Residence</option>
                <option value="1">City</option>
                <option value="2">Province</option>
              </select>
            </div>
            <p style="font-size: 28px">Educational Background</p>
            <label class="form-label">
              Educational Attainement (Baccalaureate Degree only)</label>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Degree of Specialization</th>
                  <th scope="col">College or University</th>
                  <th scope="col">Year of Graduated</th>
                  <th scope="col">Honor(s) or Awards(s) Recieved</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>

                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>

                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
              </tbody>
            </table>
            <label class="form-label">
              Educational Attainement (Baccalaureate Degree only)</label>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name of Examination</th>
                  <th scope="col">Date Taken</th>
                  <th scope="col">Rating</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>

                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
              </tbody>
            </table>
            <label class="form-label">
              Reason(s) for taking the course(s) or pursuing degree(s). You
              may check () more than one answer</label>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Undergraduate/AB/BS</th>
                  <th scope="col">Graduate/MS/MA/PhD</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    High grades in the course or subject area(s) related to
                    the course
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Good grades in high school</td>

                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Influence of parents or relatives</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Peer Influence</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Influence of parents or relatives</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Inspired by a role model</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Prospect for immediate employment</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Status or prestige of the profession</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>
                    Availability of course offering in chosen institution
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Prospect of career advancement</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Affordable for the family</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Prospect of attractive compensation</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Opportunity for employment abroad</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>No particular choice or no better idea</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
              </tbody>
            </table>
            <p style="font-size: 28px; text-align: left">
              TRAINING(S)/ADVANCE STUDIES ATTENDED AFTER COLLEGE
            </p>
            <label class="form-label">
              Please list down all professional or work-related training
              program(s) including advance studies you have attended after
              college. You may use extra sheet if needed.</label>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Title of Training or Advance Study</th>
                  <th scope="col">Duration and Credits Earned</th>
                  <th scope="col">
                    Name of Training Institution/College/University
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>

                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                  <td>
                    <input class="my-3 form-control" type="text" />
                  </td>
                </tr>
              </tbody>
            </table>
            <label class="form-label">
              What made you pursue advance studies?</label>
            <select class="form-select form-select-m mt-3" aria-label="Large select example">
              <option value="1">For Promotion</option>
              <option value="1">For Professional Development</option>
            </select>
            <p style="font-size: 28px; text-align: left">
              Employement Data
            </p>
            <label class="form-label"> Are you presently employed?</label>
            <br />

            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            <label class="form-check-label" for="flexCheckDefault">
              Yes
            </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            <label class="form-check-label" for="flexCheckDefault">
              No
            </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            <label class="form-check-label" for="flexCheckDefault">
              Never Employed
            </label>
            <p class="m-2">
              If <span style="font-weight: bold">NO</span> or
              <span style="font-weight: bold"> NEVER BEEN EMPLOYED</span>,
              proceed to Question 1.
            </p>
            <p class="m-2">
              If <span style="font-weight: bold">YES</span>, proceed to
              Questions 2 to 6.
            </p>
            <label class="form-label m-2">
              1.) Please state reason(s) why you are not yet employed. You
              may check () more than one answer.
            </label>
            <div class="container">
              <div class="row">
                <div class="col">
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Advance or further study
                  </p>

                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Health related reason(s)
                  </p>
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Family concern and decided not to find a job
                  </p>
                </div>
                <div class="col">
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Lack of work experience
                  </p>
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    No job opportunity
                  </p>
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Did not look for a job
                  </p>
                </div>
              </div>
            </div>

            <label class="form-label m-2">
              2.) Present Employment Status
            </label>
            <div class="container">
              <div class="row">
                <div class="col">
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Regular or Permanent
                  </p>
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Temporary
                  </p>
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Casual
                  </p>
                </div>
                <div class="col">
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Contractual
                  </p>
                  <p class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    Self-employed
                  </p>
                </div>
              </div>
            </div>
            <label class="form-label m-2">
              If Self-employed, what skills acquired in college were you
              able to apply in your work?
            </label>
            <input class="my-3 form-control" type="text" />
            <label class="form-label m-2">
              3.) Present occupation (Ex. Grade School Teacher, Electrical
              Engineer, Self-employed)
            </label>
            <input class="my-3 form-control" type="text" />
            <label class="form-label m-2">
              . Major line of business of the company you are presently
              employed in. Check one only.
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Regular or Permanent
            </p>
            <label class="form-label m-2"> 4.) Place of work </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Local
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Abroad
            </p>
            <label class="form-label m-2">
              4.) Is this your
              <span style="font-style: italic; font-weight: bold">first</span>
              job after college?
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Yes
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              No
            </p>
            <p class="m-2">
              If <span style="font-weight: bold">NO</span>
              proceed to Question 7 and 8.
            </p>
            <label class="form-label m-2">
              5.) What are your reason(s) for staying on the job? You may
              check () more than one answer
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Salaries and benefits
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Career challenge
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Related to special skill
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Related to course or program of study
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Proximity to residence
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Peer influence
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Family influence
            </p>
            <label class="form-label m-2">
              6.) What were your reasons for accepting the job? You may
              check () more than one answer.
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Yes
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              No
            </p>
            <label class="form-label m-2">
              7.) . What were your reason(s) for changing job? You may check
              () more than one answer.
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Salaries and benefits
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Career challenge
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Related to special skill
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Proximity to residence
            </p>
            <label class="form-label m-2">
              8.) What were your reason(s) for changing job? You may check
              () more than one answer.
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Salaries and benefits
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Career challenge
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Related to special skill
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Proximity to residence
            </p>
            <label class="form-label m-2">
              9 .) How long did you stay in your first job?
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Salaries and benefits
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Career challenge
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Related to special skill
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Proximity to residence
            </p>
            <label class="form-label m-2">
              10 .) How long did you stay in your first job?
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Less than a month
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              1 to 6 months
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              7 to 11 months
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              1 year to less than 2 years
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              2 years to less than 3 years
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              3 years to less than 4 years
            </p>
            <label class="form-label m-2">
              11 .) How did you find your first job?
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Response to an Advertisement
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              As a walk-in applicant
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Recommended by someone
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              nformation from friends
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Arranged by school’s job placement officer
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Family business
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Job Fair or Public Employment Service Office (PESO)
            </p>
            <label class="form-label m-2">
              12 .) How long did you stay in your first job?
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Less than a month
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              1 to 6 months
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              7 to 11 months
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              1 year to less than 2 years
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              2 years to less than 3 years
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              3 years to less than 4 years
            </p>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Job Level</th>
                  <th scope="col">First Job</th>
                  <th scope="col">Current or Present Job</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Rank or Clerical</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Professional, Technical or Supervisory</td>

                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Managerial or Executive</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
                <tr>
                  <td>Self-employed</td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                  <td style="text-align: center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  </td>
                </tr>
              </tbody>
            </table>
            <label class="form-label m-2">
              12 .) What is your initial gross monthly earning in your first
              job after college?
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Below P5,000.00
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              P5,000.00 to less than P10,000.00
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              P10,000.00 to less than P15,000.00
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              P15,000.00 to less than P20,000.00
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              P 20,000.00 to less than P25,000.00
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              P 25,000.00 and above
            </p>
            <label class="form-label">
              13.) Was the curriculum you had in college relevant to your
              first job?</label>
            <br />

            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            <label class="form-check-label" for="flexCheckDefault">
              Yes
            </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            <label class="form-check-label" for="flexCheckDefault">
              No
            </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />

            <label class="form-label m-2">
              14.) what competencies learned in college did you find very
              useful in your first job? You may check () more than one
              answer.
            </label>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Communication skills
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Human Relations skills
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Entrepreneurial skills
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Information Technology skills
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Problem-solving skills
            </p>
            <p class="form-check-label" for="flexCheckDefault">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
              Critical Thinking skills
            </p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-dark m-3">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/student_layout.php';
?>
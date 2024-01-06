<?php
$title = "Features";
ob_start();
?>
<div class="container text-center">
  <div class="row p-5 m-5 gx-5">
    <div class="col">
      <div class="card d-flex justify-content-between ratio ratio-1x1" style="
              position: relative;
              background: #dde0c7;
              border-top-left-radius: 50px;
            ">
        <div class="p-4">
          <img src="./images/chart.png" style="width: 40%; position: absolute; top: -45px; right: -45px" />
          <br />
          <br />
          <br />
          <br />
          <h2>Employment Status</h2>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card d-flex justify-content-between ratio ratio-1x1" style="
              position: relative;
              background: #dde0c7;
              border-top-left-radius: 50px;
            ">
        <div class="p-4">
          <img src="./images/document.png" style="width: 40%; position: absolute; top: -45px; right: -45px" />
          <br />
          <br />
          <br />
          <br />
          <h2>Job Offers</h2>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card d-flex justify-content-between ratio ratio-1x1" style="
              position: relative;
              background: #dde0c7;
              border-top-left-radius: 50px;
            ">
        <div class="p-4">
          <img src="./images/upload.png" style="width: 40%; position: absolute; top: -45px; right: -45px" />
          <br />
          <br />
          <br />
          <br />
          <h2>Upload Job Opportunities</h2>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/auth_layout.php';
?>
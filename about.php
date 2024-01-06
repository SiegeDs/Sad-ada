<?php
$title = "About";
ob_start();
?>
<div class="container text-center">
  <div class="row">
    <div class="col">
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />

      <div style="text-align: left">
        <span style="
                color: #272d5e;
                font-size: 30px;
                font-weight: 700;
                text-decoration: underline;
                word-wrap: break-word;
              ">ABOUT</span>
        <span style="
                color: #272d5e;
                font-size: 30px;
                font-weight: 700;
                word-wrap: break-word;
              ">
        </span>
        <span style="color: #272d5e; font-size: 20px; font-weight: 700">Graduates’ Tracing System</span>
      </div>
      <div style="
              color: #272d5e;
              font-size: 18px;
              font-weight: 400;
              text-align: left;
            ">
        The “Graduates' Tracing System" is a comprehensive tracer system
        designed to track the employment status of Bachelor of Science in
        Information Technology graduates from Leyte Normal University. This
        system aims to provide a streamlined and efficient process for
        monitoring the career trajectories of alumni, offering valuable
        insights into their professional pursuits after graduation. By
        leveraging technology and comprehensive data collection methods,
        this system facilitates accurate and up-to-date information on the
        employment outcomes of Information Technology graduates, ultimately
        enhancing the university's understanding of the impact of its
        educational programs on the workforce.
      </div>
    </div>
    <div class="col">
      <br />
      <br />
      <br />

      <img src="images/about.png" style="width: 500px; height: 500px" />
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/auth_layout.php';
?>
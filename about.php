<?php
$title = "About";
ob_start();
?>
<div class="container py-5">
  <div class="row align-items-center g-5">
    <div class="col col-12 col-md-6 subtle">
      <div>
        <span class="fw-bold text-decoration-underline h2">ABOUT</span>
        <span class="h4"> Graduates' Tracing System</span>
      </div>
      <div class="mt-2 fs-6">
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
    <div class="col col-12 col-md-6 text-center">
      <img src="images/about.png" class="w-100" />
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/auth_layout.php';
?>
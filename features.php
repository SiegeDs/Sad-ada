<?php
$title = "Features";
$features = array(
  "Employment Status" => "./images/chart.png",
  "Job Offers" => "./images/document.png",
  "Upload Job Opportunities" => "./images/upload.png"
);
ob_start();
?>
<div class="container">
  <div class="row p-5 m-5 g-5">
    <?php foreach ($features as $feature => $img) : ?>
      <div class="col col-12 col-md-6 col-xl-4">
        <div class="card feature ratio ratio-1x1">
          <div>
            <img src="<?= $img ?>" />
          </div>
          <div class="p-4 d-flex justify-content-center align-items-center text-center">
            <h2><?= $feature ?></h2>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php
$content = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/auth_layout.php';
?>
<?php include 'includes/header.php'; include 'includes/nav.php';?>
<?php
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM `tbl_project` where `project_id` = '$id'";
  $result = mysqli_query($con,$sql);
?>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <?php while($row = mysqli_fetch_object($result)): ?>
          <div class="page-header">
            <h1><?= $row -> project_name ?></h1>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

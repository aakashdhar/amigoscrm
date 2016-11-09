<?php include 'includes/header.php'; include 'includes/nav.php';?>
<?php
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM `tbl_project` where `project_id` = '$id'";
  $result = mysqli_query($con,$sql);
?>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="background">
          <?php while($row = mysqli_fetch_object($result)): ?>
            <div class="page-header">
              <h1><?= $row -> project_name ?></h1>
            </div>
            <div class="page-header">
              <h4 style="color : #f1c40f;">Basic Project Details</h4>
            </div>
            <div class="form-group col-md-6">
              <label for="">Client Name:</label>
              <p class="form-control"><?= $row -> client_name  ?></p>
            </div>
            <div class="form-group col-md-6">
              <label for="">Contact Number:</label>
              <p class="form-control"><?= $row -> contact_number  ?></p>
            </div>
            <div class="form-group col-md-4">
              <label for="">Source:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                <p class="form-control"><?= $row -> source  ?></p>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="">Status:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hourglass-start"></i></span>
                <p class="form-control"><?= $row -> status  ?></p>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="">Project Type:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <p class="form-control"><?= $row -> project_type  ?></p>
              </div>
            </div>
            <div class="page-header">
              <h4 style="color : #f1c40f;">Payment Details</h4>
            </div>
            <div class="form-group col-md-2">
              <label for="">Quote:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                <p class="form-control"><?= $row -> quote  ?></p>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="">Client Expectation:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                <p class="form-control"><?= $row -> client_expection  ?></p>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="">Finalized Amount:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                <p class="form-control"><?= $row -> finalized_amount  ?></p>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="">Amount Paid::</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                <p class="form-control"><?= $row -> amt_paid  ?></p>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="">Amount Balance:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                <p class="form-control"><?= $row -> amount_balance  ?></p>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="">Amount Due:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                <p class="form-control"><?= $row -> amt_due?></p>
              </div>
            </div>
            <div class="page-header">
              <h4 style="color : #f1c40f;">Dates</h4>
            </div>
            <div class="form-group col-md-3">
              <label for="">Follow Up Date:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <p class="form-control"><?= $row -> follow_up_date?></p>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="">Meeting Date:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <p class="form-control"><?= $row -> meeting_date ?></p>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="">Start Date:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <p class="form-control"><?= $row -> start_date ?></p>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="">Deadline:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <p class="form-control"><?= $row -> deadline ?></p>
              </div>
            </div>
            <div class="page-header">
              <br><br>
              <h4 style="color : #f1c40f;">Additional Details</h4>
            </div>
            <div class="form-group col-md-6">
              <label for="">Requirements:</label>
              <p class="form-control"><?= $row -> requirements ?></p>
            </div>
            <div class="form-group col-md-6">
              <label for="">Comments:</label>
              <p class="form-control"><?= $row -> comments ?></p>
            </div>
            <div class="form-group col-md-6">
              <a href="modifyproject.php" class=" form-control btn btn-primary"><i class="fa fa-chevron-left"></i>  Back To Modiify Projects</a>
            </div>
            <div class="form-group col-md-6">
              <a href="editproject.php?id=<?= $row -> project_id ?>" class=" form-control btn btn-info">Edit Project <strong><?= $row -> project_name ?></strong>  <i class="fa fa-chevron-right"></i></a>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
  <?php include 'includes/footer.php'; ?>

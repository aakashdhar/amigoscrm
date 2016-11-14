<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $sql = "SELECT * FROM `tbl_status`";
  $result = mysqli_query($con,$sql);

  $sql1 = "SELECT * FROM `tbl_source`";
  $result1 = mysqli_query($con,$sql1);

  $sql2 = "SELECT * FROM `tbl_type`";
  $result2 = mysqli_query($con,$sql2);

 ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 ">
      <div class="page-header">
        <h1>Add Project</h1>
      </div>
      <div class="background">
        <form class="" action="_addproject.php" method="post" role="form">
          <div class="page-header">
            <h4 style="color : #f1c40f;">Basic Project Details</h4>
          </div>
          <div class="form-group col-md-6">
            <label for="name">Project Name:</label><span id="result"></span>
            <input type="text" class="form-control auto" id="name" name="name" placeholder="Enter the Project Name" required="true">
          </div>
          <div class="form-group col-md-6">
            <label for="client">Client Name</label>
            <input type="text" class="form-control" id="client" name="client" placeholder="Enter the Client Name" required="true">
          </div>
          <div class="form-group col-md-3">
            <label for="contact">Contact Number:</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter the Contact Number">
          </div>
          <div class="form-group col-md-3">
            <label for="contact">Source:</label>
            <select class="form-control" name="source">
              <option>Select option</option>
              <?php while($row = mysqli_fetch_object($result1)): ?>
                <option value="<?= $row->source_name ?>"><?= $row->source_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="contact">Status:</label>
            <select class="form-control" name="status">
              <option>Select Status</option>
              <?php while($row1 = mysqli_fetch_object($result)): ?>
                <option value="<?= $row1->status_name?>"><?= $row1->status_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="types">Project Type:</label>
            <select class="form-control" name="types">
              <option>Select option</option>
              <?php while($row2 = mysqli_fetch_object($result2)): ?>
                <?= $row2->type_name ?>
                <option value="<?= $row2->type_name ?>"><?= $row2->type_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-6">
            <div class="page-header">
              <h4 style="color : #f1c40f;">Payment Details</h4>
            </div>
            <div class="form-group col-md-6">
              <label for="quote">Quote:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                  <input type="text" class="form-control" id="quote" name="quote" placeholder="Enter quoted Amount" required>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="paid">Client Expectation:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                  <input type="text" class="form-control" id="paid" name="paid" placeholder="Enter Expected Amount">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="page-header">
              <h4 style="color : #f1c40f;">Dates</h4>
            </div>
            <div class="form-group col-md-6">
              <label for="followupdate">Follow Up Date:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="date" class="form-control" name="followupdate" id="followupdate">
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="meetingdate">Meeting Date:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="date" class="form-control" name="meetingdate" id="meetingdate">
              </div>
            </div>
          </div>
          <div class="page-header">
            <h4 style="color : #f1c40f;">Outsourcing Details</h4>
          </div>
          <div class="form-group col-md-6">
            <label for="outsourced">Outsourced To:</label>
            <input type="text" class="form-control" id="outsourced" name="outsourced" placeholder="Enter Outsourced To">
          </div>
          <div class="form-group col-md-6">
            <label for="outsourcedamt">Outsourced Amount:</label>
            <input type="text" class="form-control" id="outsourcedamt" name="outsourcedamt" placeholder="Enter Outsourced amount">
          </div>
          <div class="page-header">
            <br><br>
            <h4 style="color : #f1c40f;">Additional Details</h4>
          </div>
          <div class="form-group col-md-6">
            <label for="requirements">Requirements:</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="8" cols="40" placeholder="Enter Client Requirments"></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="comments">Comments:</label>
            <textarea class="form-control" id="comments" name="comments" rows="8" cols="40" placeholder="Enter comments"></textarea>
          </div>
          <div class="form-group col-md-8 col-md-offset-2">
            <input type="Submit" class="form-control btn btn-success" id="add" name="add" value="Submit Client Details">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

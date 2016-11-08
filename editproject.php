<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $id = (int)$_REQUEST['id'];
  $sql = "SELECT * FROM `tbl_status`";
  $result = mysqli_query($con,$sql);

  $sql1 = "SELECT * FROM `tbl_source`";
  $result1 = mysqli_query($con,$sql1);

  $sql2 = "SELECT * FROM `tbl_type`";
  $result2 = mysqli_query($con,$sql2);

  $sql3 = "SELECT * FROM `tbl_project` WHERE `project_id` = '$id'";
  $result3 = mysqli_query($con,$sql3);
  $row_edit = mysqli_fetch_object($result3)
?>
<div class="container">
  <div class="row">
    <div class="col-md-12 ">
      <div class="page-header">
        <h1>Add Project</h1>
      </div>
      <div class="background">
        <form class="" action="_editproject.php" method="post" role="form">
          <div class="page-header">
            <h4 style="color : #f1c40f;">Basic Project Details</h4>
          </div>
          <div class="form-group col-md-6">
            <label for="name">Project Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $row_edit -> project_name ?>" placeholder="Enter the Project Name">
          </div>
          <div class="form-group col-md-6">
            <label for="client">Client Name</label>
            <input type="text" class="form-control" id="client" name="client" value="<?= $row_edit -> client_name ?>" placeholder="Enter the Client Name">
          </div>
          <div class="form-group col-md-3">
            <label for="contact">Contact Number:</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?= $row_edit -> contact_number ?>" placeholder="Enter the Contact Number">
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
            <label for="status">Status:</label>
            <select class="form-control" name="status">
              <option value="<?= $row_edit -> status ?>"><?= $row_edit -> status ?></option>
              <option>Select Status</option>
              <?php while($row1 = mysqli_fetch_object($result)): ?>
                <option value="<?= $row1->status_name?>"><?= $row1->status_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="type">Project Type:</label>
            <select class="form-control" name="type">
              <option>Select Type</option>
              <option value="<?= $row_edit -> project_type ?>"></option>
              <?php while($row2 = mysqli_fetch_object($result2)): ?>
                <option value="<?= $row1->type_name?>"><?= $row2 ->type_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="page-header">
            <h4 style="color : #f1c40f;">Payment Details</h4>
          </div>
          <div class="form-group col-md-2">
            <label for="quote">Quote:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                <input type="text" class="form-control" id="quote" name="quote" placeholder="Enter quoted Amount"
                value="<?= (($row_edit -> quote == 0)? '' : $row_edit -> quote )?>">
            </div>
          </div>
          <div class="form-group col-md-2">
            <label for="paid">Client Expectation:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                <input type="text" class="form-control" id="paid" name="paid" placeholder="Enter Expected Amount"
                value="<?= (($row_edit -> client_expection == 0)? '' : $row_edit -> client_expection )?>">
            </div>
          </div>
          <div class="form-group col-md-2">
            <label for="finalpaid">Finalized Amount:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                <input type="text" class="form-control" id="finalpaid" name="finalpaid" placeholder="Enter Expected Amount"
                value="<?= (($row_edit -> finalized_amount == 0)? '' : $row_edit -> finalized_amount )?>">
            </div>
          </div>
          <div class="form-group col-md-2">
            <label for="amtpaid">Amount Paid:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                <input type="text" class="form-control" id="amtpaid" name="amtpaid" placeholder="Enter Paid Amount"
                value="<?= (($row_edit -> amt_paid == 0)? '' : $row_edit -> amt_paid )?>">
            </div>
          </div>
          <div class="form-group col-md-2">
            <label for="amtblnc">Amount Balance:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                <input type="text" class="form-control" id="amtblnc" name="amtblnc" placeholder="Enter Due Amount"
                value="<?= (($row_edit -> amt_due == 0)? '' : $row_edit -> amt_blnc )?>">
            </div>
          </div>
          <div class="form-group col-md-2">
            <label for="amtpaid">Amount Due:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                <input type="text" class="form-control" id="amtdue" name="amtdue" placeholder="Enter Due Amount"
                value="<?= (($row_edit -> amt_due == 0)? '' : $row_edit -> amt_due )?>">
            </div>
          </div>
          <div class="page-header">
            <h4 style="color : #f1c40f;">Dates</h4>
          </div>
          <div class="form-group col-md-3">
            <label for="followupdate">Follow Up Date:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="followupdate" name="followupdate"
                value="<?= (($row_edit -> follow_up_date == '0000-00-00')? '' : $row_edit -> follow_up_date)?>" min="<?= date("Y-m-d")?>">
            </div>
          </div>
          <div class="form-group col-md-3">
            <label for="meetingdate">Meeting Date:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="meetingdate" name="meetingdate"
              value="<?= (($row_edit -> meeting_date == '0000-00-00')? '' : $row_edit -> meeting_date) ?>" min="<?= date("Y-m-d")?>">
            </div>
          </div>
          <div class="form-group col-md-3">
            <label for="meetingdate">Start Date:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="startdate" name="startdate"
                value="<?= (($row_edit -> start_date == '0000-00-00')? '' : $row_edit -> start_date) ?>">
            </div>
          </div>
          <div class="form-group col-md-3">
            <label for="meetingdate">Deadline:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="deadline" name="deadline"
                value="<?= (($row_edit -> deadline == '0000-00-00')? '' : $row_edit -> deadline) ?>" min="<?= date("Y-m-d")?>">
            </div>
          </div>
          <div class="page-header">
            <br><br>
            <h4 style="color : #f1c40f;">Additional Details</h4>
          </div>
          <div class="form-group col-md-6">
            <label for="requirements">Requirements:</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="8" cols="40" placeholder="Enter Client Requirments"><?= $row_edit -> requirements ?></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="comments">Comments:</label>
            <textarea class="form-control" id="comments" name="comments" rows="8" cols="40" placeholder="Enter comments"><?= $row_edit -> comments ?></textarea>
          </div>
          <div class="form-group col-md-8 col-md-offset-2">
            <input type="hidden" name="id" value="<?= $row_edit -> project_id ?>">
            <input type="Submit" class="form-control btn btn-success" id="edit" name="edit" value="Edit Client Details">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

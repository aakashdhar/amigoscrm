<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  if (isset($_POST['submit']) && !empty($_POST)) {
      $projectname = htmlentities($_POST['projectname'],ENT_QUOTES,"UTF-8");
      $amount = htmlentities($_POST['amount'],ENT_QUOTES,"UTF-8");
      $paiddate = htmlentities($_POST['paiddate'],ENT_QUOTES,"UTF-8");
      $bankname = htmlentities($_POST['bankname'],ENT_QUOTES,"UTF-8");

      $projdetail = explode('#',$projectname);


      $sql2 = "INSERT INTO `tbl_payment_incoming`(`project_name`,`proj_id`,`project_paid_amt`, `paid_date`, `bank_paid_id`)
                VALUES ('$projdetail[0]','$projdetail[1]','$amount','$paiddate','$bankname')";

      $result2 = mysqli_query($con,$sql2);
  }


?>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="page-header">
          <h1>Incoming Payments</h1>
        </div>
        <form action="incoming.php" method="post" name="myForm"onsubmit="return checkInp()">
          <?php
            $sql = "SELECT `project_id`,`project_name` FROM `tbl_project`";
            $result = mysqli_query($con,$sql);

            $sql1 =  "SELECT `bank_id`,`bank_name`,`account_number` FROM `tbl_bank`";
            $result1 = mysqli_query($con,$sql1);
           ?>
          <div class="form-group col-md-6">
            <label for="projectname" class="control-label">From Project:</label>
            <select class="form-control" id="projectname" name="projectname">
              <option value="">Select Project</option>
              <?php while($row = mysqli_fetch_object($result)): ?>
                <option value="<?= $row-> project_name ?>#<?= $row-> project_id ?>"><?= $row-> project_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="amount" class="control-label">Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
          </div>
          <div class="form-group col-md-6">
            <label for="meetingdate">Paid Date:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="meetingdate" name="paiddate" min="<?= date("Y-m-d")?>">
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="projectname" class="control-label">To Bank Account:</label>
            <select class="form-control" id="projectname" name="bankname">
              <option value="">Select Account</option>
              <?php while($row1 = mysqli_fetch_object($result1)): ?>
                <option value="<?= $row1->bank_id  ?>"><?= $row1-> bank_name ?> | <?= $row1-> account_number ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="comments">Additional Comments:</label>
            <textarea id="comments" name="comments" rows="4" cols="40" class="form-control"></textarea>
          </div>
          <div class="form-group col-md-6 col-md-offset-3">
            <input type="submit" class="form-control btn btn-success" id="submit" name="submit" value="Submit Incoming Payment Detail">
          </div>
        </form>
      </div>
    </div>
  </div>
<?php include 'includes/footer.php'; ?>

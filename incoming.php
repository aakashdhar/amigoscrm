<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  if (isset($_POST['submit']) && !empty($_POST['projectname']) && !empty($_POST['amount']) && !empty($_POST['paiddate']) && !empty($_POST['bankname']) ) {

      $projectname = htmlentities($_POST['projectname'],ENT_QUOTES,"UTF-8");
      $amount = htmlentities($_POST['amount'],ENT_QUOTES,"UTF-8");
      $paiddate = htmlentities($_POST['paiddate'],ENT_QUOTES,"UTF-8");
      $bankname = htmlentities($_POST['bankname'],ENT_QUOTES,"UTF-8");
      $comments = htmlentities($_POST['comments'],ENT_QUOTES,"UTF-8");

      if (!is_numeric($amount)) {
        echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <strong>Warning!</strong> Account Number Should be an number.
        </div>";
      }else{

        $projdetail = explode('#',$projectname);
        $bankdetail = explode('#',$bankname);
        $new_opening_balance = $amount + $bankdetail[1];

        $sql2 = "INSERT INTO `tbl_payment_incoming`(`project_name`,`proj_id`,`project_paid_amt`, `paid_date`, `bank_paid_id`,`additional_comments`)
                  VALUES ('$projdetail[0]','$projdetail[1]','$amount','$paiddate','$bankdetail[0]','$comments')";
        $result2 = mysqli_query($con,$sql2);

        $sql3 = "UPDATE `tbl_project` SET `amt_paid`= '$amount' WHERE `project_id` = '$projdetail[1]'";
        $result3 = mysqli_query($con,$sql3);


        $sql4 =  "UPDATE `tbl_bank` SET `opening_balance`= '$new_opening_balance' WHERE `bank_id` = $bankdetail[0]";
        $result4 = mysqli_query($con,$sql4);

        $sql5 = "INSERT INTO `tbl_statement`(`statement_date`, `bank_id`, `account_number`, `statement_from`, `amount`, `statement_type`)
                VALUES ('$paiddate','$bankdetail[0]','$bankdetail[2]','$projdetail[0]','$amount','incoming')";
        $result5 = mysqli_query($con,$sql5);
      }
  }


?>
<script>
  function validateForm() {
      var x = document.forms["myForm"]["amount"].value;
      if (x == null || x == "") {
          alert("Amount to be filled out");
          document.getElementById("amount").focus();
          return false;
      }
    }
</script>

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="page-header">
          <h1>Incoming Payments</h1>
        </div>
        <form action="incoming.php" method="post" name="myForm"onsubmit="return validateForm()">
          <?php
            $sql = "SELECT `project_id`,`project_name` FROM `tbl_project`";
            $result = mysqli_query($con,$sql);

            $sql1 =  "SELECT `bank_id`,`bank_name`,`account_number`,`opening_balance` FROM `tbl_bank`";
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
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" onkeypress="return isOnlyNumberKey(event)">
          </div>
          <div class="form-group col-md-6">
            <label for="meetingdate">Paid Date:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="meetingdate" name="paiddate">
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="projectname" class="control-label">To Bank Account:</label>
            <select class="form-control" id="projectname" name="bankname">
              <option value="">Select Account</option>
              <?php while($row1 = mysqli_fetch_object($result1)): ?>
                <option value="<?=$row1 -> bank_id?>#<?=$row1 -> opening_balance?>#<?= $row1 -> account_number?>"><?= $row1-> bank_name ?> | <?= $row1-> account_number ?></option>
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

<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php

  if (isset($_POST['submit']) && !empty($_POST['bankandaccount']) && !empty($_POST['expensetype']) && !empty($_POST['paidon'])) {
    $bankandaccount = htmlentities($_POST['bankandaccount'],ENT_QUOTES,"UTF-8");
    $amount = htmlentities($_POST['amount'],ENT_QUOTES,"UTF-8");
    $expensetype = htmlentities($_POST['expensetype'],ENT_QUOTES,"UTF-8");
    $paidon = htmlentities($_POST['paidon'],ENT_QUOTES,"UTF-8");
    $comments = htmlentities($_POST['comments'],ENT_QUOTES,"UTF-8");
    if (empty($comments)) {
      $comments = 'No additional Comments';
    }
    if (!is_numeric($amount)) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Account number must be a number.
      </div>";
    } else {
      $bankdetails = explode('#',$bankandaccount);
      $updated_opening_balance = $bankdetails[3] - $amount;

      $sql =  "UPDATE `tbl_bank` SET `opening_balance`= '$updated_opening_balance' WHERE `bank_id` = '$bankdetails[0]'";
      $result = mysqli_query($con,$sql);

      $sql1 = "INSERT INTO `tbl_payment_outgoing`(`from_bank_id`, `from_bank`, `from_account`, `outgoing_amt`, `expense_type`, `outgoing_date`, `additional_comments`)
               VALUES ('$bankdetails[0]','$bankdetails[1]','$bankdetails[2]','$amount','$expensetype','$paidon','$comments')";
      $result1 = mysqli_query($con,$sql1);

      $sql2 = "INSERT INTO `tbl_statement`(`statement_date`, `bank_id`, `account_number`, `statement_from`, `amount`, `statement_type`)
              VALUES ('$paidon','$bankdetails[0]','$bankdetails[2]','$expensetype','$amount','outgoing')";

      $result1 = mysqli_query($con,$sql2);
    }
  }

 ?>

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="page-header">
          <h1>Outgoing Payments</h1>
        </div>
        <form action="outgoing.php" method="post" role="form">
          <?php
            $sql1 = "SELECT * FROM `tbl_expensetype`";
            $result1 = mysqli_query($con,$sql1);

            $sql2 = "SELECT * FROM `tbl_bank`";
            $result2 = mysqli_query($con,$sql2);
          ?>
          <div class="form-group col-md-6">
            <label class="control-label">Select Bank AND Account Number</label>
            <select class="form-control" name="bankandaccount">
              <option value="">Select Bank AND Account Number</option>
              <?php while($row1 = mysqli_fetch_object($result2)): ?>
                <option value="<?= $row1 -> bank_id  ?>#<?= $row1 -> bank_name  ?>#<?= $row1 -> account_number ?>#<?= $row1 -> opening_balance ?>"><?= $row1 -> bank_name  ?>  |  <?= $row1 -> account_number ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="amount">Enter Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required="true">
          </div>
          <div class="form-group col-md-6">
            <label for="">Select Expense Type:</label>
            <select class="form-control" name="expensetype">
              <option value="">Select Expense Type:</option>
              <?php while($row = mysqli_fetch_object($result1)): ?>
                <option value="<?= $row -> expense_name ?>"><?= $row -> expense_name ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="paidon">Paid On:</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="date" class="form-control" id="paidon" name="paidon" required="true">
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="comments">Additional Comments:</label>
            <textarea id="comments" name="comments" rows="4" cols="40" class="form-control"></textarea>
          </div>
          <div class="form-group col-md-6 col-md-offset-3">
            <input type="submit" class="form-control btn btn-success" id="submit" name="submit" value="Submit Outgoing Payment Detail">
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>

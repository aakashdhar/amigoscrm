<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php

  if (isset($_POST['submit']) && !empty($_POST)) {
    $bankname = htmlentities($_POST['bankname'],ENT_QUOTES,"UTF-8");
    $amount = htmlentities($_POST['amount'],ENT_QUOTES,"UTF-8");
    $accountnumber = htmlentities($_POST['accountnumber'],ENT_QUOTES,"UTF-8");
    $expensetype = htmlentities($_POST['expensetype'],ENT_QUOTES,"UTF-8");
    $paidon = htmlentities($_POST['paidon'],ENT_QUOTES,"UTF-8");
    $comments = htmlentities($_POST['comments'],ENT_QUOTES,"UTF-8");

    $from_bank = $bankname.$accountnumber;
    $formatted_paidon = date("Y-m-d", strtotime($paidon));

    $sql = "INSERT INTO `tbl_payment_outgoing`(`from_bank`, `outgoing_amt`, `expense_type`, `outgoing_date`, `additional_comments`)
             VALUES ('$from_bank','$amount','$expensetype','$paidon','$comments')";
    $result = mysqli_query($con,$sql);

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
          ?>
          <div class="form-group col-md-4">
            <label for="bankname">Enter Bank Name</label>
            <input type="text" class="form-control" id="bankname" name="bankname" placeholder="Enter Bank Name" required="true">
          </div>
          <div class="form-group col-md-4">
            <label for="accountnumber">Enter Account Number</label>
            <input type="text" class="form-control" id="accountnumber" name="accountnumber" placeholder="Enter Account Number" required="true">
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
          <div class="form-group col-md-6">
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

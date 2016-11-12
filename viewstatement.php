<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $date = date('Y-m');
  $id = $_REQUEST['id'];
  $id = (int)$id;
  $sql = "SELECT * FROM `tbl_statement` WHERE `bank_id` = '$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);

  $sql_credit_sum = "SELECT SUM(`amount`) FROM `tbl_statement` WHERE `bank_id` = '$id' AND `statement_type` = 'incoming'";
  $result_credit_sum = mysqli_query($con,$sql_credit_sum);
  $credit_total = mysqli_fetch_array($result_credit_sum);
  
  $sql_debit_sum = "SELECT SUM(`amount`) FROM `tbl_statement` WHERE `bank_id` = '$id' AND `statement_type` = 'outgoing'";
  $result_debit_sum = mysqli_query($con,$sql_debit_sum);
  $debit_total = mysqli_fetch_array($result_debit_sum);
  //echo "<pre>"; print_r($row); echo"</pre>";
 ?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <?php if ($count == 0): ?>
            <h3 class="text-center">No transactions made from this account yet</h3>
          <?php else: ?>
            <h3 class="text-center">Account Statement</h3>
            <table class="table table-bordered text-center">
              <thead class="">
                <th width="15%"><h4>Date</h4></th>
                <th width="55%"><h4>Name</h4></th>
                <th width="15%"><h4>Debit</h4></th>
                <th width="15%"><h4>Credit</h4></th>
              </thead>
              <tbody class="text-center">
                <?php while($row = mysqli_fetch_object($result)): ?>
                  <tr>
                    <td><?= $row -> statement_date ?></td>
                    <td><?= $row -> statement_from ?></td>
                    <td><?= (($row -> statement_type == 'outgoing'))? $row-> amount :'' ?></td>
                    <td><?= (($row -> statement_type == 'incoming'))? $row-> amount :'' ?></td>
                  </tr>
                <?php endwhile; ?>
                <tr>
                  <td colspan="2">Total</td>
                  <td><?= $debit_total[0] ?></td>
                  <td><?= $credit_total[0] ?></td>
                </tr>
              </tbody>
            </table>
            <input type="button" class="btn btn-primary" value=" Print this page " onclick="window.print();return false;" />
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $date = date('Y-m');
  $id = $_REQUEST['id'];
  $id = (int)$id;
  $sql = "SELECT * FROM `tbl_statement` WHERE `bank_id` = '$id'";
  $result = mysqli_query($con,$sql);

  //echo "<pre>"; print_r($row); echo"</pre>";
 ?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
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
          </tbody>
        </table>
        <input type="button" class="btn btn-primary" value=" Print this page " onclick="window.print();return false;" />
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<style media="screen">
  body{
    overflow-x: hidden;
  }
</style>
<?php
  $month = $_REQUEST['month'];

  // for getting the summation of all websites
  $sql2 = "SELECT SUM(`finalized_amount`), COUNT(`finalized_amount`) from `tbl_project` WHERE `project_type` = 'Website' and MONTH(`start_date`) = '$month'";
  $resultset = mysqli_query($con,$sql2);
  $row = mysqli_fetch_row($resultset);
  $actual_website_total = $row[0];
  $actual_website_achived = $row[1];

  // for getting the summation of all mobile
  $sql3 = "SELECT SUM(`finalized_amount`), COUNT(`finalized_amount`) from `tbl_project` WHERE `project_type` = 'Mobile' and MONTH(`start_date`) = '$month'";
  $resultsets = mysqli_query($con,$sql3);
  $rows = mysqli_fetch_row($resultsets);
  $actual_mobile_total = $rows[0];
  $actual_mobile_achived = $rows[1];

  $achived_overall_total =   $actual_mobile_total + $actual_website_total;

  $date = date('F Y');
  $pricing = array();
  $sql = "SELECT `project_price` FROM `tbl_price`";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_object($result);
  for($i = 0 ; $i <= count($row); $i++){
    array_push($pricing,$row->project_price);
  }
  if (isset($_POST['submit'])) {
    $numb_mobile = htmlentities($_POST['mobile'],ENT_QUOTES,"UTF-8");
    $numb_web = htmlentities($_POST['web'],ENT_QUOTES,"UTF-8");
    $total_from_mobile_proj = $numb_mobile * $pricing[0];
    $total_from_web_proj = $numb_web * $pricing[1];
    $final_total = $total_from_mobile_proj + $total_from_web_proj;
    $sql_ins = "INSERT INTO `tbl_projection`(`projection_time`, `numb_mobile_proj`, `numb_web_proj`, `mobile_total`, `web_total`, `overall_total`)
              VALUES ('$date','$numb_mobile','$numb_web','$total_from_mobile_proj','$total_from_web_proj','$final_total')";
    $result_ins = mysqli_query($con,$sql_ins);
  }
  if (isset($_POST['edit'])) {
    $numb_mobile = htmlentities($_POST['mobile'],ENT_QUOTES,"UTF-8");
    $numb_web = htmlentities($_POST['web'],ENT_QUOTES,"UTF-8");
    $total_from_mobile_proj = $numb_mobile * $pricing[0];
    $total_from_web_proj = $numb_web * $pricing[1];
    $final_total = $total_from_mobile_proj + $total_from_web_proj;
    $sql_edit = "UPDATE `tbl_projection` SET `numb_mobile_proj`='$numb_mobile',
                `numb_web_proj`='$numb_web',`mobile_total`='$total_from_mobile_proj',`web_total`='$total_from_web_proj',`overall_total`='$final_total'
                WHERE `projection_time` = '$date'";
    $result_edit = mysqli_query($con,$sql_edit);
  }
 ?>
<div class="container">
  <div class="row">
    <form class="" action="projection.php" method="post">
      <div class="form-group col-md-2 pull-right">
        <select id="month_select" name="month_select" class="form-control">
          <option value="">Select Month</option>
          <option value="<?= date("m");?>"><?= date("F")?></option>
          <option value="<?= date("m",strtotime("-1 Months"))?>"><?= date("F",strtotime("-1 Months"))?></option>
          <option value="<?= date("m",strtotime("-2 Months"))?>"><?= date("F",strtotime("-2 Months"))?></option>
        </select>
      </div>
    </form>
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Projections for the month of <?= date('F') ?></h1>
      </div>
      <div>
        <!-- Tab menu -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#target" aria-controls="target" role="tab" data-toggle="tab">Target</a></li>
          <li role="presentation"><a href="#achived" aria-controls="achived" role="tab" data-toggle="tab">Achived</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="target">
            <div class="row">
              <h3 class="page-header">No of Projects</h3>
              <form class="" action="" method="post">
                <div class="form-group col-md-4">
                  <label for="mobile" class="control-label">Mobile:</label>
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter the number of Mobile Projects">
                </div>
                <div class="form-group col-md-4">
                  <label for="web" class="control-label">Website:</label>
                  <input type="text" class="form-control" id="web" name="web" placeholder="Enter the Number of Web Projects">
                </div>
                <div class="form-group col-md-2">
                  <label for="">&nbsp;</label>
                  <input type="submit" class="form-control btn btn-primary" id="submit" name="submit" value="Calculate">
                </div>
                <div class="form-group col-md-2">
                  <label for="">&nbsp;</label>
                  <input type="submit" class="form-control btn btn-success" id="edit" name="edit" value="Update Projection">
                </div>
              </form>
            </div>
            <div class="row">
              <h3 class="page-header">Total from the projects</h3>
              <br>
              <?php
                $sql_total_select = "SELECT `mobile_total`, `web_total`, `overall_total` FROM `tbl_projection` WHERE `projection_time` = '$date'";
                $result_recived = mysqli_query($con,$sql_total_select);
              ?>
              <?php while($row = mysqli_fetch_object($result_recived)): ?>
              <div class="form-group col-md-6">
                <label>Total from Mobile Projects:</label>
                <label class="form-control text-center"><?= number_format($row -> mobile_total) ?></label>
              </div>
              <div class="form-group col-md-6">
                <label>Total from web Projects:</label>
                <label class="form-control text-center"><?= number_format($row -> web_total) ?></label>
              </div>
              <div class="form-group col-md-6 col-md-offset-3">
                <label>Total summation from all Projects:</label>
                <label class="form-control text-center"><?= number_format($row -> overall_total) ?></label>
              </div>
            <?php endwhile; ?>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="achived">
            <div class="row">
              <div class="row">
                <?php
                    $sql_retrive = "SELECT * FROM `tbl_projection` WHERE `projection_time` = '$date'";
                    $result_retrived = mysqli_query($con,$sql_retrive)
                 ?>
                 <?php while($row1 = mysqli_fetch_object($result_retrived)): ?>
                  <div class="col-md-6">
                    <h3 class="text-center">Mobile Projects</h3>
                    <div class="form-group col-md-6">
                      <label>Target Mobile Projects</label>
                      <label class="form-control text-center"><?= number_format($row1 -> numb_mobile_proj) ?></label>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Achived Mobile Projects</label>
                      <label class="form-control text-center"><?= number_format($actual_mobile_achived) ?></label>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Target amount from Mobile Project</label>
                      <label class="form-control text-center"><?= number_format($row1 -> mobile_total) ?></label>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Achived amount from Mobile Projects</label>
                      <label class="form-control text-center"><?= number_format($actual_mobile_total) ?></label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h3 class="text-center">Web Projects</h3>
                    <div class="form-group col-md-6">
                      <label>Target web Projects</label>
                      <label class="form-control text-center"><?= number_format($row1 -> numb_web_proj) ?></label>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Achived web Projects</label>
                      <label class="form-control text-center"><?= number_format($actual_website_achived) ?></label>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Target amount from Website Project</label>
                      <label class="form-control text-center"><?= number_format($row1 -> web_total) ?></label>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Achived amount from Website Projects</label>
                      <label class="form-control text-center"><?= number_format($actual_website_total) ?></label>
                    </div>
                  </div>
                  <div class="page-header">
                    <h1>Totals</h1>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Targeted overall Total</label>
                    <label class="form-control text-center"><?= number_format($row1 -> overall_total) ?></label>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Achived overall Total</label>
                    <label class="form-control text-center"><?= number_format($achived_overall_total) ?></label>
                  </div>
                  <div class="form-group col-md-6 col-md-offset-3">
                    <label>Overall Difference</label>
                    <label class="form-control text-center"><?= number_format($row1 -> overall_total - $achived_overall_total) ?></label>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
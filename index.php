<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Daily and monthly Meets</h1>
      </div>
      <?php
        $month =  date('m');
        $sql12 = "SELECT COUNT(*) from `tbl_project` WHERE  `status` = 'Pending Calls'";
        $result_st = mysqli_query($con,$sql12);
        $rowers = mysqli_fetch_row($result_st);
       ?>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading" style="padding:30px 20px;">
            <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?= $rowers[0] ?></div>
                  <div>Pending Calls</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Targets Achived</h1>
      </div>
      <!-- projects started starts -->
      <?php
        $month =  date('m');
        $sql2 = "SELECT COUNT(`finalized_amount`) from `tbl_project` WHERE  MONTH(`start_date`) = '$month'";
        $result_set = mysqli_query($con,$sql2);
        $row = mysqli_fetch_row($result_set);
       ?>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading" style="padding:30px 20px;">
            <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?= $row[0] ?></div>
                  <div>Projects Started</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- projects started ends -->
      <!-- Targets starts -->
      <?php
        $month =  date('m');
        $sql3 = "SELECT SUM(`finalized_amount`) from `tbl_project` WHERE MONTH(`start_date`) = '$month'";
        $results_set = mysqli_query($con,$sql3);
        $rows = mysqli_fetch_row($results_set);
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading" style="padding:30px 20px;">
            <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?= number_format($rows[0]) ?>  <i class="fa fa-rupee"></i></div>
                  <div>Amount Achived</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- targets end -->
      <!-- Achive starts -->
      <?php
        $month =  date('F Y');
        $sql4 = "SELECT `overall_total` from `tbl_projection` WHERE `projection_time` like '$month'";
        $resul_set = mysqli_query($con,$sql4);
        $rowss = mysqli_fetch_row($resul_set);
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading" style="padding:30px 20px;">
            <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?= number_format($rowss[0]) ?>  <i class="fa fa-rupee"></i></div>
                  <div>Target Achived</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- achive end -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="page-header">
        <h1>Amount</h1>
      </div>
      <?php
        $month =  date('m');
        $sql5 = "SELECT SUM(`amt_due`) from `tbl_project` WHERE MONTH(`start_date`) = '$month'";
        $resu_set = mysqli_query($con,$sql5);
        $ro = mysqli_fetch_row($resu_set);
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading" style="padding:30px 20px;">
            <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?= number_format($ro[0]) ?>  <i class="fa fa-rupee"></i></div>
                  <div>Amount Reciveable</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        $month =  date('m');
        $sql5 = "SELECT SUM(`opening_balance`) from `tbl_bank`";
        $res_set = mysqli_query($con,$sql5);
        $rower = mysqli_fetch_row($res_set);
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading" style="padding:30px 20px;">
            <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?= number_format($rower[0]) ?>  <i class="fa fa-rupee"></i></div>
                  <div>Account Balance</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>

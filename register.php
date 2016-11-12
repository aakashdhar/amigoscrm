<?php include 'includes/header.php'; ?>
<style media="screen">
  body{
    padding-top: 150px;
  }
</style>
<?php
  if (isset($_POST['register']) && !empty($_POST['password']) && !empty($_POST['username'])) {
    $username = htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");
    $password = htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
    $date_created = date("Y-m-d");
    $sql = "SELECT `admin_id` FROM `tbl_admin` WHERE `admin_username` = '$username'";
    $result = mysqli_query($con,$sql);
    $result_count = mysqli_num_rows($result);
    if ($result_count > 0) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Username Already Exists.
      </div>";
    }else{
      $hashed = password_hash($password,PASSWORD_DEFAULT);
      $sql_ins = "INSERT INTO `tbl_admin`(`admin_username`, `admin_password`,`id_created`)
                  VALUES ('$username','$hashed','$date_created')";
      $result = mysqli_query($con,$sql_ins);
      if ($result) {
        header('Location: login.php');
      }
    }
  }
 ?>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title text-center"><i class="fa fa-sign-in" aria-hidden="true"></i>    Register</h3>
        </div>
        <div class="panel-body">
          <form action="register.php" method="post">

            <div class="form-group">
              <label for="username" class="text-primary">Username:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                  <input type="text"  class="form-control" id="username" name="username" placeholder="Enter Your Password" required>
              </div>
            </div>
              <div class="form-group">
                <label for="password" class="text-primary">Password:</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                </div>
              </div>
              <div class="form-group">
                <input type="submit" class="form-control  btn btn-success" id="register" name="register" value="Register To CRM">
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>

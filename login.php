<?php include 'includes/loginheader.php'; ?>
<style media="screen">
  body{
    padding-top: 150px;
  }
</style>
<?php
  if (isset($_POST['login'])) {
    $username = htmlentities($_POST['username'],ENT_QUOTES,"UTF-8");
    $password = htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");

    $sql = "SELECT * FROM `tbl_admin` WHERE `admin_username` = '$username'";
    $result = mysqli_query($con,$sql);
    $result_count = mysqli_num_rows($result);
    $admin = mysqli_fetch_object($result);

    if ($result_count < 1) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Sorry The Username does not exist Please Register.
      </div>";
    }elseif (!password_verify($password, $admin -> admin_password)) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Password mismatch.
      </div>";
    }else{
      $_SESSION['admin'] = $admin -> admin_username;
      $_SESSION['id'] = $admin -> admin_id;
      date_default_timezone_set('Asia/Kolkata');
      $date = date("Y-m-d H:i:s");
      $id = $_SESSION['id'];
      mysqli_query($con,"UPDATE `tbl_admin` SET `last_login` = '$date' WHERE `admin_id` = '$id'");
      header('Location:index.php');
    }
  }



 ?>
<?php  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title text-center"><i class="fa fa-sign-in" aria-hidden="true"></i>    Login</h3>
          </div>
          <div class="panel-body">
            <form class="form" action="login.php" method="post" role="form">
                <div class="form-group">
                  <label for="username" class="text-primary">Username:</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="text-primary">Password:</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" class="form-control  btn btn-success" id="login" name="login" value="Login To CRM">
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>

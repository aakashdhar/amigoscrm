<?php include 'includes/header.php'; ?>
<style media="screen">
  body{
    padding-top: 150px;
  }
</style>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title text-center"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</h3>
          </div>
          <div class="panel-body">
            <form class="form" action="logincheck.php" method="post" role="form">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
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

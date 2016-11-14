<?php include 'includes/header.php'; include 'includes/nav.php';?>
<?php
  if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id = htmlentities($edit_id,ENT_QUOTES,"UTF-8");
    $edit_sql = "SELECT * FROM `tbl_status` WHERE `status_id` = '$edit_id'";
    $edit_result = mysqli_query($con,$edit_sql);
    $edit_source = mysqli_fetch_object($edit_result);
    $edit_name = $edit_source -> status_name;
  }

  if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = htmlentities($delete_id,ENT_QUOTES,"UTF-8");
    $delete_sql = "DELETE FROM `tbl_status` WHERE `status_id` = '$delete_id'";
    $delete_result = mysqli_query($con,$delete_sql);
    header('location:addstatus.php');
  }

  if (isset($_POST['addstatus']) && !empty($_POST['source'])) {
    $source = htmlentities($_POST['source'],ENT_QUOTES,"UTF-8");
    $source = ucwords($source);
    $sql_check = "SELECT * FROM `tbl_status` WHERE `status_name` = '$source'";
    $result_check = mysqli_query($con,$sql_check);
    if (mysqli_num_rows($result_check) > 0) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Name Already Exists.
      </div>";
    } else {
      $sql = "INSERT INTO `tbl_status`(`status_name`) VALUES ('$source')";
      $result = mysqli_query($con,$sql);
      header('location:addstatus.php');
    }
  }

  if (isset($_POST['editstatus']) && !empty($_POST['source'])) {
      $source = htmlentities($_POST['source'],ENT_QUOTES,"UTF-8");
      $source = ucwords($source);
      $sql = "SELECT * FROM `tbl_status` WHERE `status_name` = '$source' AND `status_id` != '$edit_id'";
      $result = mysqli_query($con,$sql);
      $count = mysqli_num_rows($result);
      if ($count > 0) {
        echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <strong>Warning!</strong> Name Already Exists.
        </div>";
      } else {
        $source = htmlentities($_POST['source'],ENT_QUOTES,"UTF-8");
        $sql_update = "UPDATE `tbl_status` SET `status_name`= '$source' WHERE `status_id`= '$edit_id'";
        $result_update = mysqli_query($con,$sql_update);
        header('location:addstatus.php');
      }

  }


?>


<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="page-header">
        <h3>Add New Status</h3>
      </div>
      <form  action="addstatus.php<?= ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post" role="form">
        <div class="form-group">
          <label for="source" class="control-label">Source Name:</label>
          <input type="text" class="form-control" id="source" name="source"  value="<?= ((isset($_GET['edit']))? $edit_name :'');?>" placeholder="Enter New Status">
        </div>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-success" id="source" name="<?= ((isset($_GET['edit']))?'editstatus':'addstatus');?>" value="<?= ((isset($_GET['edit']))?'Edit':'Add');?> Status">
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <div class="page-header">
        <h3>Added Status</h3>
      </div>
      <?php
        $sqlsrc = "SELECT * FROM `tbl_status`";
        $resultsrc = mysqli_query($con,$sqlsrc);
      ?>
      <table class="table table-bordered">
        <thead>
          <th>Name</th>
          <th width="30%">Action</th>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_object($resultsrc)): ?>
          <tr>
            <td><?= $row -> status_name ?></td>
            <td>
              <div class="btn-group">
                <a href="addstatus.php?edit=<?= $row -> status_id ;?>" class="btn btn-success"><i class="fa fa-pencil"></i>  Edit</a>
                <a href="addstatus.php?delete=<?= $row -> status_id ;?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>  Delete</a>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>

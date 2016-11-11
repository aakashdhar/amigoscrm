<?php include 'includes/header.php'; include 'includes/nav.php';?>

<?php
  if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id = htmlentities($edit_id,ENT_QUOTES,"UTF-8");
    $edit_sql = "SELECT * FROM `tbl_type` WHERE `type_id` = '$edit_id'";
    $edit_result = mysqli_query($con,$edit_sql);
    $edit_source = mysqli_fetch_object($edit_result);
    $edit_name = $edit_source -> type_name;
  }
  if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = htmlentities($delete_id,ENT_QUOTES,"UTF-8");
    $delete_sql = "DELETE FROM `tbl_type` WHERE `type_id` = '$delete_id'";
    $delete_result = mysqli_query($con,$delete_sql);
    header('location:addtype.php');
  }

  if (isset($_POST['addtype']) && !empty($_POST['type'])) {
    $type = htmlentities($_POST['type'],ENT_QUOTES,"UTF-8");
    $type = ucwords($type);
    $sql_check = "SELECT * FROM `tbl_type` WHERE `type_name` = '$type'";
    $result_check = mysqli_query($con,$sql_check);
    if (mysqli_num_rows($result_check) > 0) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Name Already Exists.
      </div>";
    } else {
      $sql = "INSERT INTO `tbl_type`(`type_name`) VALUES ('$type')";
      $result = mysqli_query($con,$sql);
      header('location:addtype.php');
    }

  }

  if (isset($_POST['edittype']) && !empty($_POST['type'])) {
    $type = htmlentities($_POST['type'],ENT_QUOTES,"UTF-8");
    $type = ucwords($type);
    $sql = "SELECT * FROM `tbl_type` WHERE `type_name` = '$type' AND `type_id` != '$edit_id'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) > 0 ) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Name Already Exists.
      </div>";
    } else {
      $sql_update = "UPDATE `tbl_type` SET `type_name`= '$type' WHERE `type_id`= '$edit_id'";
      $result_update = mysqli_query($con,$sql_update);
      header('location:addtype.php');
    }
  }
?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="page-header">
        <h3>Add New Type</h3>
      </div>
      <form  action="addtype.php<?= ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post" role="form">
        <div class="form-group">
          <label for="type" class="control-label">Source Name:</label>
          <input type="text" class="form-control" id="type" name="type"  value="<?= ((isset($_GET['edit']))? $edit_name :'');?>" placeholder="Enter Type Name">
        </div>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-success" id="source" name="<?= ((isset($_GET['edit']))?'edittype':'addtype');?>" value="<?= ((isset($_GET['edit']))?'Edit':'Add');?> Type">
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <div class="page-header">
        <h3>Added Types</h3>
      </div>
      <?php
        $sqlsrc = "SELECT * FROM `tbl_type`";
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
            <td><?= $row -> type_name ?></td>
            <td>
              <div class="btn-group">
                <a href="addtype.php?edit=<?= $row -> type_id ;?>" class="btn btn-success"><i class="fa fa-pencil"></i>  Edit</a>
                <a href="addtype.php?delete=<?= $row -> type_id ;?>" class="btn btn-danger"><i class="fa fa-trash"></i>  Delete</a>
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

<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php

  if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id = htmlentities($edit_id,ENT_QUOTES,"UTF-8");
    $edit_sql = "SELECT * FROM `tbl_expensetype` WHERE `expense_id` = '$edit_id'";
    $edit_result = mysqli_query($con,$edit_sql);
    $edit_source = mysqli_fetch_object($edit_result);
    $edit_name = $edit_source -> expense_name;
  }

  if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = htmlentities($delete_id,ENT_QUOTES,"UTF-8");
    $delete_sql = "DELETE FROM `tbl_expensetype` WHERE `expense_id` = '$delete_id'";
    $delete_result = mysqli_query($con,$delete_sql);
    header('location:addexpensetype.php');
  }
  if (isset($_POST['addexpense']) && !empty($_POST['expense'])) {
    $expense = htmlentities($_POST['expense'],ENT_QUOTES,"UTF-8");
    $expense = ucwords($expense);
    $sql_check = "SELECT * FROM `tbl_expensetype` WHERE `expense_name` = '$expense'";
    $result_check = mysqli_query($con,$sql_check);
    if (mysqli_num_rows($result_check) > 0) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Name Already Exists.
      </div>";
    } else {
      $sql = "INSERT INTO `tbl_expensetype`(`expense_name`) VALUES ('$expense')";
      $result = mysqli_query($con,$sql);
      header('location:addexpensetype.php');
    }
  }


  if (isset($_POST['editexpense'])) {
    $expense = htmlentities($_POST['expense'],ENT_QUOTES,"UTF-8");
    $expense = ucwords($expense);
    $sql = "SELECT * FROM `tbl_expensetype` WHERE `expense_name` = '$expense' AND `expense_id` != '$edit_id'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) > 0 ) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Name Already Exists.
      </div>";
    } else {
      $sql_update = "UPDATE `tbl_expensetype` SET `expense_name`= '$expense' WHERE `expense_id`= '$edit_id'";
      $result_update = mysqli_query($con,$sql_update);
      header('location:addexpensetype.php');
    }

  }


 ?>


<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="page-header">
        <h3>Add New Expense Type</h3>
      </div>
      <form  action="addexpensetype.php<?= ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post" role="form">
        <div class="form-group">
          <label for="expense" class="control-label">Source Name:</label>
          <input type="text" class="form-control" id="expense" name="expense"  value="<?= ((isset($_GET['edit']))? $edit_name :'');?>" placeholder="Enter Expense Name">
        </div>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-success" id="expensebtn" name="<?= ((isset($_GET['edit']))?'editexpense':'addexpense');?>" value="<?= ((isset($_GET['edit']))?'Edit':'Add');?> Expense Types">
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <div class="page-header">
        <h3>Added Expense Types</h3>
      </div>
      <?php
        $sqlsrc = "SELECT * FROM `tbl_expensetype`";
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
            <td><?= $row -> expense_name ?></td>
            <td>
              <div class="btn-group">
                <a href="addexpensetype.php?edit=<?= $row -> expense_id ;?>" class="btn btn-success"><i class="fa fa-pencil"></i>  Edit</a>
                <a href="addexpensetype.php?delete=<?= $row -> expense_id ;?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>  Delete</a>
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

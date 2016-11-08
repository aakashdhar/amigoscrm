<?php include 'includes/header.php'; include 'includes/nav.php';?>
<?php

  if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id = htmlentities($edit_id,ENT_QUOTES,"UTF-8");
    $edit_sql = "SELECT * FROM `tbl_bank` WHERE `bank_id` = '$edit_id'";
    $edit_result = mysqli_query($con,$edit_sql);
    $edit_source = mysqli_fetch_object($edit_result);
    $edit_name = $edit_source -> bank_name;
    $edit_balance = $edit_source -> opening_balance;
    $edit_acnumber = $edit_source -> account_number;

  }
  // in case if required to add
  // if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  //   $delete_id = (int)$_GET['delete'];
  //   $delete_id = htmlentities($delete_id,ENT_QUOTES,"UTF-8");
  //   $delete_sql = "DELETE FROM `tbl_source` WHERE `source_id` = '$delete_id'";
  //   $delete_result = mysqli_query($con,$delete_sql);
  //   header('location:addsource.php');
  // }

  if (isset($_POST['addaccount'])) {
    $name = htmlentities($_POST['name'],ENT_QUOTES,"UTF-8");
    $balance = htmlentities($_POST['balance'],ENT_QUOTES,"UTF-8");
    $acnumber = htmlentities($_POST['acnumber'],ENT_QUOTES,"UTF-8");

    $name = ucwords($name);
    $sql = "INSERT INTO `tbl_bank`(`bank_name`, `opening_balance`, `account_number`) VALUES ('$name','$balance','$acnumber')";
    $result = mysqli_query($con,$sql);
    header('location:addaccount.php');
  }
  if (isset($_POST['editaccount'])) {
    $name = htmlentities($_POST['name'],ENT_QUOTES,"UTF-8");
    $balance = htmlentities($_POST['balance'],ENT_QUOTES,"UTF-8");
    $acnumber = htmlentities($_POST['acnumber'],ENT_QUOTES,"UTF-8");

    $name = ucwords($name);
    $sql_update = "UPDATE `tbl_bank` SET `bank_name`='$name',`opening_balance`='$balance',
                  `account_number`='$acnumber' WHERE `bank_id` = '$edit_id'";

    $result_update = mysqli_query($con,$sql_update);
    header('location:addaccount.php');
  }


?>


  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="page-header">
          <h1>Add Bank Account</h1>
        </div>
        <form  action="addaccount.php<?= ((isset($_GET['edit'])?'?edit='.$edit_id:'')) ?>" method="post">
            <div class="form-group col-md-8">
              <label for="name" class="control-label">Bank Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= ((isset($_GET['edit']))? $edit_name :'');?>" placeholder="Enter Bank name">
            </div>
            <div class="form-group col-md-6">
              <label for="balance" class="control-label">Opening Balance:</label>
              <input type="text" class="form-control" id="balance" name="balance" value="<?= ((isset($_GET['edit']))? $edit_balance :'');?>" placeholder="Enter Opening Balance">
            </div>
            <div class="form-group col-md-6">
              <label for="acnumber" class="control-label">Account Number:</label>
              <input type="text" class="form-control" id="acnumber" name="acnumber" value="<?= ((isset($_GET['edit']))? $edit_acnumber :'');?>" placeholder="Enter Account Number">
            </div>
            <div class="form-group col-md-6 col-md-offset-3">
              <input type="submit" class="form-control btn btn-primary" id="submit" name="<?= ((isset($_GET['edit']))?'editaccount':'addaccount');?>"
                     value="<?= ((isset($_GET['edit']))?'Edit':'Add');?> Account">
            </div>
        </form>
      </div>
      <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center">Account Details</h3>
        <table class="table table-bordered">
          <thead>
            <th>Bank Name</th>
            <th>Opening Balance</th>
            <th>Account Number</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM `tbl_bank`";
              $result = mysqli_query($con,$sql);
             ?>
            <?php while($row = mysqli_fetch_object($result)): ?>
              <tr>
                <td><?= $row -> bank_name ?></td>
                <td><?= $row -> opening_balance ?></td>
                <td><?= $row -> account_number ?></td>
                <td>
                  <a href="addaccount.php?edit=<?= $row -> bank_id ;?>" class="btn btn-success"><i class="fa fa-pencil"></i>  Edit</a>
                  <!-- <a href=""><i class="fa fa-trash"></i>  Delete</a> -->
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


<?php include 'includes/footer.php'; ?>

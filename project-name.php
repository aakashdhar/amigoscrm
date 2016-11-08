<?php
  include 'includes/header.php';

  if(!empty($_POST["name"])) {

    $name = $_POST["name"];
    $sql = "SELECT count(*) FROM `tbl_project` WHERE `project_name`= '$name'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_object($result);
    $user_count = $row[0];
    if($user_count>0) {
        echo "<span> Username Not Available.</span>";
    }else{
        echo "<span> Username Available.</span>";
    }

  }
?>

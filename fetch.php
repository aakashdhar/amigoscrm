<?php include 'includes/header.php'; ?>
<?php
  $output = '';
  $sql = "SELECT * FROM `tbl_project` WHERE `project_name` LIKE '%".$_POST["search"]."%'";
  $result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) > 0) {
    $output .= '<div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <th>Project Name</th>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                  </thead>';
      while ($row = mysqli_fetch_array($result)) {
        $output .= '
          <tbody>
            <tr>
              <td>'.$row["project_name"].'</td>
              <td>'.$row["client_name"].'</td>
              <td>'.$row["contact_number"].'</td>
              <td>
                <a href="viewprofile.php?id=<?= $row["project_id"] ?>'">uvgv</a>
              </td>
            </tr>
          </tbody>
          ';
      }
      $output .=  '</table>';
      echo "$output";
  }




 ?>

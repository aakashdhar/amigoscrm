<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $search_query = $_REQUEST['search-query'];
  $search_query = trim($search_query);
  $search_type = $_REQUEST['search'];

  $sql = "SELECT * FROM `tbl_project` WHERE `project_name` LIKE '%$search_query%' OR `client_name` LIKE '%$search_query%'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);

  if (isset($search_type) && $search_type == 'Search') {
    if ($search_query == "") {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Please enter some search query in the search bar.
      </div>";
    }elseif ($count < 1) {
      echo "<div class='alert alert-danger alert-dismissible col-md-6 col-md-offset-3 text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Warning!</strong> Your Search term has no releveant feild in the database.
      </div>";
    }else{
      echo "<h3 class='text-center'>Search result for $search_query yeilded $count Result</h3>";
    }
  }
 ?>
  <div class="container">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th>Project Name</th>
          <th>Client Name</th>
          <th>Contact</th>
          <th>Status</th>
          <th>Follow Up Date</th>
          <th>Meeting Date</th>
          <th width="20%">Action</th>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_object($result)): ?>
            <tr>
              <td><?= $row -> project_name ?></td>
              <td><?= $row -> client_name ?></td>
              <td><?= $row -> contact_number ?></td>
              <td><?= $row -> status ?></td>
              <td><?= $row -> follow_up_date ?></td>
              <td><?= $row -> meeting_date ?></td>
              <td>
                <div class="btn-group">
                  <a href="editproject.php?id=<?= $row->project_id ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                  <a href="showproject.php?id=<?= $row->project_id ?>" class="btn btn-success"><i class="fa fa-eye"></i> Details</a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <?php while($row = mysqli_fetch_object($result)): ?>
      <?php endwhile; ?>
    </div>
  </div>


<?php include 'includes/footer.php'; ?>

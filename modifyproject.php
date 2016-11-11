<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $sql = "SELECT * FROM `tbl_project` WHERE `finalized_amount` > 0  AND `status` NOT LIKE '%Completed%'";
  $result = mysqli_query($con,$sql);
 ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Modify Project</h1>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="search_table" class="control-label">Search Projects</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i>  Search</span>
            <input type="text" name="search_table" id="search_table" placeholder="Search by Project Name" class="form-control" />
          </div>
        </div>
        <table class="table table-bordered" id="searchtable">
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
                <td><?= $row->project_name ?></td>
                <td><?= $row->client_name ?></td>
                <td><?= $row->contact_number ?></td>
                <td><?= $row->status ?></td>
                <td><?= $row->follow_up_date ?></td>
                <td><?= $row->meeting_date ?></td>
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
      </div>
    </div>
  </div>
<?php include 'includes/footer.php'; ?>

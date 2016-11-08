<?php include 'includes/header.php'; include 'includes/nav.php'; ?>
<?php
  $sql = "SELECT `project_id`, `project_name`, `client_name`, `contact_number`, `status`, `deadline` FROM `tbl_project`";
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
        <table class="table table-bordered" id="searchtable"">
          <thead>
            <th>Project Name</th>
            <th>Client Name</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Deadline</th>
            <th width="30%">Action</th>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_object($result)): ?>
              <tr>
                <td><?= $row->project_name ?></td>
                <td><?= $row->client_name ?></td>
                <td><?= $row->contact_number ?></td>
                <td><?= $row->status ?></td>
                <td><?= $row->deadline ?></td>
                <td>
                  <div class="btn-group">
                    <a href="" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                    <button href="" class="btn btn-success" onclick="detailsmodal(<?= $row->project_id ?>)"><i class="fa fa-eye"></i> View Details</button>
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

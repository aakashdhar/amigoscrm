
<?php
    $con = mysqli_connect('localhost','root','','amigoscrm');
    
    $searchTerm = $_GET['term'];
    $data = array();
    $sql = "SELECT * FROM `tbl_project` WHERE `project_name` LIKE '%".$searchTerm."%'";
    $query = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($query))
    {
      $data[] = $row['project_name'];
    }

    echo json_encode($data);
?>

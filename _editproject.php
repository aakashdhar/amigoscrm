<?php include 'includes/header.php';?>
<?php

    if (isset($_POST['edit'])) {
      $id = htmlentities($_POST['id'],ENT_QUOTES,"UTF-8");
      $name = htmlentities($_POST['name'],ENT_QUOTES,"UTF-8");
      $client = htmlentities($_POST['client'],ENT_QUOTES,"UTF-8");
      $contact =htmlentities($_POST['contact'],ENT_QUOTES,"UTF-8");
      $source =htmlentities($_POST['source'],ENT_QUOTES,"UTF-8");
      $status =htmlentities($_POST['status'],ENT_QUOTES,"UTF-8");
      $type =htmlentities($_POST['type'],ENT_QUOTES,"UTF-8");
      $quote =htmlentities($_POST['quote'],ENT_QUOTES,"UTF-8");
      $paid =htmlentities($_POST['paid'],ENT_QUOTES,"UTF-8");
      $finalpaid =htmlentities($_POST['finalpaid'],ENT_QUOTES,"UTF-8");
      $amtpaid = htmlentities($_POST['amtpaid'],ENT_QUOTES,"UTF-8");
      $amtdue = htmlentities($_POST['amtdue'],ENT_QUOTES,"UTF-8");
      $followupdate = htmlentities($_POST['followupdate'],ENT_QUOTES,"UTF-8");
      $meetingdate = htmlentities($_POST['meetingdate'],ENT_QUOTES,"UTF-8");
      $startdate = htmlentities($_POST['startdate'],ENT_QUOTES,"UTF-8");
      $deadline = htmlentities($_POST['deadline'],ENT_QUOTES,"UTF-8");
      $requirements =htmlentities($_POST['requirements'],ENT_QUOTES,"UTF-8");
      $comments = htmlentities($_POST['comments'],ENT_QUOTES,"UTF-8");
    }

    $formatted_followupdate = date("Y-m-d", strtotime($followupdate));
    $formatted_meetingdate = date("Y-m-d", strtotime($meetingdate));
    $formated_startdate = date("Y-m-d", strtotime($startdate));
    $formatted_deadline = date("Y-m-d", strtotime($deadline));

    $sql = "UPDATE `tbl_project` SET `project_name`='$name',`client_name`='$client',`contact_number`='$contact',`source`='$source',`status`='$status',`quote`='$quote',
    `client_expection`='$paid',`finalized_amount`='$finalpaid',`amt_paid`='$amtpaid',`amt_due`='$amtdue',`follow_up_date`='$formatted_followupdate',
    `meeting_date`='$formatted_meetingdate',`start_date`='$formated_startdate',`deadline`='$formatted_deadline',`project_type`='$type',`requirements`='$requirements',
    `comments`='$comments' WHERE `project_id` = '$id'";

    $result = mysqli_query($con,$sql);

    if ($result) {
      header('Location:modifyproject.php');
    }


 ?>

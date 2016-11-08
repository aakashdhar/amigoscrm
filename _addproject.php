<?php include 'includes/header.php'; ?>

<?php

  if (isset($_POST['add'])) {
    $name = htmlentities($_POST['name'],ENT_QUOTES,"UTF-8");
    $clientname = htmlentities($_POST['client'],ENT_QUOTES,"UTF-8");;
    $contact = htmlentities($_POST['contact'],ENT_QUOTES,"UTF-8");;
    $source = htmlentities($_POST['source'],ENT_QUOTES,"UTF-8");;
    $status = htmlentities($_POST['status'],ENT_QUOTES,"UTF-8");;
    $quote = htmlentities($_POST['quote'],ENT_QUOTES,"UTF-8");;
    $paid = htmlentities($_POST['paid'],ENT_QUOTES,"UTF-8");;
    $balance = htmlentities($_POST['balance'],ENT_QUOTES,"UTF-8");;
    $due = htmlentities($_POST['due'],ENT_QUOTES,"UTF-8");;
    $date = htmlentities($_POST['date'],ENT_QUOTES,"UTF-8");;
    $followupdate = htmlentities($_POST['followupdate'],ENT_QUOTES,"UTF-8");;
    $meetingdate = htmlentities($_POST['meetingdate'],ENT_QUOTES,"UTF-8");;
    $deadline = htmlentities($_POST['deadline'],ENT_QUOTES,"UTF-8");;
    $requirements = htmlentities($_POST['requirements'],ENT_QUOTES,"UTF-8");;
    $comments = htmlentities($_POST['comments'],ENT_QUOTES,"UTF-8");;
  }

  $formated_date = date("Y-m-d", strtotime($date));
  $formatted_followupdate = date("Y-m-d", strtotime($followupdate));
  $formatted_meetingdate = date("Y-m-d", strtotime($meetingdate));
  $formatted_deadline = date("Y-m-d", strtotime($deadline));

  $sql = "INSERT INTO `project`(`project_name`, `client_name`, `contact_number`, `source`, `status`, `quote`, `paid`,
          `balance`, `due`, `date`, `follow_up_date`, `meeting_date`, `deadline`, `requirements`, `comments`) VALUES
          ('$name','$clientname','$contact','$source','$status','$quote','$paid','$balance','$due','$formated_date',
          '$formatted_followupdate','$formatted_meetingdate','$formatted_deadline','$requirements','$comments')";
  $result = mysqli_query($con,$sql);


  if ($result) {
    header('location:index.php');
  }
  else{
    echo "failed";
  }
?>

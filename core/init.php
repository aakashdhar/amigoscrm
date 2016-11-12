<?php
  $con = mysqli_connect('localhost','root','','amigoscrm');

  if (!$con) {
    echo "There is a problem concecting to the database We will try to fix it ASAP.";
    die();
  }
  date_default_timezone_set('Asia/Kolkata');
  error_reporting(0);
  session_start();
  
 ?>

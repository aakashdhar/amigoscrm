<?php
  $con = mysqli_connect('localhost','root','','amigoscrm');

  if (!$con) {
    echo "There is a problem concecting to the database We will try to fix it ASAP.";
    die();
  }

  error_reporting(0);

  require_once 'helpers/helpers.php';
 ?>

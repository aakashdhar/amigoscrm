<?php include 'core/init.php'; ?>
<?php if (!isset($_SESSION['admin'])) {
  header('Location:login.php');
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Amigos | CRM</title>
</head>
<body>

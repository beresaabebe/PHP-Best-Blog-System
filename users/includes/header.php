<?php include_once '../lang/define_lang.php'; ?>
<script type="text/javascript" charset="utf-8" async defer>
    window.history.forward();
  </script>
<?php include_once '../includes/database.php'; ?>
<?php ob_start(); ?>
<?php if (session_status() == PHP_SESSION_NONE) {
   session_start(); 
} ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="60;url=../includes/logout.php" /> -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon1.png">
    <title><?php echo _l_title; ?></title>

      <!-- <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css"> -->
      <link rel="stylesheet" type="text/css" href="../css/custom.css">
        <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="../admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../admin/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="../admin/bower_components/Ionicons/css/ionicons.min.css">
      <!-- DataTables -->
      <link rel="stylesheet" href="../admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <!-- Theme style -->
        <!-- Select2 -->
  <link rel="stylesheet" href="../admin/bower_components/select2/dist/css/select2.min.css">
      <link rel="stylesheet" href="../admin/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="../admin/dist/css/skins/_all-skins.min.css">
      <link href="../css/jumbotron.css" rel="stylesheet">
      <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  </head>
  <body>
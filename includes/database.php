<?php include_once 'functions.php'; ?>
<?php 
$connection = mysqli_connect('localhost','root','');
mysqli_set_charset($connection, 'utf8');
mysqli_select_db($connection, 'njcit_blog_db');
confirmQuery($connection);
?>
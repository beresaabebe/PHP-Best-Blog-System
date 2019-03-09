<?php include_once('includes/header.php'); ?>
<?php include_once('includes/nav.php'); ?>

    <!-- Page Content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-9">
<?php
if (isset($_GET['search'])) {
  $search = $_GET['search'];

  $query = "SELECT DISTINCT * FROM posts, users, categories WHERE post_title LIKE'%$search%' OR post_content LIKE '%$search%' OR firstname LIKE'%$search%' OR lastname LIKE'%$search' OR category_name LIKE'%$search'";
$execute_query = mysqli_query($connection,$query);
$count = mysqli_num_rows($execute_query);
if ($count != 0) {
    ?>  
      <h1 class="my-4">Search result for
        <small><strong><?php echo $search; ?></strong></small>
      </h1>
      <hr>
<?php
  while ($row = mysqli_fetch_array($execute_query)) {
    $post_id = $row['id'];
    $post_title = $row['post_title'];
    $post_content = $row['post_content'];
    $post_image = $row['post_image'];
   ?>

            <div class="panel">
              <a class="" href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><img class="pull-left img img-circle form-inline card-img-top" style="width: 50px;height: 50px;" src="../uploads/images/posts/<?php echo $post_image; ?>" alt=""></a>
              <h4 class="card-title">
                <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
              </h4>
              <p class="card-text"><?php if (strlen($post_content)>350) {
                    $post_content = substr($post_content, 0,350).'...';
                    echo $post_content;
                  }
                  else { 
                  // shortenText($post_content); 
                  echo $post_content; 
                  }
                  ?> <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"> Read more</a></p>
            </div>
          <hr>               
  <?php 
}
}
else {
  ?>
  <hr>
      <div class="col-lg-12 col-md-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <div class="card-body">
            </hr>
            <p class='alert alert-danger'> No search result for <strong><?php echo $search; ?></strong>.</p>
             </hr>
          </div>
        </div>
      </div>
<?php
}
?> 
</div> <!-- End col-9 -->
<!-- Sidebar -->
<?php include_once('includes/sidebar.php'); ?>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
<?php include_once('../includes/footer.php'); ?>
  <?php
}
else {
  $encode = urlencode('home');
  header('index.php?source='.$encode);
}
?>
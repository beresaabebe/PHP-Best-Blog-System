<?php include_once('../includes/database.php'); ?>
<?php include_once('../includes/functions.php'); ?>
 <?php
if (isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
    $cat_name_query = "SELECT category_name FROM categories WHERE id='$category_id'";
  }
  else {
    $cat_name_query = "SELECT category_name FROM cn_categories WHERE id='$category_id'";
  }
  $get_cat_name = mysqli_query($connection, $cat_name_query);
  $get_cat = mysqli_fetch_array($get_cat_name);
  $cat_name = $get_cat['category_name'];
}
?>
      <!-- Page Heading -->
      <h2 class="my-2"><?php echo _l_all_post; ?>
        <small><?php echo _l_of; ?> <b><?php echo $cat_name; ?></b> <?php echo strtolower(_l_category); ?></small>
      </h2>
      <div class="row">
<?php
if (isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];

  if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
    $check_query = "SELECT * FROM posts WHERE post_category_id = '$category_id' AND post_status=1 ORDER BY updated_date DESC";
  }
  else {
    $check_query = "SELECT * FROM cn_posts WHERE post_category_id = '$category_id' AND post_status=1 ORDER BY updated_date DESC";
  }
  $execute_query = mysqli_query($connection,$check_query);
  $count_check = mysqli_num_rows($execute_query);
  if ($count_check>0) {
    while ($row = mysqli_fetch_array($execute_query)) {
      $post_id = $row['id'];
      $post_title = $row['post_title'];
      $post_content = $row['post_content'];
      $post_image = $row['post_image'];
      $post_created_date = $row['created_date'];
      $post_created_by_id = $row['created_by_id'];
      $post_updated_date = $row['updated_date'];
      $post_updated_by_id = $row['updated_by_id'];
      $post_category_id = $row['post_category_id'];

       ?>
            <div class="col-lg-4 col-md-4 col-sm-6 portfolio-item">
              <div class="panel panel-default">
                <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><img class="img img-responsive" src="../uploads/images/posts/<?php echo $post_image; ?>" alt=""></a>
                <div class="panel-body">
                  <h4 class="card-title">
                    <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                  </h4>
                  <p class="card-text"><?php if (strlen($post_content)>250) {
                    $post_content = substr($post_content, 0,250).'...';
                    echo $post_content;
                  }
                  else { 
                  // shortenText($post_content); 
                  echo $post_content; 
                  }
                  ?> <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"> Read more</a></p><hr>
<?php  

  if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
    $category_query = "SELECT * FROM categories WHERE id='$post_category_id'";
  }
  else {
    $category_query = "SELECT * FROM cn_categories WHERE id='$post_category_id'";
  }
  $execute_category = mysqli_query($connection, $category_query);
  $get_category = mysqli_fetch_array($execute_category);
  $category_id = $get_category['id'];
  $category_name = $get_category['category_name'];


?>                  
                  Category <?php echo $category_name; ?>
<?php 
$author_query = "SELECT * FROM users WHERE id='$post_created_by_id'";
$execute = mysqli_query($connection, $author_query);
$get_author = mysqli_fetch_assoc($execute);
$author_id = $get_author['id'];
$author_firstname = $get_author['firstname'];
$author_lastname = $get_author['lastname'];

?>

                  Author <a href="index.php?source=<?php echo urlencode('read all posts by author'); ?>&author_id=<?php echo $post_created_by_id; ?>"><?php echo ucfirst($author_lastname).' '.ucfirst($author_lastname); ?></a>
<?php 
if ($post_created_by_id != $post_updated_by_id) {
  $author_query = "SELECT * FROM users WHERE id='$post_updated_by_id'";
  $execute = mysqli_query($connection, $author_query);
  $get_updated_by = mysqli_fetch_assoc($execute);
  $updated_by_id = $get_updated_by['id'];
  $updated_by_firstname = $get_updated_by['firstname'];
  $updated_by_lastname = $get_updated_by['lastname'];
  ?>
                  Updated by <a href="index.php?source=<?php echo urlencode('read all posts updated by '); ?>&updated_by_id=<?php echo $post_updated_by_id; ?>"><?php echo ucfirst($updated_by_lastname).' '.ucfirst($updated_by_lastname); ?></a>
  <?php
}
?>                  
                </div>
              </div>
            </div>
  <?php 
}       
} //end count check query
else {
  ?>
  <div class="col-lg-12 col-md-9 col-sm-12 portfolio-item">
    <div class="panel panel-default">
      <div class="panel-body">
          <p class="alert alert-danger" data-dismiss="alert"><?php echo _l_no_post_in_this; ?> "<?php  echo $cat_name; ?>"</p>
      </div>
    </div>
  </div>
  <?php
}     
?>         
          </div>  <!-- End col-9 row --> 
<?php 
} //end of if statement

?>
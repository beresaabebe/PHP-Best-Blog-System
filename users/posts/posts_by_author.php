<?php include_once('../includes/database.php'); ?>
<?php include_once('../includes/functions.php'); ?>

<?php
if (isset($_GET['author_id'])) {
  $author_id = $_GET['author_id'];
  $get_author_query = "SELECT username FROM users WHERE id='$author_id'";
  $execute_get_author = mysqli_query($connection, $get_author_query);
  $get_name = mysqli_fetch_array($execute_get_author);
  $author_name = $get_name['username'];
}
?>
          <!-- Page Heading -->
          <h4 class="my-2"><?php echo _l_all_post; ?>
            <small><?php echo _l_created_by; ?> <b><?php echo $author_name; ?></b></small>
          </h4>
          <div class="row">
<?php
if (isset($_GET['author_id'])) {
  $author_id = $_GET['author_id'];
$query = "SELECT * FROM posts WHERE created_by_id='$author_id' ORDER BY updated_date DESC";
$execute_query = mysqli_query($connection,$query);
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

  $category_query = "SELECT * FROM categories WHERE id='$post_category_id'";
  $execute_category = mysqli_query($connection, $category_query);
  $get_category = mysqli_fetch_array($execute_category);
  $category_id = $get_category['id'];
  $category_name = $get_category['category_name'];


?>                  
                  Category <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
<?php 
$author_query = "SELECT * FROM users WHERE id='$post_created_by_id'";
$execute = mysqli_query($connection, $author_query);
$get_author = mysqli_fetch_assoc($execute);
$author_id = $get_author['id'];
$author_firstname = $get_author['firstname'];
$author_lastname = $get_author['lastname'];

?>

                  Author <?php echo ucfirst($author_lastname).' '.ucfirst($author_lastname); ?>
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
?>                         
          </div>  <!-- End col-9 row -->  
<?php 
}//end of if statements
?>
<?php include_once('includes/database.php'); ?>
<?php include_once('includes/functions.php'); ?>

          <!-- Page Heading -->
          <h1 class="my-2"><?php echo _l_post,' ',_l_updated_by; ?>
            <!-- <small>Secondary Text</small> -->
          </h1>
          <div class="row">
<?php
if (isset($_GET['updated_by_id'])) {
  $updated_by_id = $_GET['updated_by_id'];
}
$query = "SELECT * FROM posts WHERE updated_by_id='$updated_by_id' ORDER BY updated_date DESC";
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
              <div class="card h-100">
                <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><img class="card-img-top" src="uploads/images/posts/<?php echo $post_image; ?>" alt=""></a>
                <div class="card-body">
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
                  Updated by <?php echo ucfirst($updated_by_lastname).' '.ucfirst($updated_by_lastname); ?>
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

          <!-- Pagination -->
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
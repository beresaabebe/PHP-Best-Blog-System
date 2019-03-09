<?php include_once('../includes/database.php'); ?>
<?php include_once('../includes/functions.php'); ?>
<?php include_once '../lang/define_lang.php'; ?>
<div class="row">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
  $query = "SELECT * FROM posts WHERE post_status=1";
}
else {
  $query = "SELECT * FROM cn_posts WHERE post_status=1";
}
$execute = mysqli_query($connection, $query);
confirmQuery($execute);
$count = mysqli_num_rows($execute);
$count = ceil($count/9);

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }
  else {
    $page = "";
  }
  if ($page == "" || $page == 1) {
    $page_1 = 0;
  }
  else {
    $page_1 = ($page*9)-9;
  }


  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $post_query = "SELECT * FROM posts WHERE post_status=1 ORDER BY id DESC LIMIT $page_1,9";
  }
  else {
    $post_query = "SELECT * FROM cn_posts WHERE post_status=1 ORDER BY id DESC LIMIT $page_1,9";
  }
  $execute_post_query = mysqli_query($connection, $post_query);
  confirmQuery($execute_post_query);
  if (mysqli_num_rows($execute_post_query)!=0) {
    while($row = mysqli_fetch_array($execute_post_query)){
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
                <div class="col-lg-4 col-md-4 col-sm-6 portfolio-item" style="margin-bottom: 50px;">
                <div class="panel panel-default">
<?php 
if (!empty($post_image)) {
  ?>
                  <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><img class="img img-responsive" src="../uploads/images/posts/<?php echo $post_image; ?>" alt=""></a>
  <?php
}
?>                  
                  <div class="panel-body">
                    <h4 class="panel-heading">
                      <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h4>
                    <p class="card-text"><?php if (strlen($post_content)>250) {
                      $post_content = substr($post_content, 0,250).'...';
                      echo $post_content;
                    }
                    else { 
                      echo $post_content; 
                    }
                    ?> <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"> <?php echo _l_read_more; ?></a></p>
  <?php  

    if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
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
                    <?php echo _l_category; ?> <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?>
                    </a>
  <?php 
  $author_query = "SELECT * FROM users WHERE id='$post_created_by_id'";
  $execute = mysqli_query($connection, $author_query);
  $get_author = mysqli_fetch_assoc($execute);
  $author_id = $get_author['id'];
  $author_firstname = $get_author['firstname'];
  $author_lastname = $get_author['lastname'];
  ?>
                    <?php echo _l_author; ?> <a href="index.php?source=<?php echo urlencode('read all posts by author'); ?>&author_id=<?php echo $post_created_by_id; ?>"><?php echo ucfirst($author_lastname).' '.ucfirst($author_lastname); ?></a>
  <?php 
  if ($post_created_by_id != $post_updated_by_id) {
    $author_query = "SELECT * FROM users WHERE id='$post_updated_by_id'";
    $execute = mysqli_query($connection, $author_query);
    $get_updated_by = mysqli_fetch_assoc($execute);
    $updated_by_id = $get_updated_by['id'];
    $updated_by_firstname = $get_updated_by['firstname'];
    $updated_by_lastname = $get_updated_by['lastname'];
    ?>
                    <?php echo _l_updated_by; ?> <a href="index.php?source=<?php echo urlencode('read all posts updated by '); ?>&updated_by_id=<?php echo $post_updated_by_id; ?>"><?php echo ucfirst($updated_by_lastname).' '.ucfirst($updated_by_lastname); ?></a>
    <?php
  }
  ?>                  
  <?php 
  $get_count_comment = "SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status=1";
  $execute_get_comment = mysqli_query($connection, $get_count_comment);
  confirmQuery($get_count_comment);
  $count_comment = mysqli_num_rows($execute_get_comment);
  ?>                  
                    <?php echo ucfirst(_l_comments); ?> <i class="fa fa-comments-o"></i> <span class="label label-primary"><?php echo $count_comment; ?></span>
                  </div>
                </div>
              </div>
    <?php 
  }
}
else {
  ?>
  <div class="col" style="margin-left: 50px; margin-right: 50px;">
    <p class="alert alert-danger"><?php echo _l_no_post; ?></p>
  </div>
  <?php
}
?> 

</div>

<!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
<?php 
if ($page>1) {
  ?>
        <li class="page-item">
          <a class="page-link" href="index.php?page=<?php echo $page-1; ?>" title="page <?php echo $page-1; ?>">&laquo;</i></a>
        </li>
  <?php
}
?>
<?php 
for ($i = 1; $i <=$count; $i++) {
  if ($i == $page) {
    ?>
          <li class="page-item active"><a class="page-link" href="index.php?page=<?php echo $i; ?>" title="page <?php echo $i; ?>"><?php echo $i; ?></a></li>    
    <?php
  }
  else {
  ?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>" title="page <?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php
        }
}
?>
<?php 
if ($count>$page) {
  ?>
        <li class="page-item">
          <a class="page-link" href="index.php?page=<?php echo $page+1; ?>" title="page <?php echo $page+1; ?>">&raquo;</i></a>
        </li> 
  <?php
}
?>
          </ul>
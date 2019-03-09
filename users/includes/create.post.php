
<?php 
if (isset($_POST['create_post'])) {
  
  $post_title = $_POST['post_title'];
  // $post_title = htmlentities($post_title);
  $post_title = mysqli_escape_string($connection,$post_title);

  $post_category = $_POST['post_category'];
  // $post_category = htmlentities($post_category);
  $post_category = mysqli_escape_string($connection, $post_category);

  $post_status = $_POST['post_status'];
  // $post_status = htmlentities($post_status);
  $post_status = mysqli_escape_string($connection, $post_status);

  $post_content = $_POST['post_content'];
  // $post_content = htmlentities($post_content);
  $post_content = mysqli_escape_string($connection, $post_content);

  $post_created_by_id = $_SESSION['id'];
  $post_updated_by_id = $_SESSION['id'];

  $post_image = $_FILES['post_image']['name'];
  $tmp_post_image = $_FILES['post_image']['tmp_name'];

  if (!empty($post_title) || !empty($post_content)) {
    move_uploaded_file($tmp_post_image, '../uploads/images/posts/'.$post_image);

    if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
      $create_post_query = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_content`, `post_status`, `post_image`, `created_date`, `created_by_id`, `updated_date`, `updated_by_id`) VALUES ('$post_category','$post_title','$post_content','$post_status','$post_image',now(),'$post_created_by_id',now(),'$post_updated_by_id')";
    }
    else {
      $create_post_query = "INSERT INTO `cn_posts`(`post_category_id`, `post_title`, `post_content`, `post_status`, `post_image`, `created_date`, `created_by_id`, `updated_date`, `updated_by_id`) VALUES ('$post_category','$post_title','$post_content','$post_status','$post_image',now(),'$post_created_by_id',now(),'$post_updated_by_id')";
    
    }
    $execute_insert_query = mysqli_query($connection, $create_post_query);
    $post_id = mysqli_insert_id($connection);
    $encode = urlencode('reading more details of post');
    $encode1 = urlencode('all posts :- including published and draft post');

    $success = _l_post_created." <a href='index.php?source=$encode&post_id=$post_id'>View</a> | <a href='index.php?source=$encode1'> Go to all post</a>";
  }
  else {
    $error = _l_please_fill_all;
  }
}
?>
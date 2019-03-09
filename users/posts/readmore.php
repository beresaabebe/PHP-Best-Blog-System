<?php include_once('../includes/database.php'); ?>
<?php include_once('../includes/functions.php'); ?>

          <!-- Page Heading -->
          <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
          </h1>
          <div class="row">
<?php
if (isset($_GET['post_id'])) {
  $post_id = $_GET['post_id'];


$query = "SELECT * FROM posts WHERE id='$post_id'";
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

            <div class="col-lg-12 col-md-4 col-sm-6 portfolio-item">
              <div class="panel panel-default">

<?php 
if (!empty($post_image)) {
  ?>
                  <a href=""><img class="img img-responsive" src="../uploads/images/posts/<?php echo $post_image; ?>" alt=""></a>
  <?php
}
?>                
                <div class="panel-body">
                  <h4 class="card-title">
                    <a href=""><?php echo $post_title; ?></a>
                  </h4>
                  <p class="card-text"><?php 
                    echo $post_content;
                  ?></p><hr>
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
<?php } ?>

<hr>
        <div class="col-lg-12">
<?php 
if (isset($_POST['send_comment'])) {
  $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
  $comment_post_id = $_GET['post_id'];

$get_creater = "SELECT created_by_id FROM posts WHERE id='$comment_post_id'";
$execute_get_creator = mysqli_query($connection, $get_creater);
confirmQuery($execute_get_creator);
$get_user = mysqli_fetch_array($execute_get_creator);

$user_id = $get_user['created_by_id'];

  $comment_author_id = $_SESSION['id'];
$email_query = "SELECT email FROM users WHERE id='$comment_author_id'";
$execute_email_query = mysqli_query($connection, $email_query);
confirmQuery($execute_email_query);
$email_row = mysqli_fetch_array($execute_email_query);
$comment_author_email = $email_row['email'];
  if (!empty($comment_content)) {
    $query = "INSERT INTO `comments`(`comment_post_id`,`comment_post_creater_id`,`comment_author_id`, `comment_author_email`, `comment_content`, `comment_created_date`) VALUES ('$comment_post_id','$user_id','$comment_author_id','$comment_author_email','$comment_content',now())";
    $create_comment = mysqli_query($connection,$query);
    //confirmQuery($create_comment);
    $success = "Your comment successfully submited and waiting approval!";
  }
}
?>  
<?php if (isset($success)): ?>
  <div class="alert alert-success">
    <?php echo $success; ?>
  </div>
<?php endif ?>          
          <!-- Comments Form -->
          <div class="panel panel-default">
            <h3 class="panel-heading"><i class="fa fa-comment text-success"></i> <span class="text-success">Leave a Comment</span></h3>
            <form action="" method="post">
              <div class="panel-body">
                <div class="form-group">
                  <textarea name="comment_content" class="form-control" rows="6" placeholder="Do you want to comment this posts? Write here!" required="true"></textarea>
                </div>                
                <button type="submit" name="send_comment" value="Submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
              </div>
            </form>
          </div>
          <hr>
        </div>
        <!-- Comment -->
        <div class="col-lg-12">
          <div class="panel panel-default">            
            <div class="panel-body">
<?php 
$post_id = $_GET['post_id'];
$get_comment_query = "SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status=1";
$get_comment_query_execute = mysqli_query($connection,$get_comment_query);
confirmQuery($get_comment_query_execute);
while ($comment = mysqli_fetch_array($get_comment_query_execute)) {

    $comment_author_id = $comment['comment_author_id'];
$get_comment_author = "SELECT * FROM users WHERE id='$comment_author_id'";
$get_author_execute = mysqli_query($connection, $get_comment_author);
$get_author = mysqli_fetch_array($get_author_execute);
$author_firstname = $get_author['firstname'];
$author_lastname = $get_author['lastname'];
$image = $get_author['image'];

    $comment_content = $comment['comment_content'];
    $comment_date = $comment['comment_created_date'];
?>
<?php 
if (!empty($image)) {
  ?>
              <img class="pull-left img img-circle form-inline" style="width: 50px; height: 50px;" src="../uploads/images/users/<?php echo $image; ?>" alt="<?php echo $image; ?>">
  <?php
}
else {
  ?>
              <img class="pull-left img img-circle form-inline" style="width: 50px; height: 50px;" src="../uploads/images/users/boy.jpg">
  <?php
}
?>
              <h5><strong><?php echo ucfirst($author_firstname)." ".ucfirst($author_lastname); ?></strong> <?php echo date('F,Y',strtotime(formatDate($comment_date))); ?></h5>
              <?php echo $comment_content; ?>
          <hr>
<?php
}
?>            
                </div>
              </div>
            </div>
          </div>  <!-- End col-9 row -->  

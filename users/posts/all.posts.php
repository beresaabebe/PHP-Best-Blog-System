  <div class="container-fluid">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo _l_published_and_draft; ?></h3>
              <a class="btn btn btn-primary pull-right" href="index.php?source=<?php echo urlencode('create new post to publish!');?>" title="Do you want to create new post?"><i class="fa fa-plus"></i> <?php echo _l_add_new_post; ?></a>
            </div>
            <!-- /.box-header -->
            <div  style="overflow-x: scroll;" class="box-body">
              <table id="example1" class="table table-condensed table-hover">
                <thead>
                <tr>
                  <th><?php echo _l_srno; ?></th>
                  <th><?php echo _l_post_title; ?></th>
                  <th><?php echo _l_content; ?></th>
                  <th><?php echo _l_category; ?></th>
                  <th><?php echo _l_updated_date; ?></th>
                  <th><?php echo _l_image; ?></th>
                  <th><?php echo _l_comments; ?></th>
                  <th><?php echo _l_status; ?></th>
                  <th><?php echo _l_publish; ?></th>
                  <th><?php echo _l_unpublish; ?></th>
                  <th><?php echo _l_view; ?></th>
                  <th><?php echo _l_edit; ?></th>
                  <th><?php echo _l_delete; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 
$srno = 0;
$post_author = $_SESSION['id'];
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
 $query = "SELECT * FROM posts WHERE created_by_id='$post_author'"; 
}
else {
  $query = "SELECT * FROM cn_posts WHERE created_by_id='$post_author'";
}
$execute = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($execute)) {
    $post_id = $row['id'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
  $cat_query = "SELECT category_name FROM categories WHERE id='$post_category_id'"; 
}
else {
  $cat_query = "SELECT category_name FROM cn_categories WHERE id='$post_category_id'";
}
$execute_cat = mysqli_query($connection, $cat_query);
$get_category_name = mysqli_fetch_array($execute_cat);
$category_name = $get_category_name['category_name'];

    $post_content = $row['post_content'];
    $post_image = $row['post_image'];
    $created_date = $row['created_date'];

    $post_status = $row['post_status'];

    $created_by_id = $row['created_by_id'];
$post_created_by_query = "SELECT firstname,lastname FROM users WHERE id='$created_by_id'";
$execute_post_created_by = mysqli_query($connection, $post_created_by_query);
$get_name = mysqli_fetch_array($execute_post_created_by);
$firstname_creator = $get_name['firstname'];
$lastname_creator = $get_name['lastname'];

    $updated_date = $row['updated_date'];
    $updated_by_id = $row['updated_by_id'];
$post_updated_by_query = "SELECT firstname,lastname FROM users WHERE id='$updated_by_id'";
$execute_post_updated_by = mysqli_query($connection, $post_updated_by_query);
$get_updater_name = mysqli_fetch_array($execute_post_updated_by);
$firstname_updater = $get_updater_name['firstname'];
$lastname_updater = $get_updater_name['lastname'];
    $srno++;
?>
                <tr title="<?php echo $post_title; ?>">
                  <td><?php echo $srno; ?>.</td>
                  <td><a title="Do you want to edit?" href="index.php?source=<?php echo urlencode('do you want to edit this post'); ?>&edit_post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></td>
                  <td><a title="Read more content of this post" href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>">Read this content</a></td>
                  <td><?php echo $category_name; ?></td>
                  <td><?php echo formatDate($updated_date); ?></td>
                  <td>
<?php 
if (!empty($post_image)) {
  ?>
                    <a href="../uploads/images/posts/<?php echo $post_image; ?>"><img class="img img-responsive" style="width: 50px;height: 50px;" src="../uploads/images/posts/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>"></a>
  <?php
}
?>                    
                  </td>

<?php 
$approved_comment_query = "SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status=1";
$execute_approved_comment_query = mysqli_query($connection, $approved_comment_query);
$count_approved_comment = mysqli_num_rows($execute_approved_comment_query);
?>

<?php 
$unapproved_comment_query = "SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status=0";
$execute_unapproved_comment_query = mysqli_query($connection, $unapproved_comment_query);
$count_unapproved_comment = mysqli_num_rows($execute_unapproved_comment_query);
?>

                  <td title="This post have <?php echo $count_approved_comment + $count_unapproved_comment; ?> total comments"><span><small title="<?php echo $count_approved_comment;?> approved comments" class="label bg-primary"><?php echo $count_approved_comment; ?></small> <small title="<?php echo $count_unapproved_comment; ?> unapproved comments" class="label bg-red"><?php echo $count_unapproved_comment; ?></small></span></td>                  
                  <td><?php if ($post_status==='1') {
                    $published = _l_published;
                    echo "<span class='text-primary'>{$published}</span>";
                  } else {
                    $draft = _l_draft;
                    echo "<span class='text-danger'>{$draft}</span>";
                  } ?></td>
                  <td><a href="index.php?source=<?php echo urlencode('all posts :- including published and draft post'); ?>&publish=<?php echo $post_id; ?>" class="label bg-primary"><i class="fa fa-check-square-o"></i> <?php echo _l_publish; ?></a></td>
                  <td><a href="index.php?source=<?php echo urlencode('all posts :- including published and draft post'); ?>&unpublish=<?php echo $post_id; ?>" class="label bg-red"><i class="fa fa-times-circle"></i> <?php echo _l_unpublish; ?></a></td>
                  <td><a class="label bg-blue" href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $post_id; ?>"><i class="fa fa-vimeo"></i> <?php echo _l_view; ?></a></td>
                  <td><a class="label bg-green" href="index.php?source=<?php echo urlencode('do you want to edit this post'); ?>&edit_post_id=<?php echo $post_id; ?>"><i class="fa fa-edit"></i> <?php echo _l_edit; ?></a></td>
                  <td><a class="label bg-red" href="index.php?source=<?php echo urlencode('all posts :- including published and draft post'); ?>&delete_post_id=<?php echo $post_id; ?>"><i class="fa fa-remove"></i> <?php echo _l_delete; ?></a></td>
                </tr>
<?php
}
?>                
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo _l_srno; ?></th>
                  <th><?php echo _l_post_title; ?></th>
                  <th><?php echo _l_content; ?></th>
                  <th><?php echo _l_category; ?></th>
                  <th><?php echo _l_updated_date; ?></th>
                  <th><?php echo _l_image; ?></th>
                  <th><?php echo _l_comments; ?></th>
                  <th><?php echo _l_status; ?></th>
                  <th><?php echo _l_publish; ?></th>
                  <th><?php echo _l_unpublish; ?></th>
                  <th><?php echo _l_view; ?></th>
                  <th><?php echo _l_edit; ?></th>
                  <th><?php echo _l_delete; ?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Content Wrapper. Contains page content -->

<!-- publish posts -->
<?php 
if (isset($_GET['publish'])) {
  $post_id = $_GET['publish'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "UPDATE posts SET post_status='1' WHERE id='$post_id'";
  }
  else {
    $query = "UPDATE cn_posts SET post_status='1' WHERE id='$post_id'";
  }
  $execute = mysqli_query($connection, $query);
  $encode2 = urlencode('all posts :- including published and draft post');
  header('index.php?source='.$encode2);
}
?>
<!-- unpublish post -->
<?php 
if (isset($_GET['unpublish'])) {
  $post_id = $_GET['unpublish'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "UPDATE posts SET post_status='0' WHERE id='$post_id'";
  }
  else {
    $query = "UPDATE cn_posts SET post_status='0' WHERE id='$post_id'";
  }
  $execute = mysqli_query($connection, $query);

  $encode2 = urlencode('all posts :- including published and draft post');
  header('index.php?source='.$encode2);
}
?>

<!-- delete posts -->
<?php 
if (isset($_GET['delete_post_id'])) {
  $delete_post_id = $_GET['delete_post_id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "DELETE FROM posts WHERE id='$delete_post_id'";
  }
  else {
    $query = "DELETE FROM posts WHERE id='$delete_post_id'";
  }
  $execute_delete_query = mysqli_query($connection, $query);
  $encode2 = urlencode('all posts :- including published and draft post');
  header('index.php?source='.$encode2);
}
?>
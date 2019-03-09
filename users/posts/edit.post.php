  <div class="container-fluid">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
<?php 
if (isset($_GET['edit_post_id'])) {
  $post_id = $_GET['edit_post_id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "SELECT * FROM posts WHERE id='$post_id'";    
  }
  else {
    $query = "SELECT * FROM cn_posts WHERE id='$post_id'";
  }
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $row = mysqli_fetch_array($execute);
  $post_title = $row['post_title'];
  $post_content = $row['post_content'];
  $post_image = $row['post_image'];
  $post_status = $row['post_status'];
  $post_category_id = $row['post_category_id'];

  ?>
<div class="card mb-4">
  <div class="card-body">
      <div class="box-header">
<?php 
$user_id = $_SESSION['id'];
$query = "SELECT firstname FROM users WHERE id='$user_id'";
$execute = mysqli_query($connection, $query);
$row = mysqli_fetch_array($execute);
$firstname = $row['firstname'];
?>        
        <h2 class="card-title"><?php echo ucfirst($firstname); ?>
        <small> <?php echo _l_do_want_edit_post; ?></small></h2>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          <div class="form-group">
            <label><?php echo _l_new_post_title; ?></label>
            <input type="text" value="<?php echo $post_title; ?>" name="post_title" placeholder="<?php echo _l_new_post_title; ?>" class="form-control" required="true">
          </div>
          <div class="form-inline">
            <label><?php echo _l_post_image; ?></label>
            <img class="img img-rounded" style="width: 50px; height: 40px;" src="../uploads/images/posts/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
            <input type="file" name="post_image" style="margin-bottom: 5px;">
          </div>
          <div class="form-group">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
  $query = "SELECT category_name FROM categories WHERE id='$post_category_id'";
}
else {
  $query = "SELECT category_name FROM cn_categories WHERE id='$post_category_id'";
}
$execute_category = mysqli_query($connection,$query);
confirmQuery($execute_category);
$cat = mysqli_fetch_array($execute_category);
$category_name = $cat['category_name'];
?>
            <label><?php echo _l_post_category; ?> <span class="label label-success"><?php echo $category_name; ?></span></label>
            <select name="post_category_id" class="form-control select2">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
  $query = "SELECT * FROM categories";
}
else {
  $query = "SELECT * FROM cn_categories";
}
$execute = mysqli_query($connection,$query);
confirmQuery($execute);
while ($row = mysqli_fetch_array($execute)) {
    $cat_id = $row['id'];
    $cat_name = $row['cat_name'];
    ?>
<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
    <?php
}
?>
            </select>
          </div>
          <div class="form-group">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><?php echo _l_post_content; ?>
                  <small><?php echo _l_edit_your_post_here; ?></small>
                </h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                          title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body pad">
                <textarea id="editor1" name="post_content" required="true" rows="10" cols="80"><?php echo $post_content; ?>
                </textarea>
              </div>
            </div>
            <!-- /.box -->
          </div>
          <div class="form-group">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
  $query = "SELECT post_status FROM posts WHERE id='$post_id'";
}
else {
  $query = "SELECT post_status FROM cn_posts WHERE id='$post_id'";
}
$execute_post_status = mysqli_query($connection, $query);
confirmQuery($execute_post_status);
$get_post_status = mysqli_fetch_array($execute_post_status);
$db_post_status = $get_post_status['post_status'];
?>            
            <label><?php echo _l_select_post_status; ?> 
<?php 
if ($post_status === 1) {
  ?>
  <span class="label label-primary"><?php echo _l_published; ?></span>
<?php
}
else {
  ?>
  <span class="label label-primary"><?php echo _l_unpublished; ?></span>
<?php
}
?>
            </label>
            <select name="post_status" class="form-control">
              <option value="published"><?php echo _l_publish; ?></option>
              <option value="draft"><?php echo _l_draft; ?></option>
            </select>
          </div>          
          <div class="form-group">
            <input type="submit" name="update" value="<?php echo _l_update_post; ?>" class="btn btn-primary btn-block">
          </div>
        </form>
      </div>
</div>
</div>

  <?php
}
else {
$encode = urlencode('all posts :- including published and draft post');
  Redirect_To('index.php?source='.$encode);
}
?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php 
// echo $created_by = $_SESSION['id'];
if (isset($_POST['update'])) {

  $post_id = $_GET['edit_post_id'];

  $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
  $post_content = htmlspecialchars($post_content);
  $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);

  $post_category_id = $_POST['post_category_id'];

  $post_image = $_FILES['post_image']['name'];
  $post_image_tmp = $_FILES['post_image']['tmp_name'];

  $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);

  if (empty($post_image)) {
    if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
      $query = "SELECT * FROM posts WHERE id='$post_id'";
    }
    else {
      $query = "SELECT * FROM cn_posts WHERE id='$post_id'";
    }
    $execute = mysqli_query($connection,$query);
    $row = mysqli_fetch_array($execute);
    $post_image = $row['post_image'];
  }
  move_uploaded_file($post_image_tmp,"../uploads/images/posts/".$post_image);
  $post_updated_by = $_SESSION['id'];

  if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
    $query = "UPDATE `posts` SET 
      `post_category_id`='$post_category_id',
        `post_title`='$post_title',
          `post_content`='$post_content',
            `post_status`='$post_status',
              `post_image`='$post_image',
                `updated_date`=now(),
                  `updated_by_id`='$post_updated_by'
            WHERE id='$post_id'";
  }
  else {
    $query = "UPDATE `cn_posts` SET 
      `post_category_id`='$post_category_id',
        `post_title`='$post_title',
          `post_content`='$post_content',
            `post_status`='$post_status',
              `post_image`='$post_image',
                `updated_date`=now(),
                  `updated_by_id`='$post_updated_by'
            WHERE id='$post_id'";
  }

  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $encode = urlencode('all posts :- including published and draft post');
  Redirect_To('index.php?source='.$encode);
}
?>
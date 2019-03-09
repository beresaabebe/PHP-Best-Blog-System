<?php include_once('../includes/database.php'); ?>
<?php include_once('../includes/functions.php'); ?>
<?php include_once 'includes/create.post.php'; ?>
<?php 
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$execute = mysqli_query($connection, $query);
confirmQuery($execute);
$row = mysqli_fetch_array($execute);
$firstname = $row['firstname'];
$lastname = $row['lastname'];
?>
      <!-- Page Heading -->
      <h1 class="my-4"><?php echo ucfirst($firstname." ".$lastname); ?>
        <small><?php echo lcfirst(_l_create_new_post); ?></small>
      </h1>
      <div class="row">
        <div class="col-lg-12"> 
          <?php if (isset($error)): ?>
           <?php echo "<p class='alert alert-danger'>$error</p>";?>     
          <?php endif ?> 
          <?php if (isset($success)): ?>
           <?php echo "<p class='alert alert-success'>$success</p>";?>     
          <?php endif ?>                 
          <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="post_title" class="sr"><?php echo _l_create_new_post; ?></label>
                <input type="text" name="post_title" placeholder="<?php echo _l_post_title_placeholder; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="post_category" class="sr"><?php echo _l_post_category; ?>p</label>
                <select class="form-control select2" style="width: 100%;" name="post_category">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
 $cat_query = "SELECT * FROM categories"; 
}
else {
  $cat_query = "SELECT * FROM cn_categories";
}
$execute_cat_query = mysqli_query($connection, $cat_query);
while ($row = mysqli_fetch_array($execute_cat_query)) {
$cat_id = $row['id'];
$category_name = $row['category_name'];
?>
                <option value="<?php echo $cat_id; ?>"><?php echo $category_name ?></option>
<?php
}
?>                  
                </select>    
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="post_title" class="sr"><?php echo _l_post_image; ?></label>
                <input type="file" name="post_image">
              </div>
              <div class="form-group">
                <label for="post_title" class="sr"><?php echo _l_post_status; ?></label>
                <select class="form-control" name="post_status">
                  <option value="1"><?php echo _l_publish; ?></option>
                  <option value="0"><?php echo _l_draft; ?></option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="box box-default">
                <div class="box-header">
                  <h3 class="box-title"><?php echo _l_post_content; ?>
                    <small><?php echo _l_write_post_details; ?></small>
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
                  <textarea id="editor1" name="post_content" rows="10" cols="80"></textarea>
                </div>
              </div>
              <div class="form-group">
                <input type="submit" name="create_post" value="<?php echo _l_create_post ?>" class="btn btn-success" style="width: 100%">
              </div>
            </div>
          </form>
        </div>
      </div>  <!-- End col-9 row -->  

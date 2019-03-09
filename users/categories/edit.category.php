<?php 
if (isset($_GET['cat_id'])) {
  $cat_id = $_GET['cat_id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "SELECT * FROM categories WHERE id='$cat_id'";
  }
  else {
    $query = "SELECT * FROM cn_categories WHERE id='$cat_id'";
  }
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $row = mysqli_fetch_array($execute);
  $cat_name = $row['category_name'];
  ?>
    <div class="container-fluid">
   <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="card mb-4">
            <div class="card-body">
                <div class="box">
                  <div class="box-header">
                    <h2 class="card-title"> <?php echo $_SESSION['username']; ?>
                    <small> <?php echo _l_edit_category; ?></small></h2>
                  </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label class="sr-only"><?php echo _l_category_name; ?></label>
                      <input type="text" name="cat_name" value="<?php echo $cat_name; ?>" placeholder="<?php echo _l_category_name; ?>" class="form-control" required="true">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="update" value="<?php echo _l_update_category; ?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
}
else {
  $encode = urlencode('view all categories or add another');
  Redirect_To('home.php?source='.$encode);
}
?>

<?php 

if (isset($_POST['update'])) {
  $cat_id = $_GET['cat_id'];
	$cat_name = mysqli_real_escape_string($connection, $_POST['cat_name']);
	$updated_by = $_SESSION['id'];

	if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "UPDATE `categories` SET 
      `category_name`='$cat_name', 
        `updated_by_id`='$updated_by',
          `updated_date`=now() 
      WHERE id='$cat_id'";
  }
  else {
    $query = "UPDATE `cn_categories` SET 
      `category_name`='$cat_name', 
        `updated_by_id`='$updated_by',
          `updated_date`=now() 
      WHERE id='$cat_id'";
  }
	$execute = mysqli_query($connection,$query);
	confirmQuery($execute);
	$encode = urlencode('view all categories or add another');
	Redirect_To('index.php?source='.$encode);
}

?>
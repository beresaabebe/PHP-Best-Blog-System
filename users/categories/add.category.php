<?php 
$user_id = $_SESSION['id'];
$query = "SELECT username FROM users WHERE id='$user_id'";
$execute = mysqli_query($connection, $query);
confirmQuery($execute);
$row = mysqli_fetch_array($execute);
$username = $row['username'];
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
                    <h2 class="card-title"> <?php echo ucfirst($username); ?>
                    <small> <?php echo _l_category_ask; ?></small></h2>
                  </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<form action="" method="post" accept-charset="utf-8">
                		<div class="form-group">
                			<label class="sr-only"><?php echo _l_category_name; ?></label>
          	      		<input type="text" name="cat_name" placeholder="<?php echo _l_category_name; ?>" class="form-control" required="true">
                		</div>
                		<div class="form-group">
                			<input type="submit" name="create" value="<?php echo _l_create_category; ?>" class="btn btn-primary">
                		</div>
                	</form>
<?php 
// echo $created_by = $_SESSION['id'];
if (isset($_POST['create'])) {
  $cat_name = mysqli_real_escape_string($connection, $_POST['cat_name']);
  $created_by = $_SESSION['id'];
  
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "SELECT * FROM categories WHERE cat_name='$cat_name'";
  }
  else {
    $query = "SELECT * FROM cn_categories WHERE cat_name='$cat_name'";
  }
  $execute = mysqli_query($connection,$query);
  $row = mysqli_fetch_array($execute);
  $db_cat_name = $row['cat_name'];
  if (($cat_name == $db_cat_name)|| ($cat_name === $db_cat_name)) {
    echo "<p class='alert alert-danger'>$cat_name _l_already_created;</p>";
  }
  else {
    if (isset($_SERVER['lang']) && $_SESSION['lang']=='en') {
      $query = "INSERT INTO `categories`(`category_name`, `created_date`, `created_by_id`, `updated_date`, `updated_by_id`) VALUES ('$cat_name',now(),'$created_by',now(),'$created_by')";
    }
    else {
      $query = "INSERT INTO `cn_categories`(`category_name`, `created_date`, `created_by_id`, `updated_date`, `updated_by_id`) VALUES ('$cat_name',now(),'$created_by',now(),'$created_by')";
    }
    $execute = mysqli_query($connection,$query);
    confirmQuery($execute);
    $encode = urlencode('view all categories or add another');
    Redirect_To('index.php?source='.$encode);
  }
}
?>

                </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
  </div>
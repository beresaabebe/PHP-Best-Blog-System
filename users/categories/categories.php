  <div class="container-fluid">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo _l_number_of_categories; ?></h3>
              <span class="pull-right"><a href="index.php?source=<?php echo urlencode('create new category'); ?>" class="btn btn-primary"><?php echo _l_add_category; ?></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
	                <th><?php echo _l_srno; ?></th>
  		            <th><?php echo _l_category_name; ?></th>
  		            <th><?php echo _l_created_by; ?></th>
                  <th><?php echo _l_created_date; ?></th>
  		            <th><?php echo _l_updated_by; ?></th>
                  <th><?php echo _l_updated_date; ?></th>
  		            <th><?php echo _l_edit; ?></th>
  		            <th><?php echo _l_delete; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 
$id = '1';
$srno=0;
$category_created_by_id = $_SESSION['id'];
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
  $query = "SELECT * FROM categories WHERE created_by_id='$category_created_by_id' ORDER BY id DESC";
}
else {
  $query = "SELECT * FROM cn_categories WHERE created_by_id='$category_created_by_id' ORDER BY id DESC";
}
$execute = mysqli_query($connection,$query);
confirmQuery($execute);
$count_row = mysqli_num_rows($execute);
if ($count_row>0) {
  while ($row = mysqli_fetch_array($execute)) {
    $cat_id = $row['id'];
    $cat_name = $row['category_name'];
    $cat_created_date = $row['created_date'];

    $cat_created_by = $row['created_by_id'];

$created_by_query = "SELECT * FROM users WHERE id='$cat_created_by'";
$execute_created_by = mysqli_query($connection,$created_by_query);
confirmQuery($execute_created_by);
$rows = mysqli_fetch_array($execute_created_by);
$created_by_id = $rows['id'];
  $created_by_firstname = $rows['firstname'];
  $created_by_lastname = $rows['lastname'];    

    $cat_updated_date = $row['updated_date'];

    $cat_updated_by = $row['updated_by_id'];
$updated_by_query = "SELECT * FROM users WHERE id='$cat_updated_by'";
$execute_updated_by = mysqli_query($connection,$updated_by_query);
confirmQuery($execute_updated_by);
$updated_by = mysqli_fetch_array($execute_updated_by);
$updated_by_id = $updated_by['id'];
$updated_by_firstname = $updated_by['firstname'];
$updated_by_lastname = $updated_by['lastname'];

    $srno++;
    ?>
<tr>
  <td><?php echo $srno; ?></td>
  <td><a href="index.php?source=<?php echo urlencode('all posts in this category'); ?>&cat_id=<?php echo $cat_id; ?>" title="<?php echo $cat_name; ?>"><?php if (strlen($cat_name)>20) {
    $cat_name = substr($cat_name,0,19)."...";
  } echo $cat_name; ?></a></td>
  <td><a href="index.php?source=<?php echo urlencode('reading more posts by'); ?>&author=<?php echo $created_by_id; ?>"><?php echo ucfirst($created_by_firstname)." ".ucfirst($created_by_lastname); ?></a></td>
  <td><?php echo date('M,Y',strtotime(formatDate($cat_created_date))); ?></td>
  <td><a href="index.php?source=<?php echo urlencode('reading more posts by'); ?>&author=<?php echo $updated_by_id; ?>"><?php echo ucfirst($updated_by_firstname)." ".ucfirst($updated_by_lastname); ?></a></td>  
  <td><?php echo date('M,Y',strtotime(formatDate($cat_updated_date))); ?></td>
  <td><a class="btn btn-xs btn-success" href="index.php?source=<?php echo urlencode('edit this categories'); ?>&cat_id=<?php echo $cat_id; ?>" title="edit this category"><i class="fa fa-edit"></i> <?php echo _l_edit; ?></a></td>
  <td><a class="btn btn-xs btn-danger" href="index.php?source=<?php echo urlencode('view all categories or add another'); ?>&delete_cat_id=<?php echo $cat_id; ?>" title="delete this category"><i class="fa fa-remove"></i> <?php echo _l_delete; ?></a></td>
</tr>

    <?php
  } 
}

?>
                </tbody>
                <tfoot>
                  <tr>
                    <th><?php echo _l_srno; ?></th>
                    <th><?php echo _l_category_name; ?></th>
                    <th><?php echo _l_created_by; ?></th>
                    <th><?php echo _l_created_date; ?></th>
                    <th><?php echo _l_updated_by; ?></th>
                    <th><?php echo _l_updated_date; ?></th>
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
  </div>
</section>
</div>
<?php 
if (isset($_GET['delete_cat_id'])) {
  $cat_id = $_GET['delete_cat_id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "DELETE FROM categories WHERE id='$cat_id'";
  }
  else {
    $query = "DELETE FROM cn_categories WHERE id='$cat_id'";
  }
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $encode = urlencode('view all categories or add another');
  Redirect_To('index.php?source='.$encode);
}
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card mt-3 mb-3">
      <div class="card-header">
        <h4 class="card-title"><?php echo ucfirst(_l_search); ?></h4>
      </div>
      <div class="card-body">
        <form action="?source=<?php echo urlencode('search'); ?>" method="post" accept-charset="utf-8">        
          <div class="input-group">
            <input type="text" name="search" placeholder="<?php echo ucfirst(_l_search_here); ?>" class="form-control">
            <div class="input-group-append">
              <button type="submit" name="search_btn" class="btn btn-outline-secondary"><i class="fa fa-search"></i> <span class="sr-only"><?php echo ucfirst(_l_search); ?></span></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of search card -->
  <div class="col-lg-12 col-md-12">
    <div class="card mt-3 mb-3">
      <div class="card-header">
        <h4 class="card-title"><?php echo ucfirst(_l_top_categories); ?></h4>
      </div>
      <div class="card-body">
        <div class="row">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
  $query = "SELECT * FROM categories LIMIT 10";
  $get_category = mysqli_query($connection, $query);
  if (mysqli_num_rows($get_category)!=0) {
    while ($row = mysqli_fetch_array($get_category)) {
      $category_id = $row['id'];
      $category_name = $row['category_name'];   
    ?>
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
                </li>
              </ul>
            </div>
      <?php
    } //end of while statement
  }//end of if statement mysqli_num_rows
  else {
    ?>
    <div class="col">
      <p class="alert alert-danger"><?php echo ucfirst(_l_no_category); ?></p>
    </div>
    <?php
  } //end of else statement
} //end of if statement
else {
  $query = "SELECT * FROM cn_categories";
  $get_category = mysqli_query($connection, $query);
  if (mysqli_num_rows($get_category)!=0) {
    while ($row = mysqli_fetch_array($get_category)) {
      $category_id = $row['id'];
      $category_name = $row['category_name'];   

    ?>
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
                </li>
              </ul>
            </div>
      <?php
    } //end of while statement
  }//end of if statement mysqli_num_rows
  else {
    ?>
            <div class="col">
              <p class="alert alert-danger"><?php echo ucfirst(_l_no_category); ?></p>
            </div>
    <?php
  } //end of else statement
}
?>                    
        </div>        
      </div>
    </div>
  </div>
  <!-- End of category card -->
</div>
<!-- End of main row -->
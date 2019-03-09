<hr style="border-color: #567;">
<div class="row">
<?php 
if (isset($_GET['categories']) ) {
	$cat_id = $_GET['categories'];
?>
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
$cate_query = "SELECT * FROM posts WHERE post_category_id='$cat_id' AND post_status=1";
} //end of english language session
else { 
$cate_query = "SELECT * FROM cn_posts WHERE post_category_id='$cat_id' AND post_status=1";
}
$execute = mysqli_query($connection, $cate_query);
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

	if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
    $query = "SELECT * FROM posts WHERE post_category_id='$cat_id' AND post_status=1 ORDER BY id DESC LIMIT $page_1,9";
  }
  else {
    $query = "SELECT * FROM posts WHERE post_category_id='$cat_id' AND post_status=1 ORDER BY id DESC LIMIT $page_1,9";
  }
	$execute = mysqli_query($connection, $query);
	confirmQuery($execute);
	while ($row = mysqli_fetch_array($execute)){
		$post_id = $row['id'];
	    $post_title = $row['post_title'];
	    $post_content = $row['post_content'];
	    $post_image = $row['post_image'];
	    $post_created_date = $row['created_date'];
	    $post_created_by_id = $row['created_by_id'];
	    $post_updated_date = $row['updated_date'];
	    $post_updated_by_id = $row['updated_by_id'];
	    $post_category_id = $row['post_category_id'];

if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
  $cat_query = "SELECT * FROM categories WHERE id='$post_category_id'";
}
else {
  $cat_query = "SELECT * FROM cn_categories WHERE id='$post_category_id'";
}
$execute_cat = mysqli_query($connection, $cat_query);
$cat = mysqli_fetch_array($execute_cat);
$category_id = $cat['id'];
$cat_name = $cat['category_name']; 

$author_query = "SELECT * FROM users WHERE  id='$post_created_by_id'";
$execute_author_query = mysqli_query($connection, $author_query);
$author = mysqli_fetch_array($execute_author_query);
$author_id = $author['id'];
$author_fname = $author['firstname'];
$author_lname = $author['lastname'];       

     ?>
          <div class="col-lg-4 col-md-6 mt-3 mb-3">
          	<div class="card">
          		<div class="card-header">
          			<h4 class="card-title"><?php echo ucfirst($post_title); ?></h4>
          		</div>
          		<div class="body">
<?php 
if (!empty($post_image)) {
  ?>
                <div class="card-img-top">
                  <img src="uploads/images/posts/<?php echo $post_image; ?>" alt="" class="img-thumbnail">
                </div>
  <?php
}
?>          
          			<p class="card-text"><?php echo shortenText($post_content); ?> <a href="?source=<?php echo urlencode('read more'); ?>&post=<?php echo $post_id; ?>" class="btn btn-link">Read more</a></p>
          		</div>
              <div class="card-footer">
                <p><i class="fa fa-folder-open-o"></i> Category >> <a class="disabled"><?php echo ucfirst($cat_name); ?></a> <br> <i class="fa fa-user-o"></i> Author >> <a href="?source=<?php echo urlencode('author'); ?>&author=<?php echo $author_id; ?>"><?php echo ucfirst($author_fname.' '.$author_lname); ?></a></p>
              </div>
          	</div>
          </div>
<?php } ?>
</div>
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
<?php 
if ($page>1) {
  ?>
  <li class="page-item"><a class="page-link" href="index.php?source=categories&categories=<?php echo $cat_id; ?>&page=<?php echo $page-1; ?>" title="page <?php echo $page-1; ?>">&laquo;</a></li>
  <?php
}
?>                      
<?php 
for ($i = 1; $i <=$count; $i++) {
  if ($i == $page) {
    ?>
          <li class="page-item active"><a class="page-link" href="index.php?source=categories&categories=<?php echo $cat_id; ?>&page=<?php echo $i; ?>" title="page <?php echo $i; ?>"><?php echo $i; ?></a></li>    
    <?php
  }
  else {
  ?>
            <li class="page-item"><a class="page-link" href="index.php?source=categories&categories=<?php echo $cat_id; ?>&page=<?php echo $i; ?>" title="page <?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php
        }
}
if ($page<$count) {
  ?>
<li class="page-item"><a class="page-link" href="index.php?source=categories&categories=<?php echo $cat_id; ?>&page=<?php echo $page+1; ?>" title="page <?php echo $page+1; ?>">&raquo;</a></li>
  <?php
}
?>

          </ul>
          <hr style="border-color: #567;">
<?php } ?>
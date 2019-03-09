 <hr style="border-color: #567;">
<div class="row">
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang'] =='en') {
	$query = "SELECT * FROM posts WHERE post_status=1";
}
else {
	$query = "SELECT * FROM cn_posts WHERE post_status=1";
}
$execute = mysqli_query($connection, $query);
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


	if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
		$query = "SELECT * FROM posts WHERE post_status=1 ORDER BY id DESC LIMIT $page_1,9";
	}
	else {
		$query = "SELECT * FROM cn_posts WHERE post_status=1 ORDER BY id DESC LIMIT $page_1,9";
	}
	$execute = mysqli_query($connection, $query);
	confirmQuery($execute);
	if (mysqli_num_rows($execute)!=0) {
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

	     ?>
	          <div class="col-lg-4 col-md-6 mb-3">
	          	<div class="card">
	          		<div class="card-header">
	          			<h4 class="card-title"><?php echo nl2br(ucfirst($post_title)); ?></h4>
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

<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
	?>
<p class="card-text"><?php echo shortenText(nl2br($post_content)); ?> <a href="index.php?source=<?php echo urlencode('read more'); ?>&post=<?php echo $post_id; ?>" class="btn btn-primary btn-sm"><?php echo ucfirst(_l_read_more); ?></a></p>
<?php
}
else {
	?>
<p class="card-text"><?php echo cnshortText($post_content); ?> <a href="index.php?source=<?php echo urlencode('read more'); ?>&post=<?php echo $post_id; ?>" class="btn btn-primary btn-sm"><?php echo ucfirst(_l_read_more); ?></a></p>	
	<?php
	}
?>	
	          		</div>
	          	</div>
	          </div>
	<?php 
	} //end of while statement 
} //end of if statement mysqli_num_rows
else {
  ?>
    <div class="col-lg-8 offset-lg-2">
      <p class="alert alert-danger"><?php echo ucfirst(_l_no_post); ?></p>
    </div>
  <?php
}
?>
</div>
<?php 
if ($count>1) {
	?>
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
<?php 
if ($page>1) {
  ?>
        <li class="page-item">
          <a class="page-link" href="index.php?page=<?php echo $page-1; ?>" title="page <?php echo $page-1; ?>">&laquo;</i></a>
        </li>
  <?php
}
?>
<?php 
for ($i = 1; $i <=$count; $i++) {
  if ($i == $page) {
    ?>
          <li class="page-item active"><a class="page-link" href="index.php?page=<?php echo $i; ?>" title="page <?php echo $i; ?>"><?php echo $i; ?></a></li>    
    <?php
  }
  else {
  ?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>" title="page <?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php
        }
}
?>
<?php 
if ($count>$page) {
  ?>
        <li class="page-item">
          <a class="page-link" href="index.php?page=<?php echo $page+1; ?>" title="page <?php echo $page+1; ?>">&raquo;</i></a>
        </li> 
  <?php
}
?>
          </ul>         
<?php } ?>          
<hr style="border-color: #567;">
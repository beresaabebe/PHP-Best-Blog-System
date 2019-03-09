<?php include_once 'includes/header.php'; ?>
<?php 
if ((!isset($_SESSION['id'])) || ($_SESSION['id']===null) || ($_SESSION['role'] === 'admin')) {
	Redirect_To('../includes/logout.php');
}
else {
?>
<?php include_once 'includes/nav.php'; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-12">

<?php 

if (isset($_GET['source'])) {
	$source = $_GET['source'];
}
else {
	$source = "";
}

$readmore = urlencode('reading more details of post');
$post_by_author = urlencode('read all posts by author');
$post_by_categories = urlencode('read all of this category posts');
$post_by_update = urlencode('read all posts updated by ');
$edit_post = urlencode('do you want to edit this post');

$all_post_table = urlencode('all posts :- including published and draft post');
$create_new_post = urlencode('create new post to publish!');

$categories       = urlencode('view all categories or add another');
$add_category     = urlencode('create new category');
$edit_category    = urlencode('edit this categories');

$comments = urlencode('view all created comments including approved and unapproved comments');
$approvedcomments = urlencode('lists of approved comments');
$unapprovedcomments = urlencode('lists of unapproved comments');

$view_user = urlencode('view profile user');
$edit_profile = urlencode('edit user profile');

switch (urlencode($source)) {
	case $edit_post:
		include_once 'posts/edit.post.php';
		break;
	case $edit_profile:
		include_once 'profile/edit_user.php';
		break;
	case $view_user:
		include_once 'profile/view_user.php';
		break;
	case $unapprovedcomments:
		include_once 'comments/unapproved.comments.php';
		break;
	case $approvedcomments:
		include_once 'comments/approved.comments.php';
		break;
	case $comments:
		include_once 'comments/comments.php';
		break;
	case $create_new_post:
		include_once 'posts/add_post.php';
		break;
	case $all_post_table:
		include_once 'posts/all.posts.php';
		break;
	case $post_by_update:
		include_once 'posts/posts_updated_by.php';
		break;
	case $post_by_author:
		include_once 'posts/posts_by_author.php';
		break;
	case $post_by_categories:
		include_once 'posts/post.by.categories.php';
		break;
	case $readmore:
		include_once 'posts/readmore.php';
		break;
	case $edit_category:
	    include_once('categories/edit.category.php');
	    break;
	case $add_category:
	    include_once('categories/add.category.php');
	    break;
	case $categories:
	    include_once('categories/categories.php');
	    break;		
	default:
		include_once 'includes/home.php';
		break;
}

?>


    </div>
<?php include_once 'includes/sidebar.php'; ?>
  </div>
</div>
<?php include_once 'includes/footer.php'; ?>
<?php } //end of else stateent
?>
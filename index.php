<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/nav.php'; ?>
	<div class="container-fluid mt-3 mb-3">
		<div class="row">
			<div class="col-lg-9" id="main_body">
<?php 
if (isset($_GET['source'])) {
	$source = $_GET['source'];
}
else {
	$source = "";
}
$login = urlencode('login');
$readmore = urlencode('read more');

$forget = urlencode('forget');
$forget_process = urlencode('process forget');
$create_forget_pass = urlencode('create new password');
$categories = urlencode('categories');
$new = urlencode('new');
$create = urlencode('create new account');
$goto_email = urlencode('goto email account');
$confirm_registration = urlencode('confirm registration');
$search = urlencode('search');
$author = urlencode('author');

switch (urlencode($source)) {
	case $search:
		include_once 'search/search.php';
		break;
	case $confirm_registration:
		include_once 'createaccount/confirm_registration.php';
		break;
	case $goto_email:
		include_once 'createaccount/goto_email.php';
		break;
	case $create:
		include_once 'createaccount/create.account.php';
		break;
	case $new:
		include_once 'forget/success.new.password.php';
		break;
	case $create_forget_pass:
		include_once 'forget/create_new_password.php';
		break;
	case $author:
		include_once 'author/author.php';
		break;
	case $categories:
		include_once 'categories/categories.php';
		break;
	case $readmore:
		include_once 'posts/readmore.php';
		break;
	case $forget_process:
		include_once 'forget/process.forget.php';
		break;
	case $forget:
		include_once 'forget/forget.php';
		break;
	case $login:
		include_once 'login/login.php';
		break;
	default:
		include_once 'posts/posts.php';
		break;
}
?>		

			</div>
<?php 
if ($source == urlencode('search')) {
	
}
else {
	?>
			<div class="col-lg-3" id="sidebar">
				<?php include_once 'includes/sidebar.php'; ?>
			</div>
	<?php
}
?>			
		</div>
	</div>
<?php require_once 'includes/footer.php'; ?>
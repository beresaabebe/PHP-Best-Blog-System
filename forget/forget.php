<?php 
if (isset($_POST['search_email_btn'])) {
	$errors = array();
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($connection, $email);
	if (empty($email) || $email == '') {
		$errors[] = _l_fill_email;
	}
	else {
		$query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$execute_query = mysqli_query($connection, $query);
		if (mysqli_num_rows($execute_query)!=0) {
			$token = "Q1w2er36tAyQ8WS6D0gFG9CYj6h9hYg4FdJ2oL8gVI4c7PgD9qS0zM6B4";
			$token = str_shuffle($token);
			$encode = urlencode('process forget');
			header("Location: ?source={$encode}&email={$email}&token={$token}");
		}
		else {
			$errors[] = "<span class='text-danger'><i class='fa fa-envelope-o'></i></span> ". _l_no_signed_up." ".$email;
		}
	}
}
?>
<div class="row mt-3 mb-3">
	<div class="col-lg-6 offset-lg-3">
		<div class="car">
			<div class="card-header">
				<h4 class="card-title"><?php echo ucfirst(_l_forget_title); ?></h4>
			</div>
			<div class="card-body">
<?php 
if (!empty($errors)) {
	foreach ($errors as $error) {
		echo "<p class='alert alert-danger'>{$error}</p>";
	}
}
?>				
				<form action="?source=<?php echo urlencode('forget'); ?>" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for=""><?php echo ucfirst(_l_email); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
							</div>
							<input type="email" name="email" value="<?php if(isset($_POST['email']) && $_POST['email'] !='') echo htmlentities($_POST['email']); ?>" placeholder="<?php echo ucfirst(_l_enter_email); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" name="search_email_btn" class="btn btn-secondary"><i class="fa fa-search"></i> <?php echo ucfirst(_l_search); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
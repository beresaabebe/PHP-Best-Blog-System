<?php include_once 'process.login.php'; ?>
<div class="row mt-3 mb-3">
	<div class="col-lg-6 offset-lg-4">
		<div class="car">
			<div class="card-header">
				<h4 class="card-title"><?php echo _l_login; ?></h4>
			</div>
			<div class="card-body">
<?php 
if (!empty($errors)) {
	foreach ($errors as $error) {
		echo "<p class='alert alert-danger'> {$error}</p>";
	}
}
?>				
				<form action="?source=<?php echo urlencode('login'); ?>" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="username"><?php echo ucfirst(_l_username); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" name="username" placeholder="<?php echo ucfirst(_l_username); ?>" class="form-control" value="<?php if(isset($_POST['username']) && $_POST['username'] != '') echo htmlentities($_POST['username']); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="password"><?php echo ucfirst(_l_password); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							<input type="password" name="password" placeholder="<?php echo ucfirst(_l_password); ?>" class="form-control" value="<?php if(isset($_POST['password']) && $_POST['username'] != '') echo htmlentities($_POST['password']); ?>">
						</div>
					</div>
					<div class="form-group">
						<input type="submit" name="login" value="<?php echo ucfirst(_l_login); ?>" class="btn btn-primary"> <span><?php echo _l_forget; ?> <a href="?source=<?php echo urlencode('forget'); ?>"><?php echo ucfirst(_l_click_here); ?></a></span>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<span class="offset-lg-3"><?php echo ucfirst(_l_don_have_account); ?> <a href="?source=<?php echo urlencode('create new account'); ?>"><?php echo ucfirst(_l_sign_up); ?></a></span>
			</div>
		</div>
	</div>
</div>
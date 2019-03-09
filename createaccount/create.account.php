<?php include_once 'register.php'; ?>
<div class="row">
	<div class="col-lg-9 offset-lg-2 my-lg-3">
<?php 
if (isset($errors) && !empty($errors)) {
	foreach ($errors as $error) {
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong><span class="text-danger"><i class="fa fa-warning"></i></span></strong> <?php echo $error; ?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php
	}
}
?>		
		<div class="car card-primary card-outline-primary">
			<div class="card-header">
				<h4 class="card-title text-primary"><i class="fa fa-user-plus"></i> <?php echo ucfirst(_l_create_account_title); ?></h4>
			</div>
			<div class="card-body">
				<form action="?source=<?php echo urlencode('create new account'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<div class="form-group">
						<label for="firstname"><?php echo ucfirst(_l_firstname); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-user-o"></i></span>
							</div>
							<input type="text" name="firstname" value="<?php if(isset($_POST['firstname']) && $_POST['firstname'] !='') echo $_POST['firstname']; ?>" placeholder="<?php echo ucfirst(_l_firstname); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="lastname"><?php echo ucfirst(_l_lastname); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" name="lastname" value="<?php if(isset($_POST['lastname']) && $_POST['lastname'] !='') echo $_POST['lastname']; ?>" placeholder="<?php echo ucfirst(_l_lastname); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="username"><?php echo ucfirst(_l_username); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text text-primary"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" name="username" value="<?php if(isset($_POST['username']) && $_POST['username'] !='') echo $_POST['username']; ?>" placeholder="<?php echo ucfirst(_l_enter_username); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="email"><?php echo ucfirst(_l_email); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="email" name="email" value="<?php if(isset($_POST['email']) && $_POST['email'] !='') echo $_POST['email']; ?>" placeholder="<?php echo ucfirst(_l_enter_email); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="password"><?php echo ucfirst(_l_password); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-lock"></i></span>
							</div>
							<input type="password" name="password" value="<?php if(isset($_POST['password']) && $_POST['password'] !='') echo $_POST['password']; ?>" placeholder="<?php echo ucfirst(_l_password_placeholder); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="confirmpassword"><?php echo ucfirst(_l_confirm_password); ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-lock"></i></span>
							</div>
							<input type="password" name="confirmpassword" value="<?php if(isset($_POST['confirmpassword']) && $_POST['confirmpassword'] !='') echo $_POST['confirmpassword']; ?>" placeholder="<?php echo ucfirst(_l_confirm_password_placeholder); ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="image"><?php echo _l_upload_image; ?></label>
						<input type="file" name="image">
					</div><hr style="border-color: #567;">
					<div class="form-group">
						<input type="submit" name="register" value="<?php echo _l_sign_up; ?>" class="btn btn-primary btn-sm">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
if (isset($_GET['email']) && isset($_GET['token'])) {
	$email = $_GET['email'];
	$token = $_GET['token'];

	$query = "SELECT email,token FROM users WHERE email='$email' AND token='$token'";
	$execute = mysqli_query($connection,$query);
	confirmQuery($execute);
	if (mysqli_num_rows($execute)!=0) {
		?>
		<div class="row">
        	<div class="col-lg-9 offset-lg-2">
        		<div class="car card-danger">
        			<div class="card-header">
        				<h4 class="card-title"><?php echo _l_create_new_password; ?></h4>
        			</div>
        			<div class="card-body">
        				<form action="?source=<?php echo urlencode('create new password'); ?>&email=<?php echo $email; ?>&token=<?php echo $token; ?>" method="post" accept-charset="utf-8">
        					<div class="form-group">
        						<label for="password"><?php echo _l_new_password; ?></label>
        						<div class="input-group">
        							<div class="input-group-prepend">
        								<span class="input-group-text"><i class="fa fa-lock"></i></span>
        							</div>
        							<input type="password" name="password" value="<?php if(isset($_POST['password']) && $_POST['password'] !='') echo htmlentities($_POST['password']); ?>" placeholder="<?php echo _enter_new_password; ?>" class="form-control">
        						</div>
        					</div>
        					<div class="form-group">
        						<label for="password"><?php echo _l_confirm_new_password; ?></label>
        						<div class="input-group">
        							<div class="input-group-prepend">
        								<span class="input-group-text"><i class="fa fa-lock"></i></span>
        							</div>
        							<input type="password" name="confirmpassword" value="<?php if(isset($_POST['confirmpassword']) && $_POST['confirmpassword'] !='') echo htmlentities($_POST['confirmpassword']); ?>" placeholder="<?php echo _l_enter_confirm_new_password; ?>" class="form-control">
        						</div>
        					</div>
							<div class="form-group">
								<input type="submit" name="create" value="<?php echo _l_change_save; ?>" class="btn btn-primary btn-lg">
							</div>
        				</form>
        			</div>
        		</div>
        	</div>
        </div>

		<?php
	}
	else {
		?>
		<div class="row">
        	<div class="col-lg-7 offset-lg-3 my-lg-3">
        		<div class="car card-danger">
        			<div class="card-header">
        				<h4 class="card-title text-center text-danger">
        					<span class="text-danger"><i class="fa fa-warning"></i></span><?php echo _l_some_problem_happen; ?></h4>
        			</div>
        			<div class="card-body"> 
        				<div class="card-img-top text-center">
	       					<img src="uploads/images/system.image/error.png" alt="">
	       				</div>       				
        				<p class="text-danger text-center"><?php echo _l_problem_happen; ?></p>
        			</div>
        		</div>
        	</div>
        </div>
		<?php
	}
}
else {
	header('Location: ?source=home');
}
?>
<?php 
if (isset($_POST['create'])) {
	$email = $_GET['email'];
	$token = $_GET['token'];
	$errors = array();
	$password = $_POST['password'];
	$password = mysqli_real_escape_string($connection, $password);
	$confirmpassword = $_POST['confirmpassword'];
	$confirmpassword = mysqli_real_escape_string($connection, $confirmpassword);
	if (empty($password) || $password =="") {
		$errors[] = _l_please_enter_password;
	}
	if (strlen($password)<=5) {
		$errors[] = _l_error_pass_length;
	}
	if ($confirmpassword !== $password) {
		$errors[] = _l_confirm_password_wrong;
	}
	if (empty($errors)) {
		$password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>13));
		$query = "UPDATE users SET password='$password', token='$token' WHERE email='$email'";
		$execute = mysqli_query($connection, $query);
		confirmQuery($execute);
		header("Location: ?source=new&email=$email&token=$token");
	}
	if(!empty($errors)) {
		foreach ($errors as $error) {
			?>
				<div class="row">
		        	<div class="col-lg-9 offset-lg-2 my-lg-1">
		        		<div class="car card-danger">
		        			<p class="alert alert-danger"><span class="text-danger"><i class="fa fa-warning"></i></span> <?php echo $error; ?></p>
		        		</div>
		        	</div>
		        </div>	
			<?php
		}
	}
}
?>
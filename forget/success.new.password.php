<?php include_once 'mailer.php'; ?>
<?php if (isset($_GET['email']) && isset($_GET['token'])) {
	$name = $_GET['token'];
	$email = $_GET['email'];
$query = "SELECT firstname,lastname FROM users WHERE email='$email'";
$execute = mysqli_query($connection, $query);
$rows = mysqli_num_rows($execute);
$fname = $rows['firstname'];
$lname = $rows['lastname'];
$name = $fname." ".$lname;

	$mail->addAddress($email,$name);
	$mail->Subject = "Password Successfully Changed!";
	$mail->Body    = "<h3>NJCIT Blogs </h3><hr><br><h2>Your account new password is successfully changed!<br><a href='http://localhost/blog2/?source=login'>Login</a></h2><h4>NJCIT Blogs!</h4>";
	if(!$mail->send()) {
	    echo "<p class='alert alert-danger'>Message could not be sent.This is may be caused because of internet connetion!</p>";
	}
?>

	<div class="row">
		<div class="col-lg-7 offset-lg-2 offset-md-2">
			<div class="car">
				<div class="card-header">
					<h3 class="card-title"><?php echo _l_new_password_created; ?></h3>
				</div>
				<div class="card-body">	
					<p class="card-text text-primary"><?php echo _l_new_password_created; ?></p>
					<a href="?source=login" class="btn btn-primary btn-block"><?php _l_login; ?></a>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
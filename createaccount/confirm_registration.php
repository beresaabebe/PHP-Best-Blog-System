<?php 
if (isset($_GET['email']) && isset($_GET['token']) && $_GET['email'] !="" && $_GET['token'] !="") {
	$email = $_GET['email'];
	$token = $_GET['token'];
	$query = "SELECT * FROM users WHERE email='$email' AND token='$token' LIMIT 1";
	$execute = mysqli_query($connection, $query);
	$rows = mysqli_fetch_array($execute);
	$firstname = $rows['firstname'];
	$lastname = $rows['lastname'];
	if (mysqli_num_rows($execute)>0) {
		$name = $firstname." ".$lastname;
		$mail->addAddress($email, $name); 

	    $mail->Subject = 'Your Account Verified!';
	    $mail->Body    = "<h3>Your account successfully verified!</h3>
	    <a href='http://192.168.0.125/blog/?source=login'><h2>Login</h2></a>";

	    if ($mail->send()) {
	    	$update_query = "UPDATE `users` SET `status`=1,`emailVerified`=1,`token`='' WHERE email='$email'";
			mysqli_query($connection, $update_query);
	        ?>
	        <div class="row">
	        	<div class="col-lg-9 offset-lg-2">
	        		<div class="car">
		        		<div class="card-header">
		        			<h3><?php echo _l_account_verefied; ?></h3>
		        		</div>
		        		<div class="card-body">
		        			<p class="text-success"><?php echo _l_account_success_creation_info; ?></p>
		        		     <a href="?source=login" title="<?php _l_login ?>" class="btn btn-success text-center"><i class="fa fa-lock"></i> <?php echo _l_login ?></a>
		        		</div>
		        	</div>
	        	</div>
	        </div>
	        <?php
	    } //end of if statement mail sent success
	    else {
	        $query = "UPDATE `users` SET `status`=0,`emailVerified`=0,`token`='$token' WHERE email='$email'";
			$execute = mysqli_query($connection, $query);
			?>
			<div class="row">
	        	<div class="card card-danger">
	        		<div class="card-header">
	        			<h3><?php echo _l_unable_to_verify; ?></h3>
	        		</div>
	        		<div class="card-body">
	        			<p class="text-danger"><?php echo _l_problem_happen; ?></p>
	        		</div>
	        	</div>
	        </div>
			<?php
	    } //end of else statement mail send fail
	} //end of if statement check existance of rows
	else {
		$token="adsfWsQGH8664iudsct5fdcbDFAHDGfhr742399901CSDQR28E773GECEFPssdd";
		$token=str_shuffle($token);
		$encode = "Not user created like this {$token}";
		header("Location: ?source=home&reason={$encode}");
	}
} //end of isset function
else {
	$token="adsfWsQGH8664iudsct5fdcbDFAHDGfhr742399901CSDQR28E773GECEFPssdd";
	$token=str_shuffle($token);
	$encode = "Email is not set {$token}";
	header("Location: ?source=home&reason={$encode}");
}
?>
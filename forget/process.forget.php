<?php if (session_status() == PHP_SESSION_NONE) {
	session_start();
} ?>
<?php include_once 'mailer.php'; ?>
<?php include_once 'lang/define_lang.php'; ?>
<?php 
 if (isset($_GET['email']) && $_GET['token']) {
 	$email = $_GET['email']; 	
 	$token = "Q1w2er36tAyQ8WS6D0gFG9CYj6h9hYg4FdJ2oL8gVI4c7PgD9qS0zM6B4";
	$token = str_shuffle($token);

$query_email = "SELECT * FROM users WHERE email='$email'";
$getname = mysqli_query($connection, $query_email);
$name = mysqli_fetch_array($getname);
$fname = $name['firstname'];
$lname = $name['lastname'];

	$query = "UPDATE `users` SET `token`='$token' WHERE email='$email'";
	$execute = mysqli_query($connection, $query);
	confirmQuery($execute);

	$mail->addAddress($email, $fname." ".$lname);     // Add a recipient

    $mail->Subject = "Forget password recovery!";
    $mail->Body    = "Dear ".$fname." ". $lname.", <br>
    <br><h4>The link below is used to recovery your password!</h4>
    <a class='btn btn-primary' href='http://localhost/blog2/?source=create+new+password&email=$email&token=$token'><h3>Reset Password</h3></a><br><br>
    <i>If you got this email leave it!";
    if ($mail->send()) {
        ?>
        <div class="row">
        	<div class="col-lg-9 offset-lg-2">
        		<div class="card card-success">
        			<div class="card-header">
        				<h4 class="card-title"><span class="text-success"><i class="fa fa-check"></i></span> <?php echo _l_reset_link_sent; ?></h4>
        			</div>
        			<div class="card-body">
        				<div class="card-img-top text-center bg-light">
        					<img src="uploads/images/system.image/success.png" alt="">
        				</div>
        				<p class="text-success text-center"><?php echo _l_goto_email; ?></p>
        			</div>
        		</div>
        	</div>
        </div>
        <?php
    }
    else {
    	$token_update_query = "UPDATE `users` SET `token`='' WHERE email='$email'";
		$execute_token_query = mysqli_query($connection, $token_update_query);
		confirmQuery($execute_token_query);
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        ?>
        <div class="row">
        	<div class="col-lg-9 offset-lg-2">
        		<div class="card card-danger">
        			<div class="card-header">
        				<h4 class="card-title"><?php echo _l_please_try_again; ?></h4>
        			</div>
        			<div class="card-body">
        				<div class="card-img-overlay">
        					<span class="text-danger"><i class="fa fa-warning"></i></span>
        				</div>
        				<p class="text-danger"><?php echo _l_we_are_unble_to_send_reset_link; ?></p>
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
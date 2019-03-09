<?php 
if (isset($_POST['register'])) {
	$errors = array();
	$token = "Q1w2er36tAyQ8WS6D0gFG9CYj6h9hYg4FdJ2oL8gVI4c7PgD9qS0zM6B4";
	$token = str_shuffle($token);
	
	$allowed_ext = array('jpg','jpeg','png','gif');
	$image = $_FILES['image']['name'];
	$image_size = $_FILES['image']['size'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$img_ext = explode('.', $_FILES['image']['name']);
	$image_ext = strtolower(end($img_ext));

	$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$confirmpassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
$username_query = "SELECT username FROM users WHERE username='$username'";
$execute_username_query = mysqli_query($connection, $username_query);
	if (mysqli_num_rows($execute_username_query)>0) {
		$errors[] = _l_username_exist;
	}

$email_query = "SELECT email FROM users WHERE email='$email'";
$execute_email_query = mysqli_query($connection, $email_query);
	if (mysqli_num_rows($execute_email_query)>0) {
		$errors[] = _l_email_exist;
	}
	if (empty($firstname) || $firstname == "") {
		$errors[] = _l_fill_firstname;
	}
	if (empty($lastname) || $lastname == "") {
		$errors[] = _l_fill_lastname;
	}
	if (empty($email) || $email == "") {
		$errors[] = _l_fill_email;
	}
	if (empty($password) || $password == "") {
		$errors[] = _l_fill_password;
	}
	if (empty($username) || $username == "") {
		$errors[] = _l_fill_username;
	}
	if (empty($confirmpassword) || $confirmpassword == "") {
		$errors[] = _l_fill_confirm_password;
	}
	if (strlen($password) <6) {
		$errors[] = _l_error_pass_length;
	}
	if (!empty($image) || $image !="") {
		if (in_array($image_ext, $allowed_ext) === false) {
			$errors[] = _l_only_image;
		}
		if ($image_size > 2097152) {
			$errors[] = _l_image_size;
		}			
	}
	if (empty($image)) {
		$image="boy.jpg";
	}
	if (empty($errors)) {
		move_uploaded_file($image_tmp, "uploads/images/users/{$image}");
		$query = "INSERT INTO `users`(`username`,`email`,`password`,`firstname`,`lastname`,`image`,`token`,`registered_date`) VALUES ('$username','$email','$password','$firstname','$lastname','$image','$token',now())";

		$execute = mysqli_query($connection, $query);
		confirmQuery($execute);
		$last_id = mysqli_insert_id($connection);
		$name = $firstname." ".$lastname;
		$mail->addAddress($email, $name); 

	    $mail->Subject = 'Complete your registration account!';
	    $mail->Body    = "<h3>To complete your registration account please click on the link below!</h3>
	    <a href='http://localhost/blog/?source=confirm+registration&email=$email&token=$token'><h2>Verify Account</h2></a>";

	    if ($mail->send()==true) {
	    	$token = "Q1w2er36tAyQ8WS6D0gFG9CYj6h9hYg4FdJ2oL8gVI4c7PgD9qS0zM6B4";
			$token = str_shuffle($token);
			$update_serials_query = "UPDATE settings SET serials='$token'";
			$execute_update_serials = mysqli_query($connection, $update_serials_query);
			$encode = urlencode('goto email account');
	        header("Location: ?source={$encode}&serials={$token}");
	    }
	    else {
	        $query = "DELETE FROM `users` WHERE id='$last_id'";
	        $execute = mysqli_query($connection,$query);
	        $errors[] = _l_unable_to_create;
	    }
	}
	else{
		$errors[] = _l_some_problem_happen;
	}
}
?>
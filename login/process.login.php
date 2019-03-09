<?php 
 
 if (isset($_POST['login'])) {
 	$errors = array();
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	if (empty($username) || empty($password) || $username === "" || $password === "") {
 		$errors[] = 'Please fill both username & password field!';
 	}
 	else {
 		$query = "SELECT * FROM users WHERE username='$username' OR phone='$username' OR email='$username'";
 		$execute_query = mysqli_query($connection, $query);
 		if (mysqli_num_rows($execute_query)!=0) {
 			while ($rows = mysqli_fetch_array($execute_query)) {
 			    $db_id = $rows['id'];
 			    $db_role = $rows['role'];
 			    $db_username = $rows['username'];
 			    $db_phone = $rows['phone'];
 			    $db_email = $rows['email'];
 			    $db_password = $rows['password'];
 			    $db_emailVerified = $rows['emailVerified'];
 			    $db_status = $rows['status'];
 			    if (($username === $db_username || $username === $db_email || $username === $db_phone) && password_verify($password, $db_password)) {
 			    	if ($db_emailVerified == 1 && $db_status == 1) {
	 			    	if (!isset($_SESSION['id']) && $_SESSION['id'] === null) {
	 			    		$_SESSION['id'] = $db_id;
	 			    		$_SESSION['role'] = $db_role;
	 			    		if ($_SESSION['role'] === 'admin') {
	 			    			header('Location: admin/');
	 			    		}
	 			    		else {
	 			    			header('Location: users/');
	 			    		}
	 			    	}
	 			    	else {
	 			    		header('Location: login/logout.php');
	 			    	}
	 			    }//email verification if statement
	 			    else {
	 			    	$errors[] = "<span class='text-danger'><i class='fa fa-envelope-o'></i></span> Your email address is not verfied! <br> Please go to your email and verify your information!";
	 			    }
 			    }
 			    else {
 			    	$errors[] = "<span class='text-danger'><i class='fa fa-warning'></i></span> Wrong account information!";
 			    }
 			}
 		}
 		else {
 			$errors[] = "<span class='text-danger'><i class='fa fa-warning'></i></span> No user registered with <span class='text-primary'>{$username}</span>";
 		}
 	}
 }

?>
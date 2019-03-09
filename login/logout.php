<?php 
	session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] !== null) {
	$_SESSION['id'] = null;
	$_SESSION['role'] = null;
	session_destroy();
	password_hash('password', PASSWORD_BCRYPT, array('cost'=>15));
	if (session_status()===PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['lang']='en';
	header('Location: ../index.php');
}
else {
	header('Location: ../index.php');
}
?>
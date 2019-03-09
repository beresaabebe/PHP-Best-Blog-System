<?php ob_start(); ?>
<?php 

	function confirmQuery($query){
		global $connection;
		if (!$query) {
			die('Query failed. '.mysqli_error($connection));
		}
	}
	/*
	* Redirect to some other location
	*/
	function Redirect_To($location){
		ob_start();
		header('Location: '.$location);
	}

	function Login()
	{
		if (isset($_SESSION['id'])) {
			return true;
		}
	}

	function Confirm_Login(){
		if (!Login()) {
			Redirect_To('../');
		}
	}
	/*
	* Format the date
	*/
	function formatDate($date){
		return date('F j, Y, g:i a',strtotime($date));
	}
	/*
	* shorten post content
	*/
	function shortenText($text, $chars=250){
		$text = $text. " ";
		$text = mb_substr($text,0,$chars);
		$text = $text. "...";
		return $text;
	}

	/*
	*chinese character shortening
	*/
	function cnShortText($string){
		if (strlen($string)>50) {
			$text = mb_substr($string, 0, 50, 'UTF-8')."...";
			return $text;
		}
	}

?>
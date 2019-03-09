 <?php
 if (session_status() == PHP_SESSION_NONE) {
 	session_start();
 }
$session = (isset($_SESSION['lang'])) ? true:false;
return (($session == true) && ($_SESSION['lang']=='cn')) ? include_once 'lang_cn.php': include_once 'lang_en.php' ;
?>
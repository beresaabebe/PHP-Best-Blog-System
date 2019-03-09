<?php 
	if ((isset($_POST['search_btn']) && $_POST['search'] !="") || (isset($_POST['searchnew_btn']) && $_POST['searchnew'] !='')) {
		$search = $_POST['search'];
	?>
	<?php include_once 'search.header.php'; ?>
<?php }
else {
 	header("Location:?source=home");
 } ?>
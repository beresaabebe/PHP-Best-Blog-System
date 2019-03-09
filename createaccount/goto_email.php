<?php 
if (isset($_GET['serials'])) {
	$serials = $_GET['serials'];
	if (strlen($serials)<57 || strlen($serials)>57) {
		$str = strlen($serials);
		header("Location:?source=home&strlen={$str}");
	}
	$query = "SELECT * FROM settings WHERE serials='$serials'";
	$execute = mysqli_query($connection, $query);
	if (mysqli_num_rows($execute)==0) {
		header("Location:?source=home&strlen={$str}");
	}
	else {
		?>
		<div class="row">
			<div class="col-lg-9 offset-lg-2 my-lg-3">
				<div class="car">
					<div class="card-header">
						<h4 class="card-title"><?php echo _l_succus_account_created; ?></h4>
					</div>
					<div class="card-body">
						<p class="alert alert-primary"><?php echo _l_successfully_created; ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
else{
	header("Location:?source=home");
}
?>
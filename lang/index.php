<?php session_start(); ?>
<?php include_once 'define_lang.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo _l_title; ?></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-4 col-lg-6" style="margin-top: 50px;">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span><a href="switch_lang.php?lang=1" class="btn btn-link"><?php echo _l_lang_1; ?></a></span>
						<span><a href="switch_lang.php?lang=2" class="btn btn-link"><?php echo _l_lang_2; ?></a></span>
					</div>
					<div class="panel-body">
						<span><a href=""><?php echo _l_home; ?></a></span> |
						<span><a href=""><?php echo _l_about; ?></a></span> |
						<span><a href=""><?php echo _l_contact; ?></a></span> |
						<span><a href=""><?php echo _l_feedback; ?></a></span> |
					</div>			
				</div>	
			</div>
		</div>
	</div>
</body>
</html>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark mt-2">
    <div class="container-fluid">
    	<a href="index.php" class="navbar-brand"><?php echo _l_njcit,' ',_l_blog; ?></a>
    	<button type="" class="navbar-toggler" data-toggle="collapse" data-target="#navBar">
    		<span class="navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navBar">
    		<ul class="navbar-nav ml-auto">
    		    <li class="nav-item">
    		    	<a class="nav-link" href="index.php"><?php echo ucfirst(_l_home); ?></a>
    		    </li>
    		    <li class="nav-item">
    		    	<a class="nav-link" href=""><?php echo ucfirst(_l_about); ?></a>
    		    </li>
    		    <li class="nav-item">
    		    	<a class="nav-link" href=""><?php echo ucfirst(_l_services); ?></a>
    		    </li>
    		    <li class="nav-item">
    		    	<a class="nav-link" href=""><?php echo ucfirst(_l_contact); ?></a>
    		    </li>
<?php 
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
	if ($_SESSION['role'] == 'admin') {
		?>
					<li class="nav-item">
	    		    	<a class="nav-link" href="admin/"><?php echo ucfirst(_l_admin); ?></a>
	    		    </li>
		<?php
	}
	else {
		?>
					<li class="nav-item">
	    		    	<a class="nav-link" href="users/"><?php echo ucfirst(_l_users); ?></a>
	    		    </li>
		<?php
	}
}
else {
?>
				<li class="nav-item">
    		    	<a class="nav-link" href="?source=<?php echo urlencode('login') ?>"><?php echo ucfirst(_l_login); ?></a>
    		    </li>
	<?php
}
?>	    		    	
    		    <li class="nav-item">
		            <a href="lang/switch_lang.php?lang=cn" class="nav-link"><?php echo _l_lang_1; ?></a>
		        </li>
	            <li>
	            	<a href="lang/switch_lang.php?lang=en" class="nav-link"><?php echo _l_lang_2; ?></a>
	          </li>    		    
    		</ul>
    	</div>
    </div>
</nav>
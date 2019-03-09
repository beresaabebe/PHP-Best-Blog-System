<div class="row">
	<div class="col-lg-9 offset-lg-2 mt-5">
		<form action="?source=search" method="post" accept-charset="utf-8">
			<div class="form-group">
				<label for="seearch" class="sr-only">Search</label>
				<div class="input-group">
					<input type="text" name="searchnew" class="form-control" value="<?php if(isset($_POST['search'])) { echo $_POST['search'];} else { echo $_POST['searchnew'];} ?>">
					<div class="input-group-append">
						<button type="submit" name="searchnew_btn" class="btn btn-secondary"><i class="fa fa-search"></i> <span class="sr-only">Search</span></button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-lg-9 offset-lg-2">
		<nav class="navbar navbar-expand-xl navbar-light bg-light my-2">
		    <div class="container-fluid">
		    	<button type="" class="navbar-toggler" data-toggle="collapse" data-target="#searchNav"><span class="navbar-toggler-icon"></span></button>
		    	<div class="collapse navbar-collapse" id="searchNav">
		    		<ul class="navbar-nav">
		    		    <li class="nav-item">
		    		    	<a href="" title="All" class="nav-link active">All</a>
		    		    </li>
		    		    <li class="nav-item">
		    		    	<a href="" title="" class="nav-link">Posts</a>
		    		    </li>
		    		    <li class="nav-item">
		    		    	<a href="" title="" class="nav-link">Categories</a>
		    		    </li>
		    		    <li class="nav-item">
		    		    	<a href="" title="" class="nav-link">Authors</a>
		    		    </li>
		    		    <li class="nav-item">
		    		    	<a href="" title="Photos" class="nav-link">Photos</a>
		    		    </li>
		    		    <li class="nav-item">
		    		    	<a href="" title="Videos" class="nav-link">Videos</a>
		    		    </li>
		    		</ul>
		    	</div>
		    </div>
		</nav>
	</div>
</div>
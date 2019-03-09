<?php include_once 'lang/define_lang.php'; ?>
<div class="row">
<?php 
if (isset($_GET['post'])) {
	$id = $_GET['post'];	
	if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
		$query = "SELECT * FROM posts WHERE id='$id'";
	}
	else {
		$query = "SELECT * FROM cn_posts WHERE id='$id'";
	}
	$execute = mysqli_query($connection, $query);
	confirmQuery($execute);
	if (mysqli_num_rows($execute)!=0) {
		$row = mysqli_fetch_array($execute);
	    $post_id = $row['id'];
		$post_title = $row['post_title'];
	    $post_content = $row['post_content'];
	    $post_image = $row['post_image'];
	    $post_created_date = $row['created_date'];
	    $post_created_by_id = $row['created_by_id'];
	    $post_updated_date = $row['updated_date'];
	    $post_updated_by_id = $row['updated_by_id'];
	    $post_category_id = $row['post_category_id'];

	if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
		$cat_query = "SELECT * FROM categories WHERE id='$post_category_id'";
	}
	else {
		$cat_query = "SELECT * FROM cn_categories WHERE id='$post_category_id'";
	}
	$execute_cat = mysqli_query($connection, $cat_query);
	$cat = mysqli_fetch_array($execute_cat);
	$cat_id = $cat['id'];
	$cat_name = $cat['category_name']; 

	$author_query = "SELECT * FROM users WHERE  id='$post_created_by_id'";
	$execute_author_query = mysqli_query($connection, $author_query);
	$author = mysqli_fetch_array($execute_author_query);
	$author_id = $author['id'];
	$author_fname = $author['firstname'];
	$author_lname = $author['lastname'];  
	?>
	    <div class="col-lg-9 offset-lg-2">      
	    	<div class="car">
	    		<div class="card-header">    		
		    		<div class="card-title">
		    			<h4><?php echo $post_title; ?></h4>
		    		</div>
		    	</div>
		    	<div class="card-img-top">
	<?php 
	if (!empty($post_image)) {
	    ?>
	                <center><img src="uploads/images/posts/<?php echo $post_image; ?>" class="rounded-top card-img">
	                </center>
	    <?php
	}
	?>                
		    	</div>
		    	<div class="card-body">
		    		<p class="card-text"><?php echo $post_content; ?></p>
		    	</div>
		    	<div class="card-footer">
		    		<p><i class="fa fa-folder-open-o"></i> <?php echo ucfirst(_l_categories); ?> >><a href="?source=<?php echo urlencode('categories'); ?>&categories=<?php echo $cat_id; ?>"><?php echo ucfirst($cat_name); ?></a>&nbsp;&nbsp;&nbsp; <i class="fa fa-user"></i> <?php echo ucfirst(_l_author); ?> >> <a href="?source=<?php echo urlencode('author'); ?>&author=<?php echo $author_id; ?>"><?php echo ucfirst($author_fname.' '.$author_lname); ?></a></p>
		    	</div>
	    	</div>
	    </div>


	<?php if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	} ?>
	<?php if (isset($_POST['comment_btn'])) {
	    if (isset($_SESSION['id']) && $_SESSION['id'] !=null || $_SESSION['id'] !="") {
	        $errors = array();   

	        $comment_author_id = $_SESSION['id'];  
	        $comment_content = $_POST['comment'];
	        $comment_post_id = $_GET['post'];

	        $comment_content = mysqli_real_escape_string($connection, $comment_content);
	        if (empty($comment_content) || $comment_content =="") {
	            $errors[] = 'Say something to submit a comment!';
	        }
	        else {
	            $comment_author_email_query = "SELECT email FROM users WHERE id='$comment_author_id'";
	            $execute_comment_author_email = mysqli_query($connection, $comment_author_email_query);
	            $row_email = mysqli_fetch_array($execute_comment_author_email);
	            $comment_author_email = $row_email['email'];

	            $query = "SELECT created_by_id FROM posts WHERE id='$comment_post_id'";
	            $execute = mysqli_query($connection, $query);
	            $row = mysqli_fetch_array($execute);
	            $comment_post_creater_id = $row['created_by_id'];
	// $sql = "INSERT INTO `comments`(`comment_post_id`, `comment_post_creater_id`, `comment_author_id`, `comment_author_email`, `comment_status`, `comment_content`, `comment_created_date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])";
	            $insert_comment_query = "INSERT INTO `comments`(`comment_post_id`,`comment_post_creater_id`, `comment_author_id`, `comment_author_email`, `comment_content`, `comment_created_date`) VALUES ('$comment_post_id','$comment_post_creater_id','$comment_author_id','$comment_author_email','$comment_content',now())";
	            mysqli_set_charset($connection, 'utf-8');
	            $create_comment = mysqli_query($connection,$insert_comment_query);
	            confirmQuery($create_comment);
	            $success = _l_comments_success;
	        }
	    }
	    else {
	        echo "<script>
	    alert('Please login or register and give us a comment! 请登录或注册并给我们评论！');
	    window.location.href='?source=login';
	    </script>";
	    }
	} 
	?>

	    <div class="col-lg-9 offset-lg-2 mt-4 mb-4">
	<?php 
	    if (!empty($errors) && $errors !="") {
	        foreach ($errors as $error) {
	            echo "<p class='alert alert-danger'><span class='text-danger'><i class='fa fa-warning'></i></span> {$error}</p>";
	        }
	    }
	    if(isset($success)) {
	        echo "<p class='alert alert-success'><span class='text-success'><i class='fa fa-check'></i> {$success}</p>";
	    }
	?>          
	    	<div class="card card-success">
	    		<div class="card-header">
	    			<h4 class="card-title text-success"><i class="fa fa-comment"></i> <?php echo _l_leave_comment; ?></h4>
	    		</div>
	    		<div class="card-body">
	    			<form action="?source=<?php echo urlencode('read more'); ?>&post=<?php echo $post_id; ?>" method="post" accept-charset="utf-8">
	    				<div class="form-group">
	    					<textarea name="comment" class="form-control" rows="7" placeholder="<?php echo _l_comment_placeholder; ?>"></textarea>
	       				</div>
	       				<div class="form-group">
	       					<button type="submit" name="comment_btn" class="btn btn-outline-success"><span class="text-success"><i class="fa fa-check"></i></span> <?php echo ucfirst(_l_submit); ?></button>
	       				</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
	    <!-- end of create comment -->

	        <!-- Comment -->
	        <div class="col-lg-9 offset-lg-2 my-lg-3">
	          <div class="panel panel-default">            
	            <div class="panel-body">
	<?php 
	$post_id = $_GET['post'];
	$get_comment_query = "SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status=1";
	  mysqli_set_charset($connection, 'utf-8');
	  $get_comment_query_execute = mysqli_query($connection,$get_comment_query);
	confirmQuery($get_comment_query_execute);
	while ($comment = mysqli_fetch_array($get_comment_query_execute)) {
	    $comment_author_id = $comment['comment_author_id'];
	$get_comment_author = "SELECT * FROM users WHERE id='$comment_author_id'";
	$get_author_execute = mysqli_query($connection, $get_comment_author);
	$get_author = mysqli_fetch_array($get_author_execute);
	$author_firstname = $get_author['firstname'];
	$author_lastname = $get_author['lastname'];
	$image = $get_author['image'];

	    $comment_content = $comment['comment_content'];
	    $comment_date = $comment['comment_created_date'];
	?>
	              <img class="pull-left img img-circle form-inline" style="width: 50px; height: 50px;" src="uploads/images/users/<?php echo $image; ?>" alt="<?php echo $image; ?>">
	              <h5><strong><?php echo ucfirst($author_firstname)." ".ucfirst($author_lastname); ?></strong> <span class="pull-lg-7"><?php echo date('F,Y',strtotime(formatDate($comment_date))); ?></span></h5>
	              <?php echo $comment_content; ?>
	          <hr>
	<?php
	}
	?>            
	                </div>
	              </div>
	            </div>
	            <!-- end comment display -->
	    <?php
	}
	else {
		$encode = urlencode('home');
		header("Location: ?source={$encode}");
	} //end of else no post
} // end of if $_GET statement
else {
	$encode = urlencode('home');
	header("Location: ?source={$encode}");
}
?>   
</div>

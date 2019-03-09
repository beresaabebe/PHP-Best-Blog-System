        <div class="col-lg-3">
          <div class="row">
            <div class="col-lg-12">
              <form action="post.search.php" method="get" accept-charset="utf-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3><?php echo _l_search; ?></h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <input type="text" name="search" placeholder="<?php echo _l_search_here; ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
              </form>                
            </div>
<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
  $query = "SELECT * FROM posts WHERE post_status!=0 ORDER BY updated_date DESC LIMIT 1";
}
else {
  $query = "SELECT * FROM cn_posts WHERE post_status!=0 ORDER BY updated_date DESC LIMIT 1";
}
$execute_single_post = mysqli_query($connection, $query);
confirmQuery($execute_single_post);
if (mysqli_num_rows($execute_single_post)!=0) {
$row = mysqli_fetch_array($execute_single_post);
$id = $row['id'];
$post_title = $row['post_title'];
$post_content = $row['post_content'];
$post_image = $row['post_image'];
?>              
            <div class="col-lg-12">            
              <div class="panel panel-default">
<?php 
if (!empty($post_image)) {
  ?>
                  <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $id; ?>"><img class="img img-responsive" src="../uploads/images/posts/<?php echo $post_image; ?>" alt=""></a>
  <?php
}
?> 
                <div class="panel-body">
                  <h4 class="card-title">
                    <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $id; ?>"><?php echo $post_title; ?></a>
                  </h4>
                  <p class="card-text">
<?php 
if (strlen($post_content)>250) {
  $post_content = substr($post_content, 0,250)."...";
  echo $post_content;
}
else {
  echo $post_content;
}
?>                   <a href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $id; ?>"> Read more</a>
                  </p>
                </div>
              </div>
            </div>
<?php 
}
?>

<?php 
if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
  $query = "SELECT * FROM categories";
}
else {
  $query = "SELECT * FROM cn_categories";
}
$get_category = mysqli_query($connection, $query);
if (mysqli_num_rows($get_category)!=0) {
?>

            <!-- Categories Widget -->
            <div class="col-lg-12">
              <div class="panel panel-default">
                <h5 class="panel-heading"><?php echo _l_categories; ?></h5>
                <div class="panel-body">
                  <div class="row">
<?php 
while ($row = mysqli_fetch_array($get_category)) {
  $category_id = $row['id'];
  $category_name = $row['category_name'];   

  ?>
                    <div class="col-lg-6">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
                        </li>
                      </ul>
                    </div>
  <?php
}
?>                    
                  </div>
                </div>
              </div>
            </div>
<?php } ?>            
          </div>
            
            <?php 
$setting_query = "SELECT * FROM settings";
$execute_setting = mysqli_query($connection,$setting_query);
confirmQuery($execute_setting);
$setting = mysqli_fetch_array($execute_setting);
if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
  $daily_news_title = $setting['daily_news_title'];
  $daily_news_content = $setting['daily_news_content'];  
}
else {
  $daily_news_title = $setting['cn_daily_news_title'];
  $daily_news_content = $setting['cn_daily_news_content'];
}
?>        
          <!-- Side Widget -->
<?php 
  if (!empty($daily_news_title) && !empty($daily_news_content)) { 
?>           
          <!-- <div class="col-lg-12"> -->
          <div class="panel panel-default"">           
            <div class="panel-heading">
              <h5>
<?php             
if (strlen($daily_news_title)>20) {
  ?>
  <marquee onmouseover="this.setAttribute('scrolldelay', 600)" 
  onmouseout="this.setAttribute('scrolldelay', 500)" truespeed = "true" scrolldelay = "200"><?php echo $daily_news_title; ?></marquee>
  <?php
}
else {
  echo $daily_news_title;
}
               ?></h5>              
            </div>
            <div class="panel-body"  style="padding-bottom: 50px;>
              <marquee direction="up" scrolldelay="500" onmouseover="this.setAttribute('scrolldelay', 600)" onmouseout="this.setAttribute('scrolldelay', 500)" truespeed = "true"><?php echo $daily_news_content; ?></marquee>
            </div>
          </div>
          <!-- </div>  -->
<?php } ?>          
                 
<?php 
$user_id = $_SESSION['id'];
$user_query = "SELECT * FROM `users` WHERE `id`='$user_id'";
$execute_user = mysqli_query($connection, $user_query);
confirmQuery($execute_user);
$rows = mysqli_fetch_array($execute_user);
$firstname = $rows['firstname'];

$id = $_SESSION['id'];
if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
  $query = "SELECT * FROM `categories` WHERE created_by_id='$id' ORDER BY id DESC LIMIT 5 ";
}
else {
  $query = "SELECT * FROM `cn_categories` WHERE created_by_id='$id' ORDER BY id DESC LIMIT 5 ";
}
$execute = mysqli_query($connection,$query);
confirmQuery($execute);
if (mysqli_num_rows($execute)!=0) {
?>                  
          <!-- Categories Widget -->
          <div class="panel panel-default">
            <div class="panel-heading">             
              <h5><?php echo _l_your_top_categories; ?> <?php echo ucfirst($firstname); ?></h5>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled mb-0">
<?php 
$count_cat = mysqli_num_rows($execute);
if ($count_cat>0) {
  while ($row = mysqli_fetch_array($execute)) {
    $cat_id = $row['id'];
    $cat_name = $row['category_name'];
    if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
      $query_check = "SELECT * FROM posts WHERE post_category_id='$cat_id' AND post_status=1";
    }
    else {
      $query_check = "SELECT * FROM cn_posts WHERE post_category_id='$cat_id' AND post_status=1";
    }
    $query_check_execute = mysqli_query($connection,$query_check);
    confirmQuery($query_check_execute);
    $count_post = mysqli_num_rows($query_check_execute);
    
  ?>  
                    <li>
                      <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $cat_id; ?>" title="<?php echo $cat_name; ?>"><?php echo $cat_name; ?> (<?php echo $count_post; ?>)</a>
                    </li>
    <?php
  }
}
else {
            ?>      <li>
                      <p class="lead text-danger"><?php echo _l_no_category; ?></p>
                    </li>
<?php
}
?>
              </ul>
            </div>
          </div>
<?php } ?>          

<?php 
  $id = $_SESSION['id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "SELECT * FROM `categories` ORDER BY id DESC LIMIT 5 ";
  }
  else {
    $query = "SELECT * FROM `cn_categories` ORDER BY id DESC LIMIT 5 ";
  }
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $count_top_5 = mysqli_num_rows($execute);
  if ($count_top_5>0) {
?>

          <div class="panel panel-default">
            <div class="panel-heading">
              <h5><?php echo _l_top_categories; ?></h5>              
            </div>
            <div class="panel-body">
              <ul class="list-unstyled mb-0">
<?php 
  while ($row = mysqli_fetch_array($execute)) {
    $cat_id = $row['id'];
    $cat_name = $row['category_name'];

    $query_check = "SELECT * FROM posts WHERE post_category_id='$cat_id' AND post_status=1";
    $query_check_execute = mysqli_query($connection,$query_check);
    confirmQuery($query_check_execute);
    $count_top_5_all = mysqli_num_rows($query_check_execute);
    
  ?>                
                <li>
                  <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $cat_id; ?>" title="<?php echo $cat_name; ?>"><?php echo $cat_name; ?> (<?php echo $count_top_5_all; ?>)</a>
                </li>
<?php 
  }
?>                
              </ul>
            </div>
          </div>
<?php } ?>          

<?php 
  $id = $_SESSION['id'];
  if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
    $query = "SELECT * FROM `categories` ORDER BY id";
  }
  else {
    $query = "SELECT * FROM `cn_categories` ORDER BY id";
  }
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $count_all = mysqli_num_rows($execute);
  if ($count_all>0) {
?>
          <!-- All categories -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5><?php echo _l_all_categories; ?></h5>              
            </div>
            <div class="panel-body">
              <ul class="list-unstyled mb-0">
<?php 
  while ($row = mysqli_fetch_array($execute)) {
    $cat_id = $row['id'];
    $cat_name = $row['category_name'];

    if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') {
      $query_check = "SELECT * FROM posts WHERE post_category_id='$cat_id' AND post_status=1";
    }
    else {
      $query_check = "SELECT * FROM cn_posts WHERE post_category_id='$cat_id' AND post_status=1";
    }
    $query_check_execute = mysqli_query($connection,$query_check);
    confirmQuery($query_check_execute);
    $count_all_post = mysqli_num_rows($query_check_execute);
    
  ?>                
                <li>
                  <a href="index.php?source=<?php echo urlencode('read all of this category posts'); ?>&category_id=<?php echo $cat_id; ?>" title="<?php echo $cat_name; ?>"><?php echo $cat_name; ?> (<?php echo $count_all_post; ?>)</a>
                </li>
<?php 
  }
?>                
              </ul>
            </div>
          </div>
<?php } ?>          
        </div>

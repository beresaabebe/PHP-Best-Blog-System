 <nav class="navbar bg-primary">
  <div class="container-fluid" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="navbar-header  text-white text-center">
      <a style="color: white;" class="navbar-brand" href="#"><?php echo _l_topic; ?></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="background-color:  gray;">
      <span class="sr-only"><?php echo _l_toggle_nav; ?></span>
      <span class="icon-bar" style="background-color: white;"></span>
      <span class="icon-bar" style="background-color: white;"></span>
      <span class="icon-bar" style="background-color: white;"></span>
    </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a title="<?php echo _l_home; ?>" style="color: black; " href="index.php?source=<?php echo urlencode('home'); ?>"><i class="fa fa-home"></i>  <?php echo _l_home; ?></a></li>
        <li><a title="<?php echo _l_posts; ?>" style="color: black;" href="index.php?source=<?php echo urlencode('all posts :- including published and draft post'); ?>"><i class="fa fa-pencil"></i> <?php echo _l_posts; ?></a></li>
        <li><a title="<?php echo _l_categories; ?>" style="color: black;" href="index.php?source=<?php echo urlencode('view all categories or add another'); ?>"><i class="fa fa-folder-open-o"></i> <?php echo _l_categories; ?></a></li>
        <li><a title="<?php echo _l_comments; ?>" style="color: black;" href="index.php?source=<?php echo urlencode('view all created comments including approved and unapproved comments'); ?>"><i class="fa fa-comments-o"></i> <?php echo _l_comments; ?></a></li>
        <li><a title="<?php echo _l_profile; ?>" style="color: black;" href="index.php?source=<?php echo urlencode('view profile user'); ?>"><i class="fa fa-user"></i> <?php echo _l_profile; ?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a title="<?php echo _l_main_home; ?>" style="color: black;" href="../"><i class="fa fa-home"></i></span> <?php echo _l_home; ?></a></li>
        <li><a title="<?php echo _l_logout; ?>" style="color: black;" href="../login/logout.php"><i class="fa fa-sign-in"></i></span> <?php echo _l_logout; ?></a></li>
      </ul>
    </div>
  </div>
</nav>
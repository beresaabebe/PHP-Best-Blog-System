  <div class="container-fluid">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo _l_number_of_comments; ?></h3>
            </div>
            <!-- /.box-header -->
            <div style="overflow-x: scroll;" class="box-body">
              <table id="example1" class="table table-striped table-hover table-responsive">
                <thead>
                <tr>
	                <th><?php _l_srno; ?></th>
  		            <th><?php echo _l_author; ?></th>
  		            <th><?php echo _l_email; ?></th>
                  <th><?php echo _l_content; ?></th>
                  <th><?php echo _l_on_post; ?></th>
  		            <th><?php echo _l_status; ?></th>
  		            <th><?php echo _l_approved; ?></th>
  		            <th><?php echo _l_unapproved; ?></th>
  		            <th><?php echo _l_view; ?></th>
  		            <th><?php echo _l_delete; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 
// $id = $_SESSION['id'];
$srno=0;
$id = $_SESSION['id'];
$query = "SELECT * FROM comments WHERE comment_post_creater_id='$id'";
$execute = mysqli_query($connection,$query);
confirmQuery($execute);
$count_row = mysqli_num_rows($execute);
if ($count_row>0) {
  while ($row = mysqli_fetch_array($execute)) {

    $comment_id = $row['id'];
    $comment_content = $row['comment_content'];

    $comment_author_id = $row['comment_author_id'];
$comment_author_query = "SELECT * FROM users WHERE id='$comment_author_id'";
$get_author = mysqli_query($connection,$comment_author_query);
confirmQuery($get_author);
$row1 = mysqli_fetch_array($get_author);
$author_firstname = $row1['firstname'];
$author_lastname = $row1['lastname'];

    $comment_email = $row['comment_author_email'];
$comment_email_query = "SELECT email FROM users WHERE email='$comment_email'";
$get_email = mysqli_query($connection,$comment_email_query);
confirmQuery($get_email);
$row2 = mysqli_fetch_array($get_email);
$email = $row2['email'];

    $comment_post_id = $row['comment_post_id'];
$post_query = "SELECT post_title,post_content FROM posts WHERE id='$comment_post_id'";
$get_post_query = mysqli_query($connection,$post_query);
confirmQuery($get_post_query);
$row3 = mysqli_fetch_array($get_post_query);
$post_title = $row3['post_title'];
$post_content = $row3['post_content'];

    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_created_date'];
    $srno++;
?>
<tr title="This comment is created by: <?php echo ucfirst($author_firstname).' '.ucfirst($author_lastname); ?> on: <?php echo date('M,Y',strtotime(formatDate($comment_date))); ?>">
  <td><?php echo $srno; ?></td>
  <td><?php echo ucfirst($author_firstname)." ".ucfirst($author_lastname); ?></td>
  <td><?php echo $email; ?></td>
  <td title="<?php echo $comment_content; ?>"><?php if (strlen($comment_content)>20) {
    $comment_content = substr($comment_content,0,19)."...";
  } echo $comment_content; ?></td>
  <td><?php if (strlen($post_title)>20) {
    $post_title = substr($post_title,0,19)."...";
  } echo $post_title; ?></td>
  <?php 
    if ($comment_status === '1') {
      ?>
  <td class="text-success"><?php echo lcfirst(_l_approved); ?></td>
    <?php
    }
    else {
      ?>
  <td style="color:red"><?php echo lcfirst(_l_unapproved); ?></td>
      <?php
    }
  ?>
  <td><a class="btn btn-success btn-xs" href="index.php?source=<?php echo urlencode('view all created comments including approved and unapproved comments');?>&approve=<?php echo $comment_id; ?>" title="Do you want to approve this comment?"><i class="fa fa-check-square-o"></i> <?php echo _l_approve; ?></a></td>
  <td><a class="btn btn-warning btn-xs" href="index.php?source=<?php echo urlencode('view all created comments including approved and unapproved comments'); ?>&unapprove=<?php echo $comment_id; ?>" title="Do you want to unapprove this comment?"><i class="fa fa-times-circle"></i> <?php echo _l_unapprove; ?></a></td>
  <td><a class="btn btn-primary btn-xs" href="index.php?source=<?php echo urlencode('reading more details of post'); ?>&post_id=<?php echo $comment_post_id; ?>" title="View"><i class="fa fa-vimeo"></i> <?php echo _l_view; ?></a></td> 
  <td><a class="btn btn-xs btn-danger" href="index.php?source=<?php echo urlencode('view all created comments including approved and unapproved comments'); ?>&delete=<?php echo $comment_id; ?>" title="Do you want to delete this comment?"><i class="fa fa-remove"></i> <?php echo _l_delete; ?></a></td>
</tr>

    <?php
  } 
}

?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php _l_srno; ?></th>
                  <th><?php echo _l_author; ?></th>
                  <th><?php echo _l_email; ?></th>
                  <th><?php echo _l_content; ?></th>
                  <th><?php echo _l_on_post; ?></th>
                  <th><?php echo _l_status; ?></th>
                  <th><?php echo _l_approved; ?></th>
                  <th><?php echo _l_unapproved; ?></th>
                  <th><?php echo _l_view; ?></th>
                  <th><?php echo _l_delete; ?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
  </div>
</section>
</div>

<!-- To approve comments -->
<?php 
if (isset($_GET['approve'])) {
  $comment_id = $_GET['approve'];
  $query = "SELECT comment_status FROM comments WHERE id='$comment_id'";
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $row = mysqli_fetch_array($execute);
  $comment_status = $row['comment_status'];
  if ($comment_status === 1) {
    ?>
<script type="text/javascript">
  alert('This comment is already approved!');
</script>
    <?php
  }
  else {
    $query = "UPDATE comments SET comment_status=1 WHERE id='$comment_id'";
    $execute = mysqli_query($connection,$query);
    confirmQuery($execute);
    $encode =urlencode('view all created comments including approved and unapproved comments');
    header('index.php?source='.$encode);
  }
}
?>


<!-- To unapprove -->
<?php 
if (isset($_GET['unapprove'])) {
  $comment_id = $_GET['unapprove'];
  $query = "SELECT comment_status FROM comments WHERE id='$comment_id'";
  $execute = mysqli_query($connection,$query);
  confirmQuery($execute);
  $row = mysqli_fetch_array($execute);
  $comment_status = $row['comment_status'];
  if ($comment_status === 1) {
    ?>
<script type="text/javascript">
  alert('This comment is already unapproved!');
</script>
    <?php
  }
  else {
    $query = "UPDATE comments SET comment_status=0 WHERE id='$comment_id'";
    $execute = mysqli_query($connection,$query);
    confirmQuery($execute);
    $encode = urlencode('view all created comments including approved and unapproved comments');
    Redirect_To('index.php?source='.$encode);
  }
}
?>

<!-- To delete posts -->
<?php 
if (isset($_GET['delete'])) {
  $post_id = $_GET['delete'];
  $query = "DELETE FROM comments WHERE id='$post_id'";
  $execute = mysqli_query($connection, $query);
  confirmQuery($execute);
  $encode = urlencode('view all created comments including approved and unapproved comments');
  Redirect_To('index.php?source='.$encode);
}
?>
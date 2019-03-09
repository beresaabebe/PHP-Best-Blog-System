<?php 
  if (isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
$execute = mysqli_query($connection, $query);
confirmQuery($execute);
    $row = mysqli_fetch_array($execute);

    $firstname = $row['firstname'];
    $lastname = $row['lastname'];

    $address = $row['address'];
    $email = $row['email'];
    $phone = $row['phone'];

    $username = $row['username'];
    $image = $row['image'];
    $profession = $row['profession'];

    $status = $row['status'];
    $role = $row['role'];
    $gender = $row['gender'];
    $registered_date = $row['registered_date'];

?>
<div class="container-fluid">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box panel panel-success">
            <div class="box-header">
              <h3 class="box-title"><?php echo $firstname." ".$lastname; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-3">
<?php 
if (!empty($image)) {
  ?>
                  <img class="img img-thumbnail" src="../uploads/images/users/<?php echo $image; ?>" alt="<?php echo $image; ?>">
  <?php
}
else {
  ?>
                  <img class="img img-thumbnail" src="../uploads/images/users/boy.jpg">
  <?php
}
?>                  
                </div>
                <div class="col-lg-4">
                  <div class="panel panel-default">
                    <div class="panel-footer">
                      <h4><?php echo $firstname." ".$lastname; ?></h4>
                    </div>
                    <div class="panel-body">
                      <span><?php echo _l_username; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo $username; ?>" class="btn btn-default col-lg-pull-2" disabled></span><br><br>
                      <span><?php echo _l_email; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo $email; ?>" class="btn btn-default col-lg-pull-2" disabled></span><br><br>
                      <span><?php echo _l_phone; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo $phone; ?>" class="btn btn-default col-lg-pull-2" disabled></span><br><br>
                      <span><?php echo _l_status; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php if($status == 1){echo _l_allowed_user;} else {echo _l_blocked_user;} ?>" class="btn btn-default col-lg-pull-2" disabled></span><br><br>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="panel panel-default">
                    <div class="panel-footer">
                      <h4><?php echo ucfirst($username); ?></h4>
                    </div> 
                    <div class="panel-body">
                       <span><?php echo _l_profession; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo $profession; ?>" class="btn btn-default col-lg-pull-2" disabled>
                    </span><br><br>
                    <span><?php echo _l_role; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo $role; ?>" class="btn btn-default col-lg-pull-2" disabled>
                    </span><br><br>
                    <span><?php echo _l_gender; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo $gender; ?>" class="btn btn-default col-lg-pull-2" disabled>
                    </span><br><br>                  
                    <span><?php echo _l_joined_date; ?></span>&nbsp;&nbsp;&nbsp;
                      <span class="pull-right-container"><input type="submit" name="" value="<?php echo formatDate($registered_date); ?>" class="btn btn-default col-lg-pull-2" disabled>
                    </span><br><br>
                    </div>                
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-footer">
                <a title="Do you want to edit this user?" href="index.php?source=<?php echo urlencode('edit user profile'); ?>&user_id=<?php echo $user_id; ?>" class="btn btn-primary btn-block"><?php echo _l_edit_user; ?></a>
              </div>
            </div>
          </div> <!-- /.box -->
        </div> <!--/.col-xs-12 -->
      </div> <!--/.row -->
    </section> <!--/.end of section -->
  </div><!--/.content wrapper -->

    <?php
  }
  else {
    $goback = $_SERVER['HTTP_REFERER'];
    header('Location: '.$goback);
  }
?>
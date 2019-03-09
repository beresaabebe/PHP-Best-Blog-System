<?php include_once 'edit_code.php'; ?>
<?php 
  if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
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
      <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
  if (empty($image)) {
    ?>
                    <img class="img img-thumbnail" src="../uploads/images/users/boy.jpg">
                    <?php
  }
  else {
    ?>
    <img class="img img-thumbnail" src="../uploads/images/users/<?php echo $image; ?>" alt="<?php echo $image; ?>">
    <?php
  }
?>                    
                    <div class="form-group">
                      <label for="image"><?php echo _l_upload_image; ?></label>
                      <input type="file" name="image">
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <?php if (isset($success)): ?>
                      <?php 
                        echo "<div class='alert alert-success'>
                          $success
                        </div>";
                      ?>
                    <?php endif ?>                    
                    <div class="form-group">
                      <label for="firstname"><?php echo _l_firstname; ?></label>
                      <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="Enter firstname" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="lastname"><?php echo _l_lastname; ?></label>
                      <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Enter lastname" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="email"><?php echo _l_email; ?></label>
                      <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Enter email" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="phone"><?php echo _l_phone; ?></label>
                      <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="<?php echo _l_enter_phone; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="profession"><?php echo _l_profession; ?></label>
                      <input type="text" name="profession" value="<?php echo $profession; ?>" placeholder="Enter profession" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-12">                    
                    <div class="form-group">
                      <label for="address"><?php echo _l_address; ?></label>
                      <textarea name="address" placeholder="Enter address" class="form-control"><?php echo $address; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="gender"><?php echo _l_gender; ?></label>
                      <select name="gender" class="form-control">
                        <option value="<?php echo lcfirst(_l_male); ?>"><?php echo _l_male; ?></option>
                        <option value="<?php echo lcfirst(_l_female); ?>"><?php echo _l_female; ?></option>
                      </select>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="panel panel-primary">
                <div class="panel-footer">
                  <input type="submit" name="edit_user" value="<?php echo ucfirst(_l_update_user); ?>" class="btn btn-primary btn-block">
                </div>
              </div>
            </div> <!-- /.box -->
          </div> <!--/.col-xs-12 -->
        </div> <!--/.row -->
      </form>
    </section> <!--/.end of section -->
  </div><!--/.content wrapper -->

    <?php
  }
  else {
    $goback = $_SERVER['HTTP_REFERER'];
    header('Location: '.$goback);
  }
?>
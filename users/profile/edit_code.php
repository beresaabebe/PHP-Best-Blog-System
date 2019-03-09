<?php 
  if (isset($_POST['edit_user'])) {
    $user_id = $_GET['user_id'];
    $firstname = mysqli_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_escape_string($connection, $_POST['lastname']);
    $address = mysqli_escape_string($connection, $_POST['address']);
    $phone = mysqli_escape_string($connection, $_POST['phone']);
    $email = mysqli_escape_string($connection, $_POST['email']);
    $profession = mysqli_escape_string($connection, $_POST['profession']);
    $gender = $_POST['gender'];

    $allowed_ext = array('jpg','jpeg','png','gif');
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $img_ext = explode('.', $_FILES['image']['name']);
    $image_ext = strtolower(end($img_ext));

    if (!empty($image) || $image !="") {
      if (in_array($image_ext, $allowed_ext) === false) {
        $errors[] = _l_only_image;
      }
      if ($image_size > 2097152) {
        $errors[] = _l_image_size;
      }     
    }

    if (empty($image)) {
      $query = "SELECT image FROM users WHERE id='$user_id'";
      $execute = mysqli_query($connection, $query);
      $row = mysqli_fetch_array($execute);
      $image = $row['image'];
    }
    if (!empty($firstname) || !empty($lastname) || !empty($phone) || !empty($email) || !empty($address)) {
      move_uploaded_file($image_tmp, "../uploads/images/users/".$image);

      $query = "UPDATE `users` SET 
                  `phone`='$phone',
                    `email`='$email',
                      `firstname`='$firstname',
                        `lastname`='$lastname',
                          `address`='$address',
                            `profession`='$profession',
                              `image`='$image',
                                `gender`='$gender' 
                WHERE id='$user_id'";
      $execute = mysqli_query($connection, $query);
      confirmQuery($execute);
      $success = _l_successfully_updated;
    }
  }
?>
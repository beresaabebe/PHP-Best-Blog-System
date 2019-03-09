<?php include_once 'includes/database.php'; ?>
<?php include_once 'lang/define_lang.php'; ?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                
                             

$query = "SELECT * FROM settings";
$execute = mysqli_query($connection, $query);
$rows = mysqli_fetch_array($execute);


    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $rows['mail_host'];  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $rows['admin_email'];                 // SMTP username
    $mail->Password = $rows['admin_email_password'];                           // SMTP password
    $mail->SMTPSecure = $rows['mail_encryption'];                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $rows['mail_port_address'];                                    // TCP port to connect to
    $mail->isHTML(true); 

    $mail->setFrom($rows['admin_email'], ucfirst(_l_njcit));
 ?>
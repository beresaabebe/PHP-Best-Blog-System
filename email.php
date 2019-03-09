<?php include_once 'mailer.php'; ?>
<?php   
    $mail->addAddress('roobaanuuf@gmail.com', 'Joe User');     // Add a recipient

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        echo 'Message has been sent';
    }
    else {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
?>
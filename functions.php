<?php

require 'PHPMailer\PHPMailer\PHPMailer.php';
require 'PHPMailer\PHPMailer\SMTP.php';
require 'PHPMailer\PHPMailer\Exception.php';

// Instantiation and passing `true` enables exceptions
function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'psi.project2k19@gmail.com';                     // SMTP username
        $mail->Password = 'psi12345.';                               // SMTP password
        $mail->Port = 587;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('psi.project2k19@gmail.com', 'Mailer');
        $mail->addAddress($to);     // Add a recipient
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

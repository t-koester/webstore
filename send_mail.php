<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust based on your installation method

$mail = new PHPMailer(true); // Enable exceptions

// SMTP Configuration
$mail->isSMTP();
$mail->Host = 'localhost'; // Mailpit's SMTP server
$mail->Port = 1025; // Default port for Mailpit

// Enable debug output
$mail->SMTPDebug = 2; // 0 = off, 1 = client messages, 2 = client and server messages

// Sender settings
$mail->setFrom('your_email@example.com', 'Your Name');

// Recipient settings
$mail->addAddress('test@example.com', 'Test Recipient');

// Email content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'Test Email';
$mail->Body    = '<h1>This is a test email sent to Mailpit</h1>';

// Send the email
if(!$mail->send()){
    echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
    error_log('Email sending failed: '. $mail->ErrorInfo);
} else {
    echo 'Message has been sent';
    error_log('Email sent successfully!');
}
?>
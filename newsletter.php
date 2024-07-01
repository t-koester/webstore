<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust based on your installation method

// Database connection settings
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'webshop_project';

// Create a new PDO connection
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: '. $e->getMessage();
    exit;
}

// Create the newsletter database and subscribers table if it doesn't exist
$stmt = $db->prepare('CREATE DATABASE IF NOT EXISTS newsletter');
$stmt->execute();

$stmt = $db->prepare('USE newsletter');
$stmt->execute();

$stmt = $db->prepare('CREATE TABLE IF NOT EXISTS subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)');
$stmt->execute();

// Newsletter functionality
function sendNewsletter($subject, $body, $recipients) {
    global $mail; // Access the $mail object

    // Set email content
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->isHTML(true); // Set email format to HTML

    // Add recipients
    foreach ($recipients as $recipient) {
        $mail->addAddress($recipient['email'], $recipient['name']);
    }

    // Send the email
    if (!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
        error_log('Email sending failed: '. $mail->ErrorInfo);
    } else {
        echo 'Message has been sent';
        error_log('Email sent successfully!');
    }

    // Clear recipients for next email
    $mail->clearAddresses();
}

// Create a new instance of PHPMailer
$mail = new PHPMailer(true); // Enable exceptions

// SMTP Configuration
$mail->isSMTP();
$mail->Host = 'localhost'; // Mailpit's SMTP server
$mail->Port = 1025; // Default port for Mailpit

// Enable debug output
$mail->SMTPDebug = 2; // 0 = off, 1 = client messages, 2 = client and server messages

// Sender settings
$mail->setFrom('your_email@example.com', 'Your Name');

// Form to collect email addresses
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address';
        exit;
    }

    // Add subscriber to database
    $stmt = $db->prepare('INSERT INTO subscribers (email, name) VALUES (:email, :name)');
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    // Get all subscribers from database
    $stmt = $db->prepare('SELECT email, name FROM subscribers');
    $stmt->execute();
    $recipients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Send newsletter
    $subject = 'Newsletter Conformation';
    $body = '<h1>Confirm your email by answering to this!</h1>';
    sendNewsletter($subject, $body, $recipients);
}

// Form to collect email addresses
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>
    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>
    <input type="submit" name="submit" value="Subscribe">
</form>
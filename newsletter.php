<?php
// Configuration
$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'your_database';

// SMTP Configuration
$mail->isSMTP();
$mail->Host = 'localhost'; // Mailpit's SMTP server
$mail->Port = 1025; // Default port for Mailpit

// Connect to database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Newsletter signup form
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address';
    } else {
        // Check if email already exists in database
        $query = "SELECT * FROM newsletter_subscribers WHERE email = '$email'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $error = 'Email address already subscribed';
        } else {
            // Insert into database
            $query = "INSERT INTO newsletter_subscribers (email, name, confirmed) VALUES ('$email', '$name', 0)";
            $conn->query($query);

            // Send confirmation email
            $token = generateToken();
            $query = "UPDATE newsletter_subscribers SET token = '$token' WHERE email = '$email'";
            $conn->query($query);

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $mail_host;
            $mail->Port = $mail_port;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->setFrom($mail_from, $mail_from_name);
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Confirm your newsletter subscription';
            $mail->Body = '<p>Dear ' . $name . ',</p><p>Thank you for subscribing to our newsletter. To confirm your subscription, please click on the following link:</p><p><a href="https://example.com/confirm.php?email=' . $email . '&token=' . $token . '">Confirm subscription</a></p>';
            if (!$mail->send()) {
                $error = 'Error sending confirmation email: ' . $mail->ErrorInfo;
            } else {
                $success = 'Subscription successful! Please check your email to confirm your subscription.';
            }
        }
    }
}

// Confirmation page
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $query = "SELECT * FROM newsletter_subscribers WHERE email = '$email' AND token = '$token'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $query = "UPDATE newsletter_subscribers SET confirmed = 1 WHERE email = '$email'";
        $conn->query($query);
        $success = 'Subscription confirmed! You will now receive our newsletter.';
    } else {
        $error = 'Invalid confirmation link';
    }
}

// Generate token function
function generateToken() {
    $token = bin2hex(random_bytes(16));
    return $token;
}

// Newsletter signup form
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    <input type="submit" name="submit" value="Subscribe">
</form>

<?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php } elseif (isset($success)) { ?>
    <p style="color: green;"><?php echo $success; ?></p>
<?php } ?>
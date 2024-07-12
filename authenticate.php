<?php
// authenticate.php

// Store the username and password in an array
$users = array(
    'admin' => 'root',
    'user1' => 'root',
    // Add more users here
);

// Get the posted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username and password match
if (isset($users[$username]) && $users[$username] == $password) {
    // Login successful, set a session variable
    session_start();
    $_SESSION['username'] = $username;
    header('Location: admin_panel.php');
    exit;
} else {
    // Invalid username or password
    echo 'Invalid username or password';
}

?>
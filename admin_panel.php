<?php
// admin_panel.php

// Login form
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in']!== true) {
   ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <?php
} else {
    // Display orders only if admin is logged in
    $orders = getOrdersFromDatabase(); // Replace with your database query
    foreach ($orders as $order) {
        echo "Order ID: ". $order['id']. "<br>";
        echo "Order Date: ". $order['date']. "<br>";
        // Display other order details
    }
}

// Login validation
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Validate credentials against database or predefined set
    if (validateAdminCredentials($username, $password)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: '. $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Invalid username or password";
    }
}

function validateAdminCredentials($username, $password) {
    // Replace with your own validation logic
    // For example:
    $admin_username = 'admin';
    $admin_password = 'password';
    if ($username === $admin_username && $password === $admin_password) {
        return true;
    }
    return false;
}

function getOrdersFromDatabase() {
    // Replace with your own database query
    // For example:
    $db = new PDO('mysql:host=localhost;dbname=webshop_project', 'username', 'password');
    $stmt = $db->prepare('SELECT * FROM orders');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
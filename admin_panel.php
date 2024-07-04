<?php
// Configuration for MySQL database
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'webshop_project';

// Create a connection to the MySQL database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Login credentials
$admin_username = 'admin';
$admin_password = 'password'; // You should store hashed passwords in a secure way

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $admin_username && $password == $admin_password) {
        // Login successful, allow access to the admin panel
        $logged_in = true;
    } else {
        $error = "Invalid username or password";
    }
}

// If not logged in, show the login form
if (!isset($logged_in) || !$logged_in) {
    ?>
    <h1>Admin Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </form>
    <?php
    exit; // Stop executing the script if not logged in
}

// If logged in, show the admin panel
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class="admin-panel">
    <?php include 'header.php'?>

    <div class="container">
        <h1>Admin Panel</h1>

        <!-- Create Product Form -->
        <h2>Create Product</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name"><br><br>
            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description"></textarea><br><br>
            <label for="product_price">Product Price:</label>
            <input type="number" id="product_price" name="product_price"><br><br>
            <input type="submit" name="create_product" value="Create Product">
        </form>


    </div>

    <?php include 'footer.php'?>
</body>
</html>
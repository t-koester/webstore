<?php

include "./utils/queries.php";

include 'connection.php';


// Check if admin is logged in / set admin_logged_in
$admin_logged_in = isset($_SESSION['admin_logged_in']);
if($admin_logged_in){
    error_log(print_r("User is logged in", true));
} else {
    error_log(print_r("User is not logged in", true));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log(print_r($_POST, true));
}

// Login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    error_log(print_r("authenticateAdminLogin $password, $username", true));
    if (authenticateAdminLogin($username, $password, $conn)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ".$_SERVER['PHP_SELF']);
        // exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Create product form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_product'])) {
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['product_price'];
    createProduct($name, $description, $price, $conn);
    $success = "Product created successfully!";
}

// Delete product form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $id = $_POST['product_id'];
    deleteProduct($id, $conn);
    $success = "Product deleted successfully!";
}

?>

<?php 

// Client Code

if (!$admin_logged_in) {?>
    <!-- Login Form -->
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label>Username:</label>
        <input type="text" name="username"><br><br>
        <label>Password:</label>
        <input type="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; }?>
    </form>
<?php } else {?>
    <!-- Dashboard -->
    <h2>Dashboard</h2>
    <p>Welcome, admin!</p>

    <!-- Create Product Form -->
    <h2>Create Product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label>Product Name:</label>
        <input type="text" name="product_name"><br><br>
        <label>Product Description:</label>
        <textarea name="product_description"></textarea><br><br>
        <label>Product Price:</label>
        <input type="number" name="product_price"><br><br>
        <input type="submit" name="create_product" value="Create Product">
        <?php if (isset($success)) { echo "<p style='color:green;'>$success</p>"; }?>
    </form>

    <!-- Delete Product Form -->
    <h2>Delete Product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label>Product ID:</label>
        <input type="number" name="product_id"><br><br>
        <input type="submit" name="delete_product" value="Delete Product">
        <?php if (isset($success)) { echo "<p style='color:green;'>$success</p>"; }?>
    </form>

    <!-- Logout Button -->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
    <?php
    if (isset($_POST['logout'])) {
        unset($_SESSION['admin_logged_in']);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
    ?>
<?php }?>

<!-- Close MySQLi connection -->
<?php $conn->close();?>
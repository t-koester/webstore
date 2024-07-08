<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'webshop_project';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Display login form
    ?>
    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
    </form>
    <?php
    exit;
}

// Check if login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are correct
    $sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful, set session variable
        $_SESSION['admin_logged_in'] = true;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Invalid username or password";
    }
}

// Create product
if (isset($_POST['create_product'])) {
    $product_name = $_POST['productName'];
    $product_description = $_POST['productDescription'];
    $product_price = $_POST['productPrice'];

    if (!empty($product_name) && !empty($product_description) && !empty($product_price)) {
        $sql = "INSERT INTO products (Name, Description, Price) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $product_name, $product_description, $product_price);

        if ($stmt->execute()) {
            echo "New product created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Please fill in all required fields";
    }
}

// Delete product
if (isset($_GET['delete_product'])) {
    $product_id = $_GET['delete_product'];

    $sql = "DELETE FROM products WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Products</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "<td><a href='?delete_product=" . $row['ID'] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No products found";
}

// Close connection
$conn->close();
?>

<!-- Create product form -->
<h1>Create Product</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="productName">Product Name:</label>
    <input type="text" id="productName" name="productName"><br><br>
    <label for="productDescription">Product Description:</label>
    <textarea id="productDescription" name="productDescription"></textarea><br><br>
    <label for="productPrice">Product Price:</label>
    <input type="number" id="productPrice" name="productPrice"><br><br>
    <input type="submit" name="create_product" value="Create Product">
</form>
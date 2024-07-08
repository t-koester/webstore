<?php
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Configuration
$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'your_database';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $product_name = $_POST['productName'];
    $product_description = $_POST['productDescription'];
    $product_price = $_POST['productPrice'];

    // Check if data is valid
    if (!empty($product_name) && !empty($product_description) && !empty($product_price)) {
        // Prepare SQL query
        $sql = "INSERT INTO products (Name, Description, Price) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $product_name, $product_description, $product_price);

        // Execute query
        if ($stmt->execute()) {
            echo "New product created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Please fill in all required fields";
    }
}

// Close connection
$conn->close();
?>

<!-- HTML form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="productName">Product Name:</label>
    <input type="text" id="productName" name="productName"><br><br>
    <label for="productDescription">Product Description:</label>
    <textarea id="productDescription" name="productDescription"></textarea><br><br>
    <label for="productPrice">Product Price:</label>
    <input type="number" id="productPrice" name="productPrice"><br><br>
    <input type="submit" name="submit" value="Create Product">
</form>
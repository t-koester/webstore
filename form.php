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

// Get the product ID from the URL
$product_id = $_GET['product_id'];

// Query to fetch product information from the database
$sql = "SELECT * FROM products WHERE ID = '$product_id'";
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows > 0) {
    // Fetch the product information
    $row = $result->fetch_assoc();
    $product_name = $row["Name"];
    $product_price = $row["Price"];

    // Process the order
    // ...

    echo "<p>Order placed successfully!</p>";

} else {
    echo "<p>Product not found.</p>";
}

// Close the MySQL connection
$conn->close();
?>
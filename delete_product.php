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

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!= true) {
    echo "Access denied. You must be logged in to delete a product.";
    exit;
}

// Delete a product
$product_name = $_POST['productName'];

$sql = "DELETE FROM products WHERE Name =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $product_name);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Product deleted successfully!";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$conn->close();
?>
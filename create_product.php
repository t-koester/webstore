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
    echo "Access denied. You must be logged in to create a product.";
    exit;
}

// Create a new product
$product_name = $_POST['productName'];
$product_description = $_POST['productDescription'];
$product_price = $_POST['productPrice'];

$sql = "INSERT INTO products (Name, Description, Price) VALUES ('$product_name', '$product_description', '$product_price')";
if ($conn->query($sql) === TRUE) {
    echo "New product created successfully!";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$conn->close();
?>
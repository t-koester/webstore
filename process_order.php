<?php

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'webshop_project'; // Updated database name


// Create a new PDO instance
try {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  echo 'Connection failed: '. $e->getMessage();
  exit();
}



// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $customer_name = $_POST['customer_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $product = $_POST['product'];
  $quantity = $_POST['quantity'];
  $special_instructions = $_POST['special_instructions'];

  // Generate a unique order number
  $order_number = uniqid();

  // Insert the data into the costumer_data table
  $stmt = $pdo->prepare("INSERT INTO costumer_data (order_number, name, adress, email, number, product, amount) VALUES (:order_number, :name, :adress, :email, :number, :product, :amount)");
  $stmt->bindParam(':order_number', $order_number);
  $stmt->bindParam(':name', $customer_name);
  $stmt->bindParam(':adress', $address);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':number', $phone_number);
  $stmt->bindParam(':product', $product);
  $stmt->bindParam(':amount', $quantity);
  $stmt->execute();

  // Display a success message
  echo "Order placed successfully! Your order number is: $order_number";
} else {
  // Display an error message if the form hasn't been submitted
  echo "Error: Form not submitted";
}

?>
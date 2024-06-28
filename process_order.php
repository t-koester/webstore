<?php

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'webstore_project'; // Make sure this matches the actual database name

// Create a new PDO instance
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

// ... rest of the code remains the same ...

// Set error mode to exceptions
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the database connection is established
if (!$pdo) {
  echo 'Error: Unable to connect to database';
  exit;
}

// Get the form data
$customer_name = $_POST['customer_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$special_instructions = $_POST['special_instructions'];

try {
  // Prepare the SQL statement
  $statement = $pdo->prepare("INSERT INTO users (email, vorname, nachname) VALUES (:email, :customer_name, '')");
  $statement->bindParam(':email', $email);
  $statement->bindParam(':customer_name', $customer_name);
  $statement->execute();

  // Get the new user ID
  $new_id = $pdo->lastInsertId();

  // Prepare the SQL statement for the order
  $statement = $pdo->prepare("INSERT INTO orders (user_id, product, quantity, address, phone_number, special_instructions) VALUES (:user_id, :product, :quantity, :address, :phone_number, :special_instructions)");
  $statement->bindParam(':user_id', $new_id);
  $statement->bindParam(':product', $product);
  $statement->bindParam(':quantity', $quantity);
  $statement->bindParam(':address', $address);
  $statement->bindParam(':phone_number', $phone_number);
  $statement->bindParam(':special_instructions', $special_instructions);
  $statement->execute();

  echo 'Order placed successfully!';
} catch (PDOException $e) {
  echo 'Error: '. $e->getMessage();
  exit;
}

?>
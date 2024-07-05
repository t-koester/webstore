<?php include 'header.php'?>
<?php include 'head.php'?>

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

// Get the data from the order form
$product = $_POST['product'];
$customer_name = $_POST['customer_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];
$quantity = $_POST['quantity'];
$special_instructions = $_POST['special_instructions'];

// Generate a unique order number
$order_number = uniqid();

// Insert the data into the costumer_data table
$query = "INSERT INTO costumer_data (order_number, name, adress, email, number, product, amount) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssss", $order_number, $customer_name, $address, $email, $phone_number, $product, $quantity);
$stmt->execute();

// Check if the data was inserted successfully
if ($stmt->affected_rows > 0) {
  // Display a success message with order details
  echo "<div class='success-message'>";
  echo "<h2 class='success-header'>Bestellung Erfolgreich!</h2>";
  echo "<p class='customer-greeting'>Moin $customer_name,</p>";
  echo "<p class='order-summary'>Deine Bestellung ist bei uns eingegangen. Hier sind deine Bestelldetails:</p>";
  echo "<ul class='order-details'>";
  echo "<li class='order-number'><span>Bestellnummer:</span> $order_number</li>";
  echo "<li class='product'><span>Produkt:</span> $product</li>";
  echo "<li class='amount'><span>Menge:</span> $quantity</li>";
  echo "</ul>";
  echo "<p class='payment-instructions'><span>Zahlungsinformationen:</span> Bitte überweise das Geld zu: DE38500105173193917541 mit dem Verwendungszweck: $order_number</p>";
  echo "<p class='thank-you'>Danke für deine Bestellung!</p>";
  echo "</div>";
} else {
  // Display an error message if the data was not inserted successfully
  echo "<div class='error-message'>";
  echo "<p>Error: Unable to save data</p>";
  echo "</div>";
}

// Close the MySQL connection
$conn->close();
?>

<?php include 'footer.php'?>
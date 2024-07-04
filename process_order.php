<?php include 'head.php' ?>
<?php include 'header.php' ?>

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

  // Display a success message with order details
?>
<div class='success-message'>
  <h2 class='success-header'>Bestellung Erfolgreich!</h2>
  <p class='customer-greeting'>Moin <?php echo htmlspecialchars($customer_name); ?>,</p>
  <p class='order-summary'>Deine Bestellung ist bei uns eingegangen. Hier sind deine Bestelldetails:</p>
  <ul class='order-details'>
    <li class='order-number'Bestellnummer: <?php echo htmlspecialchars($order_number); ?></li>
    <li class='product'>Produkt: <?php echo htmlspecialchars($product); ?></li>
    <li class='quantity'>Menge: <?php echo htmlspecialchars($quantity); ?></li>
    <li class='special-instructions'>Sonderwünsche: <?php echo htmlspecialchars($special_instructions); ?></li>
  </ul>
  <p class='payment-instructions'>Bitte überweise das Geld zu: DE38500105173193917541 mit dem Verwendungszweck: <?php echo htmlspecialchars($order_number); ?></p>
  <p class='thank-you'>Danke für deine Bestellung!</p>
</div>
<?php

} else {
  // Display an error message if the form hasn't been submitted
  echo "<div class='error-message'>";
  echo "Error: Form not submitted";
  echo "</div>";
}

?>

<?php include 'footer.php' ?>
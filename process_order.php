<?php
  // Get the form data
  $customer_name = $_POST['customer_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $product = $_POST['product'];
  $quantity = $_POST['quantity'];
  $special_instructions = $_POST['special_instructions'];

  // Connect to MongoDB
  $mongo_client = new MongoDB\Driver\Manager("mongodb://localhost:27017");

  // Select the database and collection
  $database = new MongoDB\Driver\Database($mongo_client, "mydatabase");
  $collection = new MongoDB\Driver\Collection($database, "orders");

  // Create a new document to insert into the collection
  $document = array(
    "customer_name" => $customer_name,
    "email" => $email,
    "phone_number" => $phone_number,
    "address" => $address,
    "product" => $product,
    "quantity" => $quantity,
    "special_instructions" => $special_instructions
  );

  // Insert the document into the collection
  $write_result = $collection->insertOne($document);

  // Get the inserted ID
  $inserted_id = $write_result->getInsertedId();

  // Display the data in a table
  echo "<h1>Order Summary</h1>";
  echo "<table>";
  echo "<tr><th>Order Number</th><th>Customer Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Product</th><th>Quantity</th><th>Special Instructions</th></tr>";
  echo "<tr>";
  echo "<td>" . $inserted_id . "</td>";
  echo "<td>" . $customer_name . "</td>";
  echo "<td>" . $email . "</td>";
  echo "<td>" . $phone_number . "</td>";
  echo "<td>" . $address . "</td>";
  echo "<td>" . $product . "</td>";
  echo "<td>" . $quantity . "</td>";
  echo "<td>" . $special_instructions . "</td>";
  echo "</tr>";
  echo "</table>";

  // Redirect to a thank-you page
  header("Location: thank_you.php?order_number=$inserted_id");
  exit();
?>